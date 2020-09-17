<?php

namespace PenD\Docker\Console\Command;

use JacobDeKeizer\Statusweb\Client as Statusweb;
use JacobDeKeizer\Statusweb\Enums\CountryCode;
use JacobDeKeizer\Statusweb\Enums\LabelFormat;
use JacobDeKeizer\Statusweb\Enums\Unit;
use JacobDeKeizer\Statusweb\Resources\Address;
use JacobDeKeizer\Statusweb\Resources\LabelData;
use JacobDeKeizer\Statusweb\Resources\Shipment;
use JacobDeKeizer\Statusweb\Resources\ShipmentRow;
use PenD\Docker\Application\Model\Shipments;
use PenD\Docker\Console\Command\ProfitManagerBaseCommand AS BaseCommand;
use PenD\Docker\Console\ExitCode;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zebra\Client;
use Zebra\Zpl\Image;
use Zebra\Zpl\Builder;
use Zebra\Zpl\GdDecoder;

/**
 * Class ImportSystemUsersV2Command
 *
 * @package PenD\Docker\Console\Command
 * @author Mike Gerritsen <mike@pend-group.com>
 * @since 15/04/2020 15:54
 */
class TestConnectStatuswebCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('test:connect-statusweb')
            ->setAliases(['test-statusweb'])
            ->setDescription('Dit is een testomgeving tbv het opzetten koppeling STATUSWEB')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $em = $this->getEntityManager();

        try {

            $dbShipments = $em->getRepository(Shipments::class);

            foreach($dbShipments->findAll() as $shipment){
                dump($shipment);
            }

            dump(count($dbShipments->findAll()));

//            die();
           // START COMMUNICATION TO STATUSWEB
            $statusweb = (new Statusweb())
                // LIVE VM
//                ->setApiKey('5050B4A5-B7C6-4F7C-9F48-0A09F9B3EE7D')
//                ->setPassword('0665B360-0DE2-47CF-9A3D-F667C7B3A899')

                // TEST INT
                ->setApiKey('9FB8465B-242F-4334-ADEC-7B1840DA69D6')
                ->setPassword('B831EB25-E08D-45DF-9D2B-9E19B9116DD6')

            ;

            // SET ADDRESS CUSTOMER
            $deliveryAddress = (new Address())
                ->setStreet('Kernreactorstraat')
                ->setCity('Veenendaal')
                ->setHouseNumber('1-7')
                ->setPostalCode('3903LG')
                ->setCountryCode(CountryCode::NETHERLANDS)
                ->setEmail('mike@pend-group.com')
                ->setToTheAttentionOf('Mike Gerritsen')
                ->setPhoneNumber('+31612345678')
                ->setName('Mike Gerritsen');

            // SET ADDRESS SENDER
            $loadingAddress = (new Address())
                ->setStreet('Stoker')
                ->setCity('Druten')
                ->setHouseNumber('36')
                ->setPostalCode('6651SJ')
                ->setCountryCode(CountryCode::NETHERLANDS)
                ->setEmail('mike@pend-group.com')
                ->setToTheAttentionOf('Mike Gerritsen')
                ->setPhoneNumber('+31612345678')
                ->setName('Mike Gerritsen');

            // SET LABEL
            $labelData = (new LabelData())
                ->setLabelFormat(LabelFormat::PDF)
                ->setReturnLabel(true); // return the pdf label in the response

            // SET COLLI 'EUROPALLET'
            $shipmentRow1 = (new ShipmentRow())
                ->setAmount(1)
                ->setWeight(1500)
                ->setUnit(Unit::EUROPALLET);

            // SET COLLI 'MINI PALLET / HALVE PALLET'
            $shipmentRow2 = (new ShipmentRow())
                ->setAmount(2)
                ->setWeight(2497)
                ->setUnit(Unit::HALVE_PALLET);

            // PREPARE COMPLETE SHIPMENT
            $shipment = (new Shipment())
                ->setReference('002201')
                ->setDeliveryAddress($deliveryAddress)
                ->setLoadingAddress($loadingAddress)
                ->setType(1) // Statusweb -> Tabellen -> Zendingsoorten
                ->setDirectSend(true) // when true the shipment is confirmed and can't be deleted
                ->setLabelData($labelData)
                ->addShipmentRow($shipmentRow1) // ->setShipmentRows accepts an array of ShipmentRows
                ->addShipmentRow($shipmentRow2); // ->setShipmentRows accepts an array of ShipmentRows

            // CREATE SHIPMENT AND SEND TO API
            $shipmentResponse = $statusweb->shipments()->create($shipment);

            // Show label pdf
            $data = base64_decode($shipmentResponse->getLabels());

            // MAKE PDF
            $myfile = fopen($this->getApplication()->getRootDirectory().'/tmp/labels.pdf', "w") or die("Unable to open file!");
            $txt = $data;
            fwrite($myfile, $txt);
            fclose($myfile);

            // PING PDF FILE TO COUNT PAGES
            $image = new \Imagick();
            $image->pingImage($this->getApplication()->getRootDirectory().'/tmp/labels.pdf');
            $pageCount = $image->getNumberImages();

            // MAKE PNG FROM PDF PAGES
            for($i = 0; $i < $pageCount; $i++) {
                $myurl = $this->getApplication()->getRootDirectory() . '/tmp/labels.pdf['.$i.']';
                $image = new \Imagick();
                $image->setResolution(200, 200); // set scale canvas
                $image->readImage($myurl); // add pdf
                $image->setImageFormat("png"); // define file format
                $image->writeImage($this->getApplication()->getRootDirectory() . '/tmp/labels_'.$i.'.png'); // save file

                // MAKE ZPL
                $decoder = GdDecoder::fromPath($this->getApplication()->getRootDirectory() . '/tmp/labels_'.$i.'.png'); // load png into zpl lib
                $image = new Image($decoder); // create image

                $zpl = new Builder(); // init builder
                $zpl->fo(0, 35)->gf($image)->fs(); // build zpl code from png image

                $myfile = fopen($this->getApplication()->getRootDirectory().'/tmp/labels_'.$i.'.zpl', "w") or die("Unable to open file!"); // create zpl file
                $txt = $zpl;
                fwrite($myfile, $txt); // write content into file
                fclose($myfile); // close file

                echo $zpl;
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