<?php

namespace PenD\Docker\Console\Command;

use PenD\Docker\Application\Model\Shipments;
use PenD\Docker\Application\Repository\ShipmentsRepository;
use PenD\Docker\Application\Transport\TransporterFactory;
use PenD\Docker\Console\Command\ProfitManagerBaseCommand AS BaseCommand;
use PenD\Docker\Console\ExitCode;
use ProfitClasses\__CG__\PEND_Transport_SalesOrders;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

const TESTTRANSPORT = FALSE;

/**
 * Class ImportSystemUsersV2Command
 *
 * @package PenD\Docker\Console\Command
 * @author Mike Gerritsen <mike@pend-group.com>
 * @since 15/04/2020 15:54
 */
class CreateLabelForTransportCommand extends BaseCommand
{

    protected function configure()
    {
        $this
            ->setName('transport:create-label')
            ->setAliases(['trans-label'])
            ->setDescription('Dit is een test omgeving tbv het opzetten koppeling MSSQL')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $em = $this->getEntityManager();
        $profitRepo = $this->getProfitManager()->getRepository('PEND_Transport_SalesOrders');

        try {

            // START MSSQL DATA TRANSFER
            /* @var $dbShipments ShipmentsRepository */
            $dbShipments = $em->getRepository(Shipments::class);

            /* @var $profitRepo PEND_Transport_SalesOrders */
            /* @var $shipemt Shipments */
            foreach($dbShipments->getUnprocessedShipments() as $shipment){
                $ordernumber = null;
                $pallets = $shipment->getShipmentpackages();

                // Check
                if($pallets->isEmpty() === false){
                    $outbound = $pallets->current()->getOutboundorders();
                    // Doublecheck
                    if($outbound->isEmpty() === false){
                        $ordernumber = $outbound->current()->getOrdernumber();
                    }
                }

                // Show Exceptions
                if($ordernumber === null){
                    throw new \Exception('Ordernumber does not exisist');
                }

                // GET AFAS DATA
                /* @var $afasOrder PEND_Transport_SalesOrders */
                $afasOrder = $profitRepo->findOneBy(["OrderNumber" => $ordernumber]);

                // ADD BOXWISE DATA
                $afasOrder->BoxWise = $pallets;

                // CREATE LABEL
                $transporterFactory = new TransporterFactory();
                $transporter = $transporterFactory->get($afasOrder->getTransporterCode());
                if(!is_null($transporter) && $afasOrder->getCustomerPickupOrder() !== true && $afasOrder->getWarehouseCode() != "PAC"){
                    $base64Label = $transporter->createLabel($afasOrder);

                    // SAVE RECORD IN BOXWISE DB
                    $shipment->setCommunicationartefacts($base64Label->label);
                    $shipment->setCustomdata($base64Label->link);
                    $em->persist($shipment);
                    $em->flush();

                    // ECHO DONE
                    $output->writeln(date('Y-m-d H:i:s'). " - Label ".$afasOrder->getTransporterCode()." for Order ".$ordernumber." created.");
                }elseif($afasOrder->getCustomerPickupOrder() === true){
                    // SAVE RECORD IN BOXWISE DB
                    $shipment->setCommunicationartefacts("Afhaalorder");
                    $em->persist($shipment);
                    $em->flush();

                    // ECHO DONE
                    $output->writeln(date('Y-m-d H:i:s'). " - Order ".$ordernumber." is a pickup order.");
                }elseif($afasOrder->getWarehouseCode() != "PAC"){
                    // ECHO ERROR
                    $shipment->setCommunicationartefacts(date('Y-m-d H:i:s'). " - ERROR for Order ".$ordernumber);
                    $em->persist($shipment);
                    $em->flush();
                    mail('ict@pend-group.com', 'LABEL ERROR for Order '.$ordernumber, 'An error occurred while generating the label for this order. Please check crontab logs for more info.');
                    $output->writeln(date('Y-m-d H:i:s'). " - ERROR for Order ".$ordernumber.":");
                }


            }

            $exitCode = ExitCode::OK;
        } catch (\Throwable $e) {

            if ($em->getConnection()->isTransactionActive()) {
                $em->rollback();
            }

            dump($e);

            $exitCode = ExitCode::ERROR;
        }

        return $exitCode;
    }
}