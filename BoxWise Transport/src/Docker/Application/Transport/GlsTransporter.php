<?php


namespace PenD\Docker\Application\Transport;

use PenD\GlsSdk\Api\DefaultApi;
use PenD\GlsSdk\Api\DeliveryApi;
use PenD\GlsSdk\Configuration;
use PenD\GlsSdk\Model\InboundCreateDeliveryRequest;
use ProfitClasses\__CG__\PEND_Transport_SalesOrders;
use const PenD\Docker\Console\Command\TESTTRANSPORT;

class GlsTransporter implements TransporterInterface
{

    /**
     * GlsTransporter constructor.
     */
    /**
     * @var DefaultApi
     */
    private $glsApi;
    private $glsApiConfig;
    private $glsApiBody;
    protected $rootFolder = "/mnt/filer/ftp/fp-get-transport-label";

    public function __construct()
    {
    }

    public function createLabel($data)
    {
        $glsApiConfig = new Configuration();
        $glsApiConfig->setUsername($this->getLogin('username', $data->getAdministrationCode(), TESTTRANSPORT));
        $glsApiConfig->setPassword($this->getLogin('pass', $data->getAdministrationCode(), TESTTRANSPORT));
        $glsApiConfig->setApiKey('Ocp-Apim-Subscription-Key', $this->getLogin('api', $data->getAdministrationCode(), TESTTRANSPORT));
        $glsApiConfig->setHost($this->getLogin('host', $data->getAdministrationCode(), TESTTRANSPORT));

        $this->glsApi = new DefaultApi(null, $glsApiConfig);
        $this->glsApiConfig = $glsApiConfig;
        $this->glsApiBody = [
            "username" => $glsApiConfig->getUsername(),
            "password" => $glsApiConfig->getPassword(),
            "customer_no" => $this->getLogin('customerno', $data->getAdministrationCode(), TESTTRANSPORT)
        ];

        $oGls = new DeliveryApi(null, $this->glsApiConfig);

        try {
            /* @var $data PEND_Transport_SalesOrders */

            // DETERMINE ADDRESSES
            $addresses = $this->determineAddresses($data);

            // SET UNITS
            $units = [];
            foreach($data->BoxWise as $pal) {
                if ((float)$pal->getWeight() == 0) {
                    $pal->setWeight(1);
                }
                $units[] = [
                    "unitID" => $pal->getOuterreference(),
                    "weight" => 1
                ];
//                dump($pal); die();
            }

            // CREATE LABEL GLS
            $this->glsApiBody = array_merge($this->glsApiBody, [
                "shiptype" => "p",
                "shipping_date" => date('Y-m-d'),
                "reference" => substr($data->BoxWise->current()->getCustomerreference(), 0, 20),
                "label_type" => "pdfa6s",
                "tracking_link_type" => "S",
                "addresses" => [
                    "deliveryAddress" => [
                        "name1" => $addresses->recipient->name,
                        "street" => $addresses->recipient->street,
                        "houseNo" => $addresses->recipient->number,
                        "houseNoExt" => $addresses->recipient->number_ext,
                        "countryCode" => $this->getCountryCode($addresses->recipient->country),
                        "zipCode" => $addresses->recipient->postalcode,
                        "city" => $addresses->recipient->city
                    ],

                    "pickupAddress" => [
                        "name1" => $addresses->sender->name,
                        "street" => $addresses->sender->street,
                        "houseNo" => $addresses->sender->number,
                        "houseNoExt" => $addresses->sender->number_ext,
                        "countryCode" => $this->getCountryCode($addresses->sender->country),
                        "zipCode" => $addresses->sender->postalcode,
                        "city" => $addresses->sender->city
                    ],
                ],
                "units" => $units,
                "notificationEmail" => [
                    "sendMail" => false,
                ]
            ]);


            /* @var $labels createLabelLabelControllerV1 */
            $dataLabel = new InboundCreateDeliveryRequest($this->glsApiBody);
            $labels = $oGls->createLabelLabelControllerV1($dataLabel);
            $pdfContent = base64_decode($labels->labels);

            // MAKE PDF
            $filename = "GLS_".$labels->units[0]->unitNo.".pdf";
            is_dir($this->rootFolder . '/'.$data->getWarehouseCode()) or mkdir($this->rootFolder . '/'.$data->getWarehouseCode(), 0777);
            $myfile = fopen($this->rootFolder . '/'.$data->getWarehouseCode()."/".$filename, "w") or die();
            fwrite($myfile, $pdfContent);
            fclose($myfile);

            $oRet = new \stdClass();
            $oRet->label = base64_encode($pdfContent);
            $oRet->link = $labels->shipmentTrackingLink;

            return $oRet;
        } catch (\Throwable $e) {

            dump($e);

        }

    }

