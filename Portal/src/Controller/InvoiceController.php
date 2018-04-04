<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\Http\Client;

require_once 'Component/PDF.class.php';

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class InvoiceController extends AppController
{

    public $m_aHelperText = [];
    public $m_aPaymentStatus = [
        "Q29tcGxldGVk" => "Completed",
        "RGVjbGluZWQ=" => "Declined",
        "T3BlbiBjb21wbGV0ZWQ=" => "Open completed",
        "T3BlbiBkZWNsaW5lZA==" => "Open declined",
        "Q2FuY2VsbGVk" => "Cancelled"
    ];

    public function initialize()
    {
        parent::initialize();
        $this->m_aHelperText[__FUNCTION__] = [
            'nl' => 'Hier heeft u een overzicht van al uw facturen. In het menu kunt u een filter toepassen om een specifieke status te bekijken. Ook ziet u per factuur welke order hieraan ten grondslag ligt.',
        ];

    }

    /**
     * @param null $p_iStatus
     */
    public function index($p_iStatus = null){

        $this->loadModel("Invoice");
        $this->loadModel("InvoicePayments");

        $aStatus = $this->Invoice->getStatusArray();

        $aList = $this->Invoice->getInvoiceListCustomer($this->m_iPartner);
        $this->InvoicePayments->getPaymentsFromList($aList);

        $this->Invoice->setInvoiceListStatus($aList);

        if($p_iStatus != null){
            $this->loadComponent('Functions');
            $this->Functions->filter_array($aList, "BKHVFSTATUS", $p_iStatus);
            $this->set("iStatus".$p_iStatus, "active");
            $this->set("sStatus", $aStatus[$p_iStatus]["text"]);
        }else{
            $this->set("iStatus", "active");
            $this->set("sStatus", 'All');
        }

        $this->set("aList", $aList);

        if($p_iStatus == 2){
            $this->render('betaald');
        }

    }

    public function overview(){

        $aStatusShown = [0,1];

        $this->loadModel("Invoice");
        $aList = $this->Invoice->getInvoiceListCustomer($this->m_iPartner);
        $aList->order(["BKHVFDATUM_VV" => "ASC"]);
        $this->Invoice->setInvoiceListStatus($aList);


        $this->loadComponent('Functions');
        $this->Functions->filter_array($aList, "BKHVFSTATUS", $aStatusShown, "in_array");

        require_once(ROOT .DS. "vendor" . DS  . "multisafepay" . DS  . "controllers" . DS  . "gatewayController.php");
        $msp_gateway = new \gatewayController();
        $aGateways = $msp_gateway->getGateways();


        $this->set("iStatusX", "active");
        $this->set("sStatus", "Trending");
        $this->set("aList", $aList);
        $this->set("aGateways", $aGateways);

        // IMPORTANT:: FORCE INDEX VIEW !!
        //$this->render('/Invoice/index');

    }

    public function expired(){

        $aStatusShown = [0,1];

        $this->loadModel("Invoice");
        $aList = $this->Invoice->getInvoiceListCustomer($this->m_iPartner);
        $aList->order(["BKHVFDATUM_VV" => "ASC"]);
        $this->Invoice->setInvoiceListStatus($aList);

        $this->loadComponent('Functions');
        $this->Functions->filter_array($aList, "BKHVFSTATUS", $aStatusShown, "in_array");

        require_once(ROOT .DS. "vendor" . DS  . "multisafepay" . DS  . "controllers" . DS  . "gatewayController.php");
        $msp_gateway = new \gatewayController();
        $aGateways = $msp_gateway->getGateways();

        $this->set("iStatusX", "active");
        $this->set("sStatus", "Expired");
        $this->set("aList", $aList);
        $this->set("aGateways", $aGateways);

        //debug($aList);

        // IMPORTANT:: FORCE INDEX VIEW !!
        //$this->render('/Invoice/index');

    }

    /**
     * @param $p_sNrint
     */
    public function view($p_sNrint){

        $this->loadModel("Invoice");
        $this->loadModel("InvoicePayments");

        $aInvoice = $this->Invoice->getInvoiceCustomer($p_sNrint, $this->m_iPartner);
        $this->InvoicePayments->getPaymentsByInvoice($aInvoice);

        $aInvoice->BKHVFSTATUS = $this->Invoice->setInvoiceStatus($aInvoice);
        $this->Invoice->setStatusText($aInvoice);

        require_once(ROOT .DS. "vendor" . DS  . "multisafepay" . DS  . "controllers" . DS  . "gatewayController.php");
        $msp_gateway = new \gatewayController();
        $aGateways = $msp_gateway->getGateways();

        $this->set("aInvoice", $aInvoice);
        $this->set("aGateways", $aGateways);
    }


    public function download($p_sType, $p_sNrint){
        if($this->request->is('post')) {

            $this->loadModel("Invoice");
            $aInvoice = $this->Invoice->getInvoiceCustomer($p_sNrint, $this->m_iPartner);

            if ($p_sType == 'csv') {

                //var_dump($aInvoice); die();

                $b = array("factuurnummer",
                    "factuurdatum",
                    "vervaldatum",
                    "uw_referentie",
                    "factuur_bedrag",
                    "btwbedrag",
                    "naam",
                    "contactpersoon",
                    "adres",
                    "postcode",
                    "plaats",
                    "naam_hodi",
                    "adres_hodi",
                    "postcode_hodi",
                    "plaats_hodi",
                    "artikelcode",
                    "aantal",
                    "omschrijving",
                    "prijs",
                    "eenheid",
                    "bedrag");

                $i = 0;
                foreach ($aInvoice->InvoiceLine as $v) {
                    if ($v->BKHVRTYPE == 0) {
                        $aValue[$i]["ordernummer"] = $aInvoice["BKHVFNR"];
                        $aValue[$i]["datum"] = $aInvoice["BKHVFDATUM"];
                        $aValue[$i]["vervaldatum"] = $aInvoice["BKHVFDATUM_VV"];
                        $aValue[$i]["uw_referentie"] = $aInvoice["BKHVFTEKST1"];
                        $aValue[$i]["factuur_bedrag"] = str_replace(".", ",", $aInvoice["BKHVFBEDRAG_VAL"]);
                        $aValue[$i]["btwbedrag"] = str_replace(".", ",", $aInvoice["BKHVFBTW"]);
                        $aValue[$i]["naam"] = $aInvoice["Address"]["BKHADNAAM"];
                        $aValue[$i]["contactpersoon"] = @$aInvoice["BKHVFCONTACTPERSOON"];
                        $aValue[$i]["adres"] = $aInvoice["Address"]["BKHADADRES_W"];
                        $aValue[$i]["postcode"] = $aInvoice["Address"]["BKHADPOSTCODE"];
                        $aValue[$i]["plaats"] = $aInvoice["Address"]["BKHADPLAATS"];
                        $aValue[$i]["naam_hodi"] = "Hodi Verpakkingsmaterialen BV";
                        $aValue[$i]["adres_hodi"] = "Kernreactorstraat 1";
                        $aValue[$i]["postcode_hodi"] = "3901 LG";
                        $aValue[$i]["plaats_hodi"] = "Veenendaal";
                        $aValue[$i]["artikelcode"] = $v["BKHARCODE"];
                        $aValue[$i]["aantal"] = $v["BKHVRAANTAL"];
                        $aValue[$i]["omschrijving"] = preg_replace('/(\r\n|\n|\r)/',' ',$v["BKHVROMS"]);
                        $aValue[$i]["prijs"] = str_replace(".", ",", $v["BKHVRPRIJS"]);
                        $aValue[$i]["eenheid"] = $v["Article"]["BKHAREENHEID"];
                        $aValue[$i]["bedrag"] = str_replace(".", ",", $v["BKHVRBEDRAG"]);
                        $i++;
                    }
                }

                ob_start();

                $fp = fopen('php://memory', 'a+');
                fputcsv($fp, $b, ";");
                foreach ($aValue as $row) {
                    fputcsv($fp, $row, ";");
                }

                rewind($fp);
                $csvFile = stream_get_contents($fp);
                fclose($fp);

                header('Content-Type: text/csv');
                header('Content-Length: ' . strlen($csvFile));
                header('Content-Disposition: attachment; filename="Factuur' . $aInvoice["BKHVFNR"] . '.csv"');

                exit($csvFile);

                ob_end_flush();
            }

            if($p_sType == 'pdf'){
                $this->loadComponent("Media");
                $fileContent = $this->Media->downloadFile($aInvoice["BKHVFNR"].'.pdf', 'invoice');

                $this->viewBuilder()->layout(false);
                if($fileContent == ''){
                    ob_start();
                    define('EURO',chr(128));

                    $pdf = new \PDF('P','mm','A4');
                    $pdf->addPage();

                    $pdf->SetTitle("Factuur".$aInvoice["BKHVFNR"]);

                    $pdf->image("http://www.hodi-portal.nl/img/pdf/bg_invoice.jpg", 0, 0, 210,297);

                    $pdf->SetFont('Arial','B',12);
                    $pdf->text(10,42, 'Kopie factuur');

                    $pdf->SetFont('Arial','B',8);
                    $pdf->text(10,50, 'Afleveradres:');
                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(9,51);
                    $pdf->MultiCell(60,4,preg_replace('/(\r\n|\n|\r)/',"\n",$aInvoice["Order"]["AddressDelivery"]["BKHAAFADRESGROOT"]),0,'L',false);
                    $pdf->Ln();

                    $pdf->SetFont('Arial','B',8);
                    $pdf->text(120,50, 'Faktuuradres:');
                    $pdf->SetFont('Arial','',8);
                    $pdf->text(120,54, $aInvoice["Address"]["BKHADNAAM"]);
                    $pdf->text(120,58, $aInvoice["Address"]["BKHADADRES_W"]);
                    $pdf->text(120,62, $aInvoice["Address"]["BKHADPOSTCODE"]." ".$aInvoice["Address"]["BKHADPLAATS"]);



                    $pdf->text(10,74, 'Faktuurnummer:');
                    $pdf->text(40,74,$aInvoice["BKHVFNR"]);

                    $pdf->text(10,78, 'Datum:');
                    $oDate = new \DateTime();
                    $pdf->text(40,78, $aInvoice["BKHVFDATUM"]->format('d-m-Y'));

                    $pdf->text(10,82, 'Vervaldatum:');
                    $oDate = new \DateTime();
                    $pdf->text(40,82, $aInvoice["BKHVFDATUM_VV"]->format('d-m-Y'));

                    $pdf->text(10,86, 'Pakbon:');
                    $pdf->text(40,86,  $aInvoice["Order"]["ORDORNR"]);

                    $pdf->text(120,74, 'Klantnummer:');
                    $pdf->text(150,74, $aInvoice["Address"]["BKHADNUMMER_D"]);

                    $pdf->text(120,78, 'BTW nummer:');
                    $pdf->text(150,78, $aInvoice["Address"]["BKHADBTWNUMMER"]);

                    $pdf->text(120,82, 'Contact:');
                    $pdf->text(150,82, $aInvoice["Order"]["ORDORTAV"]);

                    $pdf->text(120,86, 'Uw referentie:');
                    $pdf->text(150,86,$aInvoice["BKHVFTEKST1"]);


                    //Factuurregels
                    // Column headings
                    $header = array('Artikelnr.', 'Omschrijving', 'Aantal', ' ', 'Prijs','Eenh.', '','Totaal');

                    // zet de regels in een array
                    $i = 0;
                    foreach($aInvoice->InvoiceLine as $v){
                        if($v["BKHVRTYPE"] == 0){
                            $aValue[$i][0]       = $v["Article"]["BKHARCODE"];
                            $aValue[$i][1]       = preg_replace('/(\r\n|\n|\r)/',"\n",$v["BKHVROMS"]);
                            $aValue[$i][2]       = number_format($v["BKHVRAANTAL"], 0,',', '.');
                            $aValue[$i][3]       = EURO;
                            $aValue[$i][4]       = str_replace(".", ",",$v["BKHVRPRIJS"]);
                            $aValue[$i][5]       = $v["Article"]["BKHAREENHEID"];
                            $aValue[$i][6]       = EURO;
                            $aValue[$i][7]       = number_format($v["BKHVRBEDRAG"], 2,',', '.');
                            $i++;
                        }
                    }

                    $pdf->SetXY(10,94);
                    $pdf->Rect(8, 95, 194, 5);

                    $pdf->LineItems($header,$aValue);



                    $pdf->SetXY(140,220);

                    $pdf->Line(140,218,200,218);

                    $pdf->Cell(30,6,"Subtotaal",'0','','L');
                    $pdf->Cell(5,6,EURO,'0','','L');
                    $pdf->Cell(25,6,number_format ( $aInvoice['BKHVFJAAROMZET'] , 2 , ',' , '.' ),'0','','R');
                    $pdf->Ln();

                    $pdf->SetXY(140,226);
                    $pdf->Cell(30,6,"21% btw",'0','','L');
                    $pdf->Cell(5,6,EURO,'0','','L');
                    $pdf->Cell(25,6,number_format ( $aInvoice['BKHVFBTW'] , 2 , ',' , '.' ),'0','','R');
                    $pdf->Ln();

                    $pdf->Line(140,236,200,236);
                    $pdf->Line(140,237,200,237);
                    $pdf->SetXY(140,240);
                    $pdf->Cell(30,6,"Te betalen",'0','','L');
                    $pdf->Cell(5,6,EURO,'0','','L');


                    $pdf->Cell(25,6,number_format ( $aInvoice['BKHVFBEDRAG_VAL'] , 2 , ',' , '.' ),'0','','R');

                    $pdf->Ln();
                    $pdf->SetFont('Arial','',7);
                    $pdf->SetXY(10,265);
                    $txt = "";

                    $pdf->MultiCell(190,5,$txt,0,'C',false);

                    $pdf->Output("factuur".$aInvoice["BKHVFNR"].".pdf", "D");

                    unset($pdf);
                    ob_end_flush();
                }


            }
        }
    }

    public function statement(){
        if($this->request->is('post')) {

            header('Cache-Control: no-store, private, no-cache, must-revalidate');                  // HTTP/1.1
            header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);    // HTTP/1.1
            header('Pragma: public');
            header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');                                       // Date in the past
            header('Expires: 0', false);
            header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
            header('Pragma: no-cache');

            $aStatusShown = [0,1];

            $this->loadModel("Invoice");
            $aList = $this->Invoice->getInvoiceListCustomer($this->m_iPartner);
            $aList->order(["BKHVFDATUM_VV" => "ASC"]);
            $this->Invoice->setInvoiceListStatus($aList);

            $this->loadComponent('Functions');
            $this->Functions->filter_array($aList, "BKHVFSTATUS", $aStatusShown, "in_array");

            $b = array("factuurnummer",
                "factuurperiode",
                "factuurdatum",
                "vervaldatum",
                "betalingsconditie",
                "uw_referentie",
                "factuur_bedrag",
                "btwbedrag",
                "openstaand_bedrag",
                "reeds_betaald");

            $i = 0;
            foreach ($aList as $aInvoice) {
                $aValue[$i]["factuurnummer"] = $aInvoice["BKHVFNR"];
                $aValue[$i]["factuurperiode"] = $aInvoice["BKHVFJAARPER"];
                $aValue[$i]["datum"] = $aInvoice["BKHVFDATUM"];
                $aValue[$i]["vervaldatum"] = $aInvoice["BKHVFDATUM_VV"];
                $aValue[$i]["betalingsconditie"] = $aInvoice["BKHBTOMS"];
                $aValue[$i]["uw_referentie"] = $aInvoice["BKHVFTEKST1"];
                $aValue[$i]["factuur_bedrag"] = str_replace(".", ",", $aInvoice["BKHVFBEDRAG_EUR"]);
                $aValue[$i]["btwbedrag"] = str_replace(".", ",", $aInvoice["BKHVFBTW"]);
                $aValue[$i]["openstaand_bedrag"] = str_replace(".", ",", $aInvoice["BKHVFOPEN_VAL"]);
                $aValue[$i]["reeds_betaald"] = str_replace(".", ",", $aInvoice["BKHVFBEDRAG_EUR"]-$aInvoice["BKHVFOPEN_VAL"]);

                $i++;
            }

            ob_start();

            $fp = fopen('php://memory', 'a+');
            fputcsv($fp, $b, ";");
            foreach ($aValue as $row) {
                fputcsv($fp, $row, ";");
            }

            rewind($fp);
            $csvFile = stream_get_contents($fp);
            fclose($fp);

            header('Content-Type: text/csv');
            header('Content-Length: ' . strlen($csvFile));
            header('Content-Disposition: attachment; filename="Statement_' . date('Y-m-d_His') . '.csv"');

            exit($csvFile);

            ob_end_flush();
        }
    }



    public function payInvoiceBatch(){
        if($this->request->is('post')){

            $aPost = $this->request->data();
            $sBatch = "HPT".date('y').str_pad(time()*9, 16, "0", STR_PAD_LEFT);

            $aInvoiceNrint = [];
            foreach($aPost["payInvoice"] as $nrint => $value){
                $aInvoiceNrint[] = $nrint;
            }

            $this->loadModel("Invoice");
            $aInvoice = $this->Invoice->find()->where(["BKHVFNRINT IN" => $aInvoiceNrint])->all();

            $this->loadModel('Address');
            $aCustomer = $this->Address->get($this->m_iPartner);

            $iTotal = 0;
            $aInvoiceNrs = [];
            foreach($aInvoice as $inv){
                $aInvoiceNrs[] = $inv->BKHVFNR;
                $iTotal += $inv->BKHVFOPEN_EUR;

                $this->setInitialized($inv, $sBatch, $aCustomer);
            }

            $b64 = base64_encode($sBatch);



            // Ordergegevens
            $a["order_id"] = $sBatch;
            $a["amount"] = $iTotal*100;
            $a["description"] = "BatchID: $sBatch";
            $a["items"] = "<br/><strong>U betaalt de volgende facturen:<br /></strong>".implode(' // ', $aInvoiceNrs);
            $a["notification_url"] = "checkout/notification?type=initial";
            $a["redirect_url"] = "Invoice/paymentResponse/$b64/Q29tcGxldGVk";
            $a["cancel_url"] = "Invoice/paymentResponse/$b64/Q2FuY2VsbGVk";
            //$a[""] = $aOrder[""];

            // Klantgegevens
            //$a["locale"] = $aCustomer[""];
            $a["ip_address"] = $this->request->clientIp();
            $a["forwarded_ip"] = $this->request->clientIp();
            $a["first_name"] = '';
            $a["last_name"] = $aCustomer["BKHADNAAM"];
            $a["address1"] = $aCustomer["BKHADADRES_W"];
            $a["house_number"] = $aCustomer["BKHADADRES_HNR"].''.$aCustomer["BKHADADRES_HNR_TOE"];
            $a["zip_code"] = $aCustomer["BKHADPOSTCODE"];
            $a["city"] = $aCustomer["BKHADPLAATS"];
            $a["country"] = $aCustomer["BKHLACODE"];
            $a["phone"] = $aCustomer["BKHADTELEFOON"];
            $a["email"] = $aCustomer["BKHADEMAIL"];

            // Extra gegevens
            $a["shop_root_url"] = "http://www.demo.nl";
            $a["gateway"] = $aPost["gateway"];

            require_once(ROOT .DS. "vendor" . DS  . "multisafepay" . DS  . "controllers" . DS  . "connectController.php");

            $msp = new \connectController();

            $msp->startTransaction($a);

            $this->render(false);
        }else{
            $this->Flash->error('You\'ve been redirected here because have no permissions for the page you tried to visit.');
            return $this->redirect('/');
        }
    }

    public function paymentResponse($p_sRef, $p_iResponse){
        $status = base64_decode($p_iResponse);
        $ref = base64_decode($p_sRef);

        $this->setStatusByBatch($ref, $status);
        if($status == "Completed") {
            $this->Flash->success('Uw betaling is succesvol verwerkt');
        }else{
            $this->Flash->error('Uw betaling is niet verwerkt!');
        }
        return $this->redirect('/Invoice/Overview');

    }

    public function downloadExternal(){



    }


    private function setInitialized($p_aInvoice, $p_sBatch, $p_aCustomer){
        $this->loadModel("HdOnlinePayments");
        $id = $this->HdOnlinePayments->checkPaymentByNrint($p_aInvoice->BKHVFNRINT);
        $a["id"] = $id ? $id : 0;
        $a["invoicenumber"] = $p_aInvoice->BKHVFNR;
        $a["BKHVFNRINT"] = $p_aInvoice->BKHVFNRINT;
        $a["BKHADCODE"] = $p_aCustomer->BKHADCODE;
        $a["BKHADNRINT"] = $p_aCustomer->BKHADNRINT;
        $a["amount"] = $p_aInvoice->BKHVFOPEN_EUR;
        $a["status"] = "initialized";
        $a["downloaded"] = -1;
        $a["batchnumber"] = $p_sBatch;
        $a["editdate"] = date('Y-m-d H:i:s');

        $entity = $this->HdOnlinePayments->newEntity($a);
        $this->HdOnlinePayments->save($entity);
    }

    private function setStatusByBatch($p_sBatch, $p_sStatus){
        $this->loadModel("HdOnlinePayments");
        $aBatch = $this->HdOnlinePayments->getBatchByNumber($p_sBatch);
        foreach($aBatch as $a){
            if($p_sStatus == "Completed"){
                $a["downloaded"] = 0;
            }else{
                $a["downloaded"] = -1;
            }
            $a["status"] = $p_sStatus;
            $a["editdate"] = date('Y-m-d H:i:s');
            $this->HdOnlinePayments->save($a);
        }
    }


    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->set("aPageHelper", $this->m_aHelperText);
    }

}
