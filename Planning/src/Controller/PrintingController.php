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
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\Time;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PrintingController extends AppController
{


    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index()
    {
        $aStatus = [101];

        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplViewDeliveryDate");
        $this->loadModel("HdIntPrplStatus");
        $this->loadModel("HdIntPrplExceptionrules");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel("FRbkhADRES");
        $this->loadModel("HdIntPrplPrintingBatch");

        $this->loadComponent("Functions");

        $aStatusList = $this->HdIntPrplStatus->getStatus($aStatus);

        $aOrders = $this->HdIntPrplViewItem->getOrdersByStatus($aStatus);
        $aOrders->contain(["HdIntPrplPrinting"]);

        $aGrouped = $this->Functions->groupObjectByKey($aOrders, "adres_nrint", ["HdIntPrplPrinting"]);

        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();

        $aCompany = $this->FRbkhADRES->getCompanyAddressList('print');
        $aCompany = $this->Functions->rebuildObjectToKey($aCompany, "BKHADNRINT");

        $aEditie = $this->HdIntPrplArticleEditions->getEditions();

        $aBatch = $this->HdIntPrplPrintingBatch->getAllPrintingBatchData();

        $this->HdIntPrplViewDeliveryDate->setDeliveryDates($aOrders);

        $aOrders->order(["HdIntPrplPrinting.end_date"]);

        $this->set('aOrders', $aOrders);
        $this->set('aGrouped', $aGrouped);
        $this->set('aStatusList', $aStatusList);
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);
        $this->set('aCompany', $aCompany);
        $this->set('aBatch', $aBatch);
    }

    public function saveBatch()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {
            $this->loadComponent("DatabaseHelper");

            // LEEG BATCH
            $this->DatabaseHelper->delete("HdIntPrplPrintingBatch", ["adres_nrint" => $this->request->data["printer_nrint"]]);

            // SAVE ALL LINES IN BATCH QTY > 0
            foreach($this->request->data["order_nrint"] as $k => $nrint){
                if(intval($this->request->data["production_quantity"][$k]) > 0){
                    $a["id"] = 0;
                    $a["adres_nrint"] = $this->request->data["printer_nrint"];
                    $a["order_nrint"] = $this->request->data["order_nrint"][$k];
                    $a["quantity"] = $this->request->data["production_quantity"][$k];
                    // SAVE DATA
                    $this->DatabaseHelper->save("HdIntPrplPrintingBatch", $a);
                    unset($a);
                    // END SAVE DATA
                }
            }

            // IF SAVE-BUTTON
            if($this->request->data["submit"] == "saveBatch"){

                $this->Flash->success(__('Batch succesvol opgeslagen'));
                return $this->redirect(['action' => 'index']);

            }else{

                return $this->redirect(['action' => 'showBatch']);

            }



        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function setDate()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $aPost = $this->request->data;

            $this->loadComponent("DatabaseHelper");

            // UPDATE TIME IN DB
            $aPost["end_date_late"] = new Time($aPost["end_date_late"]);
            $a["end_date_late"] = $aPost["end_date_late"]->format('Y-m-d');
            $a["id"] = $this->DatabaseHelper->checkRecord("HdIntPrplPrinting", "order_nrint", $aPost["order_nrint"], "id");
            $this->DatabaseHelper->save("HdIntPrplPrinting", $a);
            unset($a);


            // MAKE LOG
            $this->loadComponent('Log');
            $this->Log->createLogEntry($aPost["order_nrint"], 'general', 'Order is vertraagd. Nieuwe datum: '.$aPost["end_date_late"]->format('d-m-Y'), "", key($_SESSION['adminlogin']['name_user']), 0);

//            // MAKE ANNOUNCEMENT
//            $this->loadComponent('Announcement');
//            $this->Announcement->makeOrderAnnouncement(
//                $this->request->data["order_nrint"],
//                "Verzenddatum DRUKKERIJ gewijzigd",
//                "Order is vertraagd. Nieuwe datum: ".$aPost["end_date_late"]->format('d-m-Y'),
//                key($_SESSION['adminlogin']['name_user']),
//                0
//            );



            $this->Flash->success(__('Leverdatum aangepast'));
            return $this->redirect(['action' => 'index']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function showBatch()
    {
        $this->loadModel("HdIntPrplExceptionrules");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel('HdIntPrplPrintingBatch');
        $this->loadModel('HdIntPrplPrinting');

        $sPrinterNrint = $this->request->session()->read("adminlogin")["supplier_nrint"] == "" ? $this->request->session()->read("printer") : $this->request->session()->read("adminlogin")["supplier_nrint"];

        $aBatch = $this->HdIntPrplPrintingBatch->getAllPrintingBatchOrders($sPrinterNrint);
        $aPrinting = $this->HdIntPrplPrinting->getPrintingDataByOrder($aBatch);
        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();
        $aEditie = $this->HdIntPrplArticleEditions->getEditions();

        $this->set('aPrinting', $aPrinting);
        $this->set('aBatch', $aBatch);
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);
    }

    private function groupOrdersByPalletNo($p_aPostData){
        $aOrders = [];

        foreach($p_aPostData["pallets"] as $k => $v){
            $aOrders[] = $k;
            $pallets = explode(",", $v);
            foreach($pallets as $vv){
                $pal[$vv][] = $k;
            }
        }
        ksort($pal);
        foreach($pal as $k => $v){
            $aPal[$k] = $v;
        }

        return $aPal;
    }

    public function saveBatchToPackaging()
    {
        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $aPost = $this->request->data;

            $this->loadModel('HdIntPrplPrintingBatch');
            $this->loadModel('HdIntPrplPrinting');

            $this->loadComponent("DatabaseHelper");

            $aPallets = $this->groupOrdersByPalletNo($aPost);

            $sPrinterNrint = $this->request->session()->read("adminlogin")["supplier_nrint"] == "" ? $this->request->session()->read("printer") : $this->request->session()->read("adminlogin")["supplier_nrint"];

            $aOrders = $this->HdIntPrplPrintingBatch->getAllPrintingBatchOrders($sPrinterNrint);
            $aPrinting = $this->HdIntPrplPrinting->getPrintingDataByOrder($aOrders);

            $aPdfLines = array();

            foreach($aOrders as $k => $item){
                $a["id"] = $aPrinting[$k]["id"];
                $a["end_quantity"] = $item["quantity"];
                $a["done_date"] = date('Y-m-d');

                // SAVE DATA
                $this->DatabaseHelper->save("HdIntPrplPrinting", $a);
                unset($a);
                // END SAVE DATA


                $a["id"] = $item['HdIntPrplViewItem']["HdIntPrplGeneral"]["id"];
                $a["order_quantity_new"] = $item["quantity"];
                // SAVE DATA
                $this->DatabaseHelper->save("HdIntPrplGeneral", $a);
                unset($a);
                // END SAVE DATA



                // ADD DATA TO ARRAY
                $item["HdIntPrplViewItem"]["end_date"] = date('Y-m-d');
                $item["HdIntPrplViewItem"]["end_quantity"] = $item["quantity"];

                if(in_array($item["HdIntPrplViewItem"]["ledger_code"], ["8009","8005","8006"]) !== false){

                    // MUTATE STATUS
                    $this->loadComponent('MutateStatus');
                    $this->MutateStatus->mutateOrderStatus($item['HdIntPrplViewItem']['orderrule_id'], key($_SESSION['adminlogin']['name_user']), 0, 1, 99);

                    // CREATE LOG
                    $this->loadComponent('Log');
                    $this->Log->createLogEntry($item['HdIntPrplViewItem']['orderrule_id'], 'general', 'Drukwerk gereed', "", key($_SESSION['adminlogin']['name_user']), 1);

                    // VERPAKKINGSLEVERING
                    $a["id"] = 0;
                    $a["order_nrint"] = $item['HdIntPrplViewItem']['orderrule_id'];
                    $a["start_quantity"] = $a["end_quantity"] = $item["quantity"];
                    $a["start_date"] = $a["end_date"] = $a["packaging_delivered_date"] = date('Y-m-d');
                    $a["packaging_delivered"] = 1;
                    $this->DatabaseHelper->save("hd_int_prpl_packaging", $a);
                    unset($a);

                    // DEELLEVERING VOOR INSLAAN
                    $a["id"] = 0;
                    $a["order_nrint"] = $item['HdIntPrplViewItem']['orderrule_id'];
                    $a["send_date"] = date('Y-m-d');
                    $this->DatabaseHelper->save("hd_int_prpl_partial_delivery", $a);
                    unset($a);

                }else{
                    $aPdfLines[$item['HdIntPrplViewItem']['orderrule_id']] = $item;
                    $aPdfLines[$item['HdIntPrplViewItem']['orderrule_id']]->pallets = $aPost["pallets"][$item['HdIntPrplViewItem']['orderrule_id']];

                    // MUTATE STATUS
                    $this->loadComponent('MutateStatus');
                    $this->MutateStatus->mutateOrderStatus($item['HdIntPrplViewItem']['orderrule_id'], key($_SESSION['adminlogin']['name_user']), 0, 0, 102);

                    // CREATE LOG
                    $this->loadComponent('Log');
                    $this->Log->createLogEntry($item['HdIntPrplViewItem']['orderrule_id'], 'general', 'Drukwerk verstuurd naar Polen', "", key($_SESSION['adminlogin']['name_user']), 1);
                }


            }

            // MAKE PDF
            $this->loadComponent('HTML2PDF');
            $sFilePath = $this->HTML2PDF->makePalletslips('Packinglist', $aPdfLines, $aPallets, "F", 'palletlists');

//            die();
//            $aDataPDF = $this->HTML2PDF->convertDataToRows($aPdfLines);
//            $aDataPDF["company_name"] = "Verpakker";
//            $sHTML = $this->HTML2PDF->loadTemplate("sendOrdersToPrinterSendList", $aDataPDF); // NAAM PDF EMAIL:: WEBROOT/pdf/html_templates/
//            $this->HTML2PDF->setTitle(time());
//            $sFilePath = $this->HTML2PDF->makePDF("Orders naar verpakker", $sHTML, "S", 'to_printer_send_list'); // MAP OPSLAG PDF:: WEBROOT/pdf/
//
//            ob_end_flush();
//            die();

            $email = new Email();
            $email->from(['logistiek@hodi-international.nl' => 'Logistiek - Hodi International'])
                //->to('mike@hd-it.nl', 'Mike Gerritsen')
                ->to('logistiek@hodi-international.nl', 'Logistiek - Hodi International')
                ->cc('tompak1@vp.pl', 'Tompak')
                ->bcc('mike@hd-it.nl', 'Mike Gerritsen')
                ->subject('Aanmelding nieuw verpakkingswerk')
                ->viewVars(['company_name' => 'drukkerij'])
                ->template('to_printer_send_list') // NAAM TEMPLATE EMAIL:: APP/Template/Email/html/
                ->emailFormat('html')
                ->attachments([$sFilePath]);
//            if($this->request->data("submit") == "ok_send"){
            $this->loadModel("FRbkhADRES");



//            $aCustomer = $this->FRbkhADRES->get($sPrinterNrint);
//            if($aCustomer["BKHADEMAIL"] != "") {
//                $mailadres = explode(";", $aCustomer["BKHADEMAIL"]);
//                foreach ($mailadres as $mail) {
//                    $email->addTo(trim($mail), $aCustomer["BKHADNAAM"]);
//                    //echo $mail;
//                }
//            }

            $aCustomer = $this->FRbkhADRES->get($sPrinterNrint);
            $this->loadModel("FRbkhCONTACT");
            $aContacts = $this->FRbkhCONTACT->getContactsByAddressNrint($sPrinterNrint, "PAK");
            foreach($aContacts as $mail){
                if(trim($mail["BKHCOEMAIL"]) != ""){
                    $name = $mail["BKHCOTOTAALNAAM"] != "" ? $mail["BKHCOTOTAALNAAM"] : $aCustomer["BKHADNAAM"];
                    $email->addTo(trim($mail["BKHCOEMAIL"]), $name);
//                        echo trim($mail["BKHCOEMAIL"])."<br />".$name."<hr />";
                }

            }

//            }
            $email->send();

            // LEEG BATCH
            $this->DatabaseHelper->delete("HdIntPrplPrintingBatch", ["adres_nrint" => $this->request->session()->read("printer")]);

            // SESSIE DRUKKERIJ VERWIJDEREN             TIJDELIJK !!!
            $this->request->session()->delete('printer');


            $this->Flash->success(__('Batch aangemeld bij verpakker'));
            return $this->redirect(['action' => 'index']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'showBatch']);
        }
    }

    public function setSession(){
        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            if($this->request->data["printer_nrint"] == ""){
                $this->request->session()->delete('printer');
            }else{
                $this->request->session()->write('printer', $this->request->data["printer_nrint"]);
            }

            return $this->redirect(['action' => 'index']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'showBatch']);
        }
    }


    public function menu(){

    }
}