    private function getCountryCode($code){
        switch($code){

            case 'D':
                $country = 'DE';
                break;

            case 'B':
                $country = 'BE';
                break;

            case 'F':
                $country = 'FR';
                break;

            case 'GB':
                $country = 'GB';
                break;

            case 'I':
                $country = 'IT';
                break;

            case 'BG':
                $country = 'BG';
                break;

            case 'DK':
                $country = 'DK';
                break;

            case 'EE':
                $country = 'EE';
                break;

            case 'FIN':
                $country = 'FI';
                break;

            case 'AND':
                $country = 'AD';
                break;

            case 'GR':
                $country = 'GR';
                break;

            case 'H':
                $country = 'HU';
                break;

            case 'IRL':
                $country = 'IE';
                break;

            case 'HR':
                $country = 'HR';
                break;

            case 'LV':
                $country = 'LV';
                break;

            case 'FL':
                $country = 'LI';
                break;

            case 'LT':
                $country = 'LT';
                break;

            case 'L':
                $country = 'LU';
                break;

            case 'M':
                $country = 'MT';
                break;

            case 'MC':
                $country = 'MC';
                break;

            case 'N':
                $country = 'NO';
                break;

            case 'A':
                $country = 'AT';
                break;

            case 'PL':
                $country = 'PL';
                break;

            case 'P':
                $country = 'PT';
                break;

            case 'RO':
                $country = 'RO';
                break;

            case 'RSM':
                $country = 'SM';
                break;

            case 'SLO':
                $country = 'SI';
                break;

            case 'SK':
                $country = 'SK';
                break;

            case 'E':
                $country = 'ES';
                break;

            case 'CZ':
                $country = 'CZ';
                break;

            case 'S':
                $country = 'SE';
                break;

            case 'CH':
                $country = 'CH';
                break;

            default:
                $country = 'NL';
        }

        return $country;
    }


    private function getLogin($key, $administration, $testmode = false){
        $apiKeys = [
            // VAN VLIET
            2 => [
                "live" => [
                    "host" => "https://api.gls.nl/V1",
                    "customerno" => "39030082",
                    "api" => "f3902fb856af45af99ffffb65af4588a",
                    "username" => "pend-api",
                    "pass" => "Xqm2rWfj",
                ],
                "test" => [
                    "host" => "https://api.gls.nl/Test/V1",
                    "customerno" => "39030082",
                    "api" => "06f67dd2b9d04e7c9fd5e0262163c693",
                    "username" => "apitest3@gls-netherlands.com",
                    "pass" => "TestUser",
                ],
            ],

            // UNIEK
            3 => [
                "live" => [
                    "host" => "https://api.gls.nl/V1",
                    "customerno" => "39030081",
                    "api" => "f3902fb856af45af99ffffb65af4588a",
                    "username" => "pend-api",
                    "pass" => "Xqm2rWfj",
                ],
                "test" => [
                    "host" => "https://api.gls.nl/Test/V1",
                    "customerno" => "39030081",
                    "api" => "06f67dd2b9d04e7c9fd5e0262163c693",
                    "username" => "apitest3@gls-netherlands.com",
                    "pass" => "TestUser",
                ],
            ],

            // PACOMA
            4 => [
                "live" => [
                    "host" => "https://api.gls.nl/V1",
                    "customerno" => "51450084",
                    "api" => "f3902fb856af45af99ffffb65af4588a",
                    "username" => "pend-api",
                    "pass" => "Xqm2rWfj",
                ],
                "test" => [
                    "host" => "https://api.gls.nl/Test/V1",
                    "customerno" => "51450084",
                    "api" => "06f67dd2b9d04e7c9fd5e0262163c693",
                    "username" => "apitest3@gls-netherlands.com",
                    "pass" => "TestUser",
                ],
            ],

            // HODI INTERNATIONAL
            5 => [
                "live" => [
                    "host" => "https://api.gls.nl/V1",
                    "customerno" => "39030083",
                    "api" => "f3902fb856af45af99ffffb65af4588a",
                    "username" => "pend-api",
                    "pass" => "Xqm2rWfj",
                ],
                "test" => [
                    "host" => "https://api.gls.nl/Test/V1",
                    "customerno" => "39030083",
                    "api" => "06f67dd2b9d04e7c9fd5e0262163c693",
                    "username" => "apitest3@gls-netherlands.com",
                    "pass" => "TestUser",
                ],
            ],

            // HODI VERPAKKINGSMATERIALEN
            6 => [
                "live" => [
                    "host" => "https://api.gls.nl/V1",
                    "customerno" => "39030080",
                    "api" => "f3902fb856af45af99ffffb65af4588a",
                    "username" => "pend-api",
                    "pass" => "Xqm2rWfj",
                ],
                "test" => [
                    "host" => "https://api.gls.nl/Test/V1",
                    "customerno" => "39030080",
                    "api" => "06f67dd2b9d04e7c9fd5e0262163c693",
                    "username" => "apitest3@gls-netherlands.com",
                    "pass" => "TestUser",
                ],
            ],
        ];

        $type = $testmode === true ? 'test' : 'live';

        return $apiKeys[$administration][$type][$key];
    }

    private function determineAddresses($data){

        /* @var $data PEND_Transport_SalesOrders */

        // SET DEFAULT SENDER = ADMINISTRATION
        $sender = [
            "name" => substr($data->getAdministrationCompanyName(),0, 30),
            "street" => substr($data->getAdministrationCompanyStreet(),0, 30),
            "number" => $data->getAdministrationCompanyHouseNumber(),
            "number_ext" => empty($data->getAdministrationCompanyHouseNumberAdd()) ? "" : substr($data->getAdministrationCompanyHouseNumberAdd(),0,10),
            "postalcode" => preg_replace('/([^A-Za-z0-9])/', '', $data->getAdministrationCompanyPostalCode()),
            "city" => substr($data->getAdministrationCompanyCity(),0, 30),
            "country" => $data->getAdministrationCompanyCountryCode()
        ];

        // SET DEFAULT RECIPIENT
        $recipient = [
            "name" => substr($data->getCustomerCompanyName(),0, 30),
            "street" => substr($data->getDeliveryAddressStreet(),0, 30),
            "number" => $data->getDeliveryAddressHouseNumber(),
            "number_ext" => empty($data->getDeliveryAddressHouseNumberAdd()) ? "" : substr($data->getDeliveryAddressHouseNumberAdd(),0,10),
            "postalcode" => preg_replace('/([^A-Za-z0-9])/', '', $data->getDeliveryAddressPostalCode()),
            "city" => substr($data->getDeliveryAddressCity(),0, 30),
            "country" => $data->getDeliveryAddressCountryCode()
        ];

        // SET DELIVERY NAME
        if($data->getCustomerCompanyName() !== $data->getDeliveryAddressName() && !empty($data->getDeliveryAddressName())){
            $recipient["name"] = substr($data->getDeliveryAddressName(),0, 30);
        }

        // SET SENDER NAME
//        if($data->getCustomerCompanyName() !== $data->getInvoiceToCompanyName() && !empty($data->getInvoiceToCompanyName())){
//            $sender["name"] = $data->getInvoiceToCompanyName();
//        }
        $aSenders = [
            $data->getSenderINT(),
            $data->getSenderVM(),
            $data->getSenderVVT(),
            $data->getSenderUNIEK(),
            $data->getSenderPAC(),
        ];


        if(in_array(true, $aSenders) !== true){
            $sender = [
                "name" => substr($data->getInvoiceToCompanyName(),0, 30),
                "street" => substr($data->getInvoiceToCompanyStreet(),0, 30),
                "number" => $data->getInvoiceToCompanyHouseNumber()." ".$data->getInvoiceToCompanyHouseNumberAdd(),
                "number_ext" => empty($data->getInvoiceToCompanyHouseNumberAdd()) ? "" : $data->getInvoiceToCompanyHouseNumberAdd(),
                "postalcode" => $data->getInvoiceToCompanyPostalCode(),
                "city" => substr($data->getInvoiceToCompanyCity(),0, 30),
                "country" => $data->getInvoiceToCountryCode()
            ];
        }

        // SET ADDRESSES
        $addresses = [
            'sender' => $sender,
            'recipient' => $recipient
        ];

        // RETURN
        return json_decode(json_encode ($addresses), FALSE);

    }

}