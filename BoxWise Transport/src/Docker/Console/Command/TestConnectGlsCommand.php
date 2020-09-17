<?php

namespace PenD\Docker\Console\Command;

use Doctrine\ORM\EntityManagerInterface;
use PenD\Docker\Application\Model\Shipments;
use PenD\Docker\Console\Command\ProfitManagerBaseCommand AS BaseCommand;
use PenD\Docker\Console\ExitCode;
use PenD\GlsSdk\Api\AuthenticationApi;
use PenD\GlsSdk\Api\DefaultApi;
use PenD\GlsSdk\Api\DeliveryApi;
use PenD\GlsSdk\ConfigurationInterface;
use PenD\GlsSdk\Model\ApiLabelCreatePost200TextPlainResponse;
use PenD\GlsSdk\Model\InboundCreateDeliveryRequest;
use PenD\Profit\ProfitManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportSystemUsersV2Command
 *
 * @package PenD\Docker\Console\Command
 * @author Mike Gerritsen <mike@pend-group.com>
 * @since 15/04/2020 15:54
 */
class TestConnectGlsCommand extends BaseCommand
{
    /**
     * @var DefaultApi
     */
    private $glsApi;
    private $glsApiConfig;
    private $glsApiBody;

    public function __construct(ProfitManagerInterface $profitManager, EntityManagerInterface $entityManager, ConfigurationInterface $glsApiConfig, string $name = null)
    {
        parent::__construct($profitManager, $entityManager, $name);
        $this->glsApi = new DefaultApi(null, $glsApiConfig);
        $this->glsApiConfig = $glsApiConfig;
        $this->glsApiBody = [
            "username" => $glsApiConfig->getUsername(),
            "password" => $glsApiConfig->getPassword()
        ];
    }


    protected function configure()
    {
        $this
            ->setName('test:connect-gls')
            ->setAliases(['test-gls'])
            ->setDescription('Dit is een testomgeving tbv het opzetten koppeling GLS')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $oGls = new DeliveryApi(null, $this->glsApiConfig);

        // GET DATA FROM BOXWISE
        $em = $this->getEntityManager();

        // START MSSQL DATA TRANSFER
        /* @var $shipments Shipments */
        $dbShipments = $em->getRepository(Shipments::class);

        foreach($dbShipments->findAll() as $shipment){
//            dump($shipment);
        }

//        dump(count($dbShipments->findAll()));

        try {

            // CREATE LABEL GLS
            $this->glsApiBody = array_merge($this->glsApiBody, [
                "shiptype" => "p",
                "shipping_date" => date('Y-m-d'),
                "reference" => "Test 123",
                "label_type" => "pdfa6s",
                "tracking_link_type" => "S",
                "addresses" => [
                    "deliveryAddress" => [
                        "name1" => "Mike Gerritsen",
                        "street" => "Stoker",
                        "houseNo" => "36",
                        "countryCode" => "NL",
                        "zipCode" => "6651SJ",
                        "city" => "Druten",
                        "contact" => "",
                        "phone" => "0031620103705",
                        "email" => "mike.gerritsen@hotmail.com"
                    ],

                    "pickupAddress" => [
                        "name1" => "Hodi Verpakkingsmaterialen BV",
                        "street" => "Kernreactorstraat",
                        "houseNo" => "1",
                        "countryCode" => "NL",
                        "zipCode" => "3903LG",
                        "city" => "Veenendaal"
                    ],
                ],
                "units" => [
                    [
                        "unitID" => '12345678',
                        "weight" => '1'
                    ],
                    [
                        "unitID" => '12345679',
                        "weight" => '1'
                    ],
                ],
                "notificationEmail" => [
                    "sendMail" => false,
                ]
            ]);

            $data = new InboundCreateDeliveryRequest($this->glsApiBody);
            $labels = $oGls->createLabelLabelControllerV1($data);
            $pdfContent = $labels->labels;

            // MAKE PDF
            $myfile = fopen($this->getApplication()->getRootDirectory().'/tmp/transportLabels/VM_'.$labels->units[0]->uniqueNo.'.pdf', "w") or die("Unable to open file!");
            fwrite($myfile, base64_decode($pdfContent));
            fclose($myfile);

            $exitCode = ExitCode::OK;
        } catch (\Throwable $e) {

            if ($em->getConnection()->isTransactionActive()) {
                $em->rollback();
            }

            dump($e);

            $exitCode = ExitCode::ERROR;
        }

        return $exitCode;


        return 1;
    }
}