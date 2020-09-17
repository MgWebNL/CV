<?php

namespace PenD\Docker\Application\Transport;

use Clegginabox\PDFMerger\PDFMerger;
use JacobDeKeizer\Statusweb\Client as Statusweb;
use JacobDeKeizer\Statusweb\Enums\CountryCode;
use JacobDeKeizer\Statusweb\Enums\LabelFormat;
use JacobDeKeizer\Statusweb\Enums\Unit;
use JacobDeKeizer\Statusweb\Resources\Address;
use JacobDeKeizer\Statusweb\Resources\LabelData;
use JacobDeKeizer\Statusweb\Resources\Shipment;
use JacobDeKeizer\Statusweb\Resources\ShipmentRow;
use ProfitClasses\__CG__\PEND_Transport_SalesOrders;
use Fpdf\Fpdf;
use const PenD\Docker\Console\Command\TESTTRANSPORT;

class EckTransporter implements TransporterInterface
{
    protected $rootFolder = "/mnt/filer/ftp/fp-get-transport-label/";

    /**
     * EckTransporter constructor.
     */
    public function __construct()
    {
    }

    public function createLabel($data){


        try {
            /* @var $data PEND_Transport_SalesOrders */

            // START COMMUNICATION TO STATUSWEB
            $statusweb = (new Statusweb())
                // SET API
                ->setApiKey($this->getLogin('api', $data->getAdministrationCode(), TESTTRANSPORT))
                ->setPassword($this->getLogin('pass', $data->getAdministrationCode(), TESTTRANSPORT))
            ;

            // DETERMINE ADDRESSES
            $addresses = $this->determineAddresses($data);
//            dump($addresses->recipient); die();

            // SET ADDRESS CUSTOMER
            $deliveryAddress = (new Address())
                ->setName($addresses->recipient->name)
                ->setStreet($addresses->recipient->street)
                ->setCity($addresses->recipient->city)
                ->setHouseNumber($addresses->recipient->number)
                ->setPostalCode($addresses->recipient->postalcode)
                ->setCountryCode($this->getCountryCode($addresses->recipient->country));

            // SET ADDRESS SENDER
            $loadingAddress = (new Address())
                ->setName($addresses->sender->name)
                ->setStreet($addresses->sender->street)
                ->setCity($addresses->sender->city)
                ->setHouseNumber($addresses->sender->number)
                ->setPostalCode($addresses->sender->postalcode)
                ->setCountryCode($this->getCountryCode($addresses->recipient->country));

            // SET LABEL
            $labelData = (new LabelData())
                ->setLabelFormat(LabelFormat::PDF)
                ->setReturnLabel(true); // return the pdf label in the response

/** DIT STUK CODE IS VOOR VENSTERTIJDEN, DIT IS NOG NIET ACTIEF !! **/
//            // Delivery specs
//            dump($data->getDeliveryAddressName()); die();
//            $oDate = new \DateTime();
//            $oDate->modify("+1 weekdays");
//            for($i=0; $i<5; $i++){
//                $day = substr($oDate->format('D'), 0, -1);
//                $method = "getDeliveryTimesOpen".$day;
//                dump($method, $data->$method());
//                if($data->$method() === true){
//                    $date = $oDate->format('Y-m-d');
//                }else{
//                    $oDate->modify("+1 weekdays");
//                }
//            }
//
//            if($i == 5 && !isset($date)){
//                $oDate = new \DateTime();
//               $date = $oDate->modify("+1 weekdays");
//            }
//
//            dump($date); die();

            $oDate = new \DateTime();
            $oDate->modify("+1 weekdays");
            $date = $oDate->format('Y-m-d');


            // PREPARE COMPLETE SHIPMENT
            $shipment = (new Shipment())
                ->setReference($data->BoxWise->current()->getCustomerreference())

                ->setLoadingAddress($loadingAddress)
                ->setLoadingDate(date('Y-m-d'))
                ->setLoadingTimeFrom('08:00')
                ->setLoadingTimeUntil('17:00')

                ->setDeliveryAddress($deliveryAddress)
                ->setDeliveryDate($date)
                ->setDeliveryTimeFrom('09:00')
                ->setDeliveryTimeUntil('17:00')
                ->setDeliveryNote("")

                ->setType(1) // Statusweb -> Tabellen -> Zendingsoorten
                ->setDirectSend(true) // when true the shipment is confirmed and can't be deleted
                ->setLabelData($labelData);

            foreach($data->BoxWise as $pal){
                $dimensions = explode('x',$pal->getDimensions());
                $type = $pal->getCollipresetname();
                $volume = (float)$pal->getVolume();

                if((float)$pal->getWeight() == 0){
                    $pal->setWeight(1);
                }

                $shipmentRow = (new ShipmentRow())
                    ->setAmount(1)
                    ->setWeight($pal->getWeight())
                    ->setWidth($dimensions[1])
                    ->setHeight($dimensions[2])
                    ->setLength($dimensions[0])
                    ->setVolume($volume)
                    ->setUnit($this->getPalletType($type));

                if($shipmentRow->getWidth() == 0 || $shipmentRow->getLength() == 0 || $shipmentRow->getHeight() == 0){
                    $this->loadUnitDefaults($shipmentRow);
                }

                $shipment->addShipmentRow($shipmentRow); // ->setShipmentRows accepts an array of ShipmentRows
            }
//            dump($shipment); die();

            // CREATE SHIPMENT AND SEND TO API
            $shipmentResponse = $statusweb->shipments()->create($shipment);

            // Show label pdf
            $dataPDF = base64_decode($shipmentResponse->getLabels());

            // MAKE PDF
            $filename = "ECK_" . (int)$shipmentResponse->getTransportNumber().".pdf";
            is_dir($this->rootFolder . '/'.$data->getWarehouseCode()) or mkdir($this->rootFolder . '/'.$data->getWarehouseCode(), 0777);
            $myfile = fopen($this->rootFolder . '/'.$filename, "w") or die();
            $file = $this->rootFolder . '/'.$filename;
            fwrite($myfile, $dataPDF);
            fclose($myfile);

            // PING PDF FILE TO COUNT PAGES
            $image = new \Imagick();
            $image->pingImage($file);
            $pageCount = $image->getNumberImages();

            // MAKE PNG FROM PDF PAGES
            for($i = 0; $i < $pageCount; $i++) {
                $myurl = $file . '[' . $i . ']';
                $image = new \Imagick();
                $image->setResolution(200, 200); // set scale canvas
                $image->readImage($myurl); // add pdf
                $image->setImageFormat("png"); // define file format
                $filenamePNG = "ECK_" . (int)$shipmentResponse->getTransportNumber()."_$i.png";
                $image->writeImage($this->rootFolder . '/'.$data->getWarehouseCode(). "/". $filenamePNG); // save file
            }
            unlink($file);

            $oRet = new \stdClass();
            $oRet->label = base64_encode($dataPDF);
            $oRet->link = '';

            return $oRet;

        } catch (\Throwable $e) {

            dump($e);

        }

    }

    private function loadUnitDefaults($shipmentRow){
        /* @var $shipmentRow ShipmentRow */
        switch($shipmentRow->getUnit()){
            case Unit::EUROPALLET:
                $shipmentRow->setWidth(80)
                    ->setLength(120)
                    ->setHeight(180)
                    ->setVolume(1728);
                break;

            case Unit::HALVE_PALLET:
                $shipmentRow->setWidth(60)
                    ->setLength(80)
                    ->setHeight(90)
                    ->setVolume(432);
                break;

            case Unit::COLLI:
                $shipmentRow->setWidth(100)
                    ->setLength(100)
                    ->setHeight(180)
                    ->setVolume(1800);
                break;

            case Unit::BLOKPALLET:
                $shipmentRow->setWidth(100)
                    ->setLength(120)
                    ->setHeight(180)
                    ->setVolume(2160);
                break;

            case Unit::WEGWERPPALLET:
                $shipmentRow->setWidth(80)
                    ->setLength(120)
                    ->setHeight(150)
                    ->setVolume(1440);
            break;

            default:
                $shipmentRow->setWidth(80)
                    ->setLength(120)
                    ->setHeight(180)
                    ->setVolume(1728);
        }
    }

    private function determineAddresses($data){

        /* @var $data PEND_Transport_SalesOrders */

        // SET DEFAULT SENDER = ADMINISTRATION
        $sender = [
            "name" => $data->getAdministrationCompanyName(),
            "street" => $data->getAdministrationCompanyStreet(),
            "number" => $data->getAdministrationCompanyHouseNumber()." ".$data->getAdministrationCompanyHouseNumberAdd(),
            "postalcode" => $data->getAdministrationCompanyPostalCode(),
            "city" => $data->getAdministrationCompanyCity(),
            "country" => $data->getAdministrationCompanyCountryCode()
        ];

        // SET DEFAULT RECIPIENT
        $recipient = [
            "name" => $data->getCustomerCompanyName(),
            "street" => $data->getDeliveryAddressStreet(),
            "number" => $data->getDeliveryAddressHouseNumber()." ".$data->getDeliveryAddressHouseNumberAdd(),
            "postalcode" => $data->getDeliveryAddressPostalCode(),
            "city" => $data->getDeliveryAddressCity(),
            "country" => $data->getDeliveryAddressCountryCode()
        ];

        // SET DELIVERY NAME
        if($data->getCustomerCompanyName() !== $data->getDeliveryAddressName() && !empty($data->getDeliveryAddressName())){
            $recipient["name"] = $data->getDeliveryAddressName();
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
                "name" => $data->getInvoiceToCompanyName(),
                "street" => $data->getInvoiceToCompanyStreet(),
                "number" => $data->getInvoiceToCompanyHouseNumber()." ".$data->getInvoiceToCompanyHouseNumberAdd(),
                "postalcode" => $data->getInvoiceToCompanyPostalCode(),
                "city" => $data->getInvoiceToCompanyCity(),
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

    private function getCountryCode($code){
        switch($code){
            case 'GR':
                $country = CountryCode::GREECE;
            break;

            case 'NL':
                $country = CountryCode::NETHERLANDS;
                break;

            case 'B':
                $country = CountryCode::BELGIUM;
                break;

            case 'F':
                $country = CountryCode::FRANCE;
                break;

            case 'E':
                $country = CountryCode::SPAIN;
                break;

            case 'H':
                $country = CountryCode::HUNGARY;
                break;

            case 'I':
                $country = CountryCode::ITALY;
                break;

            case 'P':
                $country = CountryCode::PORTUGAL;
                break;

            case 'IRL':
                $country = CountryCode::IRELAND;
                break;

            case 'FIN':
                $country = CountryCode::FINLAND;
                break;

            case 'SLO':
                $country = CountryCode::SLOVENIA;
                break;

            case 'CZ':
                $country = CountryCode::CZECH_REPUBLIC;
                break;

            case 'SK':
                $country = CountryCode::SLOVAKIA;
                break;

            case 'A':
                $country = CountryCode::AUSTRIA;
                break;

            case 'GB':
                $country = CountryCode::ENGLAND;
                break;

            case 'DK':
                $country = CountryCode::DENMARK;
                break;

            case 'S':
                $country = CountryCode::SWEDEN;
                break;

            case 'PL':
                $country = CountryCode::POLAND;
                break;

            case 'D':
                $country = CountryCode::GERMANY;
                break;

            default:
                $country = CountryCode::NETHERLANDS;
        }

        return $country;
    }

    private function getPalletType($code){
        switch($code){
            case 'EURO':
                $pallet = Unit::EUROPALLET;
            break;

            case 'MINI':
                $pallet = Unit::HALVE_PALLET;
            break;

            case 'LOSSE COLLO':
                $pallet = Unit::COLLI;
            break;

            case 'BLOKPALLET':
                $pallet = Unit::BLOKPALLET;
            break;

            case 'WEGWERPPALLET':
                $pallet = Unit::WEGWERPPALLET;
            break;

            default:
                $pallet = Unit::EUROPALLET;
        }

        return $pallet;
    }

    private function getLogin($key, $administration, $testmode = false){
        $apiKeys = [
            // VAN VLIET
            2 => [
                "live" => [
                    "api" => "C2A75343-A8EE-4AF4-BE4A-DC60FF9CC1F5",
                    "pass" => "474A6EB6-D1D6-4564-8A2A-557B15BB56F4",
                ],
                "test" => [
                    "api" => "2688E287-3410-4912-AF10-4D119BF59FEF",
                    "pass" => "52C5B661-9518-4DF5-8F71-B54A68B26AA9",
                ],
            ],

            // UNIEK
            3 => [
                "live" => [
                    "api" => "BCA55155-3EA7-47F6-B3BF-88643F283998",
                    "pass" => "DF120580-6DB3-49C2-BEEF-A355B6210D6F",
                ],
                "test" => [
                    "api" => "2688E287-3410-4912-AF10-4D119BF59FEF",
                    "pass" => "52C5B661-9518-4DF5-8F71-B54A68B26AA9",
                ],
            ],

            // PACOMA
            4 => [
                "live" => [
                    "api" => "40A510D7-A41D-4414-8FC6-BBE6449AB672",
                    "pass" => "1E199BC8-3090-439D-AA33-CF66EF286002",
                ],
                "test" => [
                    "api" => "2688E287-3410-4912-AF10-4D119BF59FEF",
                    "pass" => "52C5B661-9518-4DF5-8F71-B54A68B26AA9",
                ],
            ],

            // HODI INTERNATIONAL
            5 => [
                "live" => [
                    "api" => "083329AA-A2AD-4431-8FA5-4BCE1F5E6E8D",
                    "pass" => "B91E8BD6-4509-472D-BE9B-6295BE8FE816",
                ],
                "test" => [
                    "api" => "2688E287-3410-4912-AF10-4D119BF59FEF",
                    "pass" => "52C5B661-9518-4DF5-8F71-B54A68B26AA9",
                ],
            ],

            // HODI VERPAKKINGSMATERIALEN
            6 => [
                "live" => [
                    "api" => "5050B4A5-B7C6-4F7C-9F48-0A09F9B3EE7D",
                    "pass" => "0665B360-0DE2-47CF-9A3D-F667C7B3A899",
                ],
                "test" => [
                    "api" => "2688E287-3410-4912-AF10-4D119BF59FEF",
                    "pass" => "52C5B661-9518-4DF5-8F71-B54A68B26AA9",
                ],
            ],
        ];

        $type = $testmode === true ? 'test' : 'live';

        return $apiKeys[$administration][$type][$key];
    }

}