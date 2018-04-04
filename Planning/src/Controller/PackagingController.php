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
use Cake\I18n\Date;
use Cake\Mailer\Email;
use Cake\I18n\Time;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PackagingController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */

    public function index(){
        $aStatus = [105];

        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplStatus");
        $this->loadModel("HdIntPrplExceptionrules");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel("FRbkhADRES");
        $this->loadModel("HdIntPrplNapkins");

        $this->loadComponent("Functions");

        $aStatusList = $this->HdIntPrplStatus->getStatus($aStatus);

        $aOrders = $this->HdIntPrplViewItem->getOrdersByStatus($aStatus);
        $aOrders->contain(["HdIntPrplPackaging"]);
        $aGrouped = $this->Functions->groupObjectByKey($aOrders, "adres_nrint", ["HdIntPrplPackaging"]);

        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();

        $aEditie = $this->HdIntPrplArticleEditions->getEditions();
        $aCompanies = $this->FRbkhADRES->getCompanyAddressList('packaging');
        $aCompany = $this->Functions->rebuildObjectToKey($aCompanies, "BKHADNRINT");


        // START COMPANY
        $this->loadModel('HdIntPrplPartialDelivery');
        $aPartial = $this->HdIntPrplPartialDelivery->groupPartialDeliveries($aOrders);
        // END COMPANY





        // START BATCH DATA
        $this->loadModel('HdIntPrplDeliveryBatch');
        $aBatch = $this->HdIntPrplDeliveryBatch->getAllDeliveryBatchData();

        $this->set('aOrders', $aOrders);
        $this->set('aGrouped', $aGrouped);
        $this->set('aStatusList', $aStatusList);
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);
        $this->set('aCompanies', $aCompanies);
        $this->set('aCompany', $aCompany);
        $this->set('aBatch', $aBatch);
//        $this->set('aPartial', $aPartial);
    }

    public function setDate()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $this->loadComponent("DatabaseHelper");

            // UPDATE TIME IN DB
            $this->request->data["end_date_late"] = new Time($this->request->data["end_date_late"]);
            $a["end_date_late"] = $this->request->data["end_date_late"]->format('Y-m-d');
            $a["id"] = $this->DatabaseHelper->checkRecord("HdIntPrplPackaging", "order_nrint", $this->request->data["order_nrint"], "id");
            $this->DatabaseHelper->save("HdIntPrplPackaging", $a);
            unset($a);


            // MAKE LOG
            $this->loadComponent('Log');
            $this->Log->createLogEntry($this->request->data["order_nrint"], 'general', 'Order is vertraagd. Nieuwe datum: '.$this->request->data["end_date_late"]->format('d-m-Y'), "", key($_SESSION['adminlogin']['name_user']), 0);


            $this->Flash->success(__('Leverdatum aangepast'));
            return $this->redirect(['action' => 'index']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function order($p_sOrderNrint)
    {
        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplNapkins");
        $this->loadModel("HdIntPrplBoxes");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel('HdIntPrplLog');
        $this->loadModel('HdIntPrplStatus');
        $this->loadModel('HdIntPrplExceptionrules');
        $this->loadModel('HdIntPrplViewDeliveryDate');
        $this->loadModel('HdIntPrplPrepress');
        $this->loadModel('HdIntPrplPackinglist');
        $this->loadModel('FRbkhEXLINES');

        $aOrder = $this->HdIntPrplViewItem->getOrder($p_sOrderNrint);
        $bStickerWebsite = $this->FRbkhEXLINES->checkStickerWebsite($aOrder->adres_id);
        $aNapkin = $this->HdIntPrplNapkins->find();
        $aBox = $this->HdIntPrplBoxes->find();
        $aEdition = $this->HdIntPrplArticleEditions->find();
        $aLog = $this->HdIntPrplLog->getOrderLog($p_sOrderNrint);
        $aStatus = $this->HdIntPrplStatus->getStatus();
        $aNotes = $this->HdIntPrplExceptionrules->getNotes($aOrder->adres_code);
        $aDeliveryDate = $this->HdIntPrplViewDeliveryDate->find()->where(["orderrule_id" => $p_sOrderNrint]);
        $aPrepress = $this->HdIntPrplPrepress->getPrepress($p_sOrderNrint);
        $aPackingLists = $this->HdIntPrplPackinglist->getPackingLists($p_sOrderNrint);

        $this->set("aOrder", $aOrder);
        $this->set("aNapkin", $aNapkin);
        $this->set("aBox", $aBox);
        $this->set("aEdition", $aEdition);
        $this->set("aLog", $aLog);
        $this->set("aStatus", $aStatus);
        $this->set("aNotes", $aNotes);
        $this->set("aDeliveryDate", $aDeliveryDate);
        $this->set("aPrepress", $aPrepress);
        $this->set("aPackingLists", $aPackingLists);
        $this->set("bStickerWebsite", $bStickerWebsite);
    }

    public function setSession($p_sName = ""){
        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $sName = ($p_sName == "") ? "packaging" : $p_sName;
            $sAction = ($p_sName == "") ? "index" : $p_sName;

            if($this->request->data["packaging_nrint"] == ""){
                $this->request->session()->delete($sName);
            }else{
                $this->request->session()->write($sName, $this->request->data["packaging_nrint"]);
            }

            return $this->redirect(['action' => $sAction]);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'showBatch']);
        }
    }


    public function toPack(){

        $aStatus = [104];

        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplStatus");
        $this->loadModel("HdIntPrplExceptionrules");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel("FRbkhADRES");
        $this->loadModel("HdIntPrplNapkins");

        $this->loadComponent("Functions");

        $aStatusList = $this->HdIntPrplStatus->getStatus($aStatus);

        $aOrders = $this->HdIntPrplViewItem->getOrdersByStatus($aStatus);
        $aGrouped = $this->Functions->groupObjectByKey($aOrders, "general_status", ["HdIntPrplGeneral"]);

        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();

        $aEditie = $this->HdIntPrplArticleEditions->getEditions();
        $aCompanies = $this->FRbkhADRES->getCompanyAddressList('packaging');

        $aNapkins = $this->HdIntPrplNapkins->find()->all();
        $aNapkins = $this->Functions->rebuildObjectToKey($aNapkins, "napkin_article_nrint");

        $this->set('aOrders', $aOrders);
        $this->set('aGrouped', $aGrouped);
        $this->set('aStatusList', $aStatusList);
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);
        $this->set('aCompanies', $aCompanies);
        $this->set('aNapkins', $aNapkins);

    }

    public function confirmPackagingOrder()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            if(count($this->request->data["order_nrint"]) > 0){
                $aProforma = array();
                $this->loadModel('HdIntPrplViewItem');
                $this->loadModel('FRbkhADRES');

                // HAAL ALLE BIJBEHORENDE ORDERS OP
                foreach($this->request->data["order_nrint"] as $nrint){
                    $oDateTime = new Date();
                    $aOrder = $this->HdIntPrplViewItem->getOrder($nrint);
                    $iModify = !is_null($aOrder->HdIntPrplGrootboekActief->delivery_homework) ? $aOrder->HdIntPrplGrootboekActief->delivery_homework : 14;
                    $aOrder["article_type"] = $aOrder->ledger_name;
                    $aOrder["newdate"] = $oDateTime->modify("+ ".$iModify." days");
                    $aProforma["Orders"][] = $aOrder;
                }

                // HAAL ADRESGEGEVENS DRUKKERIJ OP
                $aProforma["Packaging"] = $this->FRbkhADRES->get($this->request->data["company_nrint"], [
                    'contain' => ['HdIntPrplCompanies'],
                ])->toArray();

                $this->set('aProforma', $aProforma);
                $this->set('aPost', $this->request->data);

            }else{
                $this->Flash->error(__('U heeft geen orders geselecteerd'));
                return $this->redirect(['action' => 'ToPack']);
            }
        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function sendOrdersToPackaging()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            /*******************************************/
            /*  HIER MOET DE PDF-LIB NOG KOMEN !!!!!!  */
            /*******************************************/

            // DATABASEHELPER
            $this->loadModel("Orders");
            $this->loadComponent("DatabaseHelper");
            foreach($this->request->data["order_nrint"] as $k => $nrint){

                $a["id"] = 0;
                $a["order_nrint"] = $nrint;
                $a["adres_nrint"] = $this->request->data["packaging_nrint"];
                $a["start_date"] = date('Y-m-d');
                $a["end_date"] = $this->request->data["end_date"][$k];
                $a["start_quantity"] = $this->request->data["start_quantity"][$k];
                $a["email_send"] = $this->request->data["submit"] == 'ok_send' ? 1 : 0 ;

                // SAVE DATA
                $this->loadComponent("DatabaseHelper");
                $this->DatabaseHelper->save("HdIntPrplPackaging", $a);
                unset($a);
                // END SAVE DATA

                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($nrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 109);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($nrint, 'general', 'Halffabrikaten uitgegeven voor thuiswerk', $this->request->data["packaging_name"], key($_SESSION['adminlogin']['name_user']), 1, $this->request->data["end_date"][$k]);

            }

            $this->Flash->success(__('Orders succesvol aangeboden bij')." ".$this->request->data["packaging_name"]);
            return $this->redirect(['action' => 'ToPack']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function intake(){

        $aStatus = [109];

        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplStatus");
        $this->loadModel("HdIntPrplExceptionrules");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel("FRbkhADRES");
        $this->loadModel("HdIntPrplNapkins");

        $this->loadComponent("Functions");

        $aStatusList = $this->HdIntPrplStatus->getStatus($aStatus);

        $aOrders = $this->HdIntPrplViewItem->getOrdersByStatus($aStatus);
        $aOrders->contain(["HdIntPrplPackaging"]);
        $aGrouped = $this->Functions->groupObjectByKey($aOrders, "adres_nrint", ["HdIntPrplPackaging"]);

        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();

        $aEditie = $this->HdIntPrplArticleEditions->getEditions();
        $aCompanies = $this->FRbkhADRES->getCompanyAddressList('packaging');
        $aCompany = $this->Functions->rebuildObjectToKey($aCompanies, "BKHADNRINT");

        $this->set('aOrders', $aOrders);
        $this->set('aGrouped', $aGrouped);
        $this->set('aStatusList', $aStatusList);
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);
        $this->set('aCompanies', $aCompanies);
        $this->set('aCompany', $aCompany);

    }

    public function showIntakeList()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            if(count($this->request->data["order_nrint"]) > 0){
                $aProforma = array();
                $this->loadModel('HdIntPrplViewItem');
                $this->loadModel('FRbkhADRES');

                // HAAL ALLE BIJBEHORENDE ORDERS OP
                foreach($this->request->data["order_nrint"] as $nrint){
                    $oDateTime = new Date();
                    $aOrder = $this->HdIntPrplViewItem->getOrder($nrint);
                    $aOrder["article_type"] = $aOrder->ledger_name;
                    $aProforma["Orders"][] = $aOrder;
                }

                // HAAL ADRESGEGEVENS DRUKKERIJ OP
                $aProforma["Packaging"] = $this->FRbkhADRES->get($this->request->data["company_nrint"], [
                    'contain' => ['HdIntPrplCompanies'],
                ])->toArray();

                $this->set('aProforma', $aProforma);
                $this->set('aPost', $this->request->data);

            }else{
                $this->Flash->error(__('U heeft geen orders geselecteerd'));
                return $this->redirect(['action' => 'intake']);
            }
        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function confirmIntake()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            /*******************************************/
            /*  HIER MOET DE PDF-LIB NOG KOMEN !!!!!!  */
            /*******************************************/

            // DATABASEHELPER
            $this->loadModel("Orders");
            $this->loadModel("HdIntPrplPackaging");
            $this->loadComponent("DatabaseHelper");
            foreach($this->request->data["order_nrint"] as $k => $nrint){

                // VERWERK ONTVANGST
                $a["id"] = $this->request->data["packaging_id"][$k];
                $a["packaging_delivered"] = 1;
                $a["packaging_delivered_date"] = date('Y-m-d');
                $this->DatabaseHelper->save("HdIntPrplPackaging", $a);
                unset($a);

                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($nrint, key($_SESSION['adminlogin']['name_user']), 0,0, 105);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($nrint, 'general', 'Drukwerk aangekomen bij verpakker', "", key($_SESSION['adminlogin']['name_user']), 0);

            }

            $this->request->session()->delete('intake');

            $this->Flash->success(__('Ontvangst orders succesvol verwerkt'));
            return $this->redirect(['action' => 'intake']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'intake']);
        }
    }

    public function saveDeliveryBatch()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {
            $this->loadComponent("DatabaseHelper");

            // LEEG BATCH
            $this->DatabaseHelper->delete("HdIntPrplDeliveryBatch", ['adres_nrint' => $this->request->data["adres_nrint"][0]]);

            // SAVE ALL LINES IN BATCH QTY > 0
            foreach($this->request->data["order_nrint"] as $k => $nrint){
                if(intval($this->request->data["delivery_quantity"][$k]) > 0){
                    $a["id"] = 0;
                    $a["adres_nrint"] = $this->request->data["adres_nrint"][$k];
                    $a["order_nrint"] = $this->request->data["order_nrint"][$k];
                    $a["packaging_id"] = $this->request->data["packaging_id"][$k];
                    $a["quantity"] = $this->request->data["delivery_quantity"][$k];

                    // SAVE DATA
                    $this->DatabaseHelper->save("HdIntPrplDeliveryBatch", $a);
                    unset($a);
                    // END SAVE DATA
                }
            }

            // IF SAVE-BUTTON
            if($this->request->data["submit"] == "saveBatch"){

                $this->Flash->success(__('Batch succesvol opgeslagen'));
                return $this->redirect(['action' => 'index']);

            }else{

                return $this->redirect(['action' => 'showDeliveryBatch']);

            }



        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function showDeliveryBatch()
    {

        // START BATCH DATA
        $this->loadModel('HdIntPrplDeliveryBatch');
        $aBatch = $this->HdIntPrplDeliveryBatch->getAllDeliveryBatchOrders();

        $this->loadModel('HdIntPrplPartialDelivery');
        $aPartial = $this->HdIntPrplPartialDelivery->groupPartialDeliveries($aBatch);
        // END COMPANY

        $this->set('aBatch', $aBatch);
        $this->set('aPartial', $aPartial);
    }

    public function saveBatchToDeliver()
    {
        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            // START BATCH DATA
            $this->loadModel('HdIntPrplDeliveryBatch');
            $aOrders = $this->HdIntPrplDeliveryBatch->getAllDeliveryBatchOrders();
            // END COMPANY

            $this->loadComponent("DatabaseHelper");
            $this->loadComponent('HTML2PDF');
            $this->loadModel("HdIntPrplPackaging");
            $this->loadModel("FRbkhADRES");
            $this->loadModel("HdIntPrplSeptum");
            $this->loadModel("HdIntPrplNapkin");
            $this->loadModel("HdIntPrplBox");

            $i = 0;
            $aBatch = array();
            foreach($aOrders as $k => $item){
                $a["id"] = 0;
                $a["order_nrint"] = $item["HdIntPrplViewItem"]["orderrule_id"];
                $a["quantity_send"] = $item["quantity"];
                $a["send_date"] = date('Y-m-d');

                // SAVE DATA
                $partID = $this->DatabaseHelper->save("HdIntPrplPartialDelivery", $a);
                unset($a);
                // END SAVE DATA


                $this->loadModel('HdIntPrplPartialDelivery');
                $aPartGroup = $this->HdIntPrplPartialDelivery->groupPartialDeliveriesByOrder($item["HdIntPrplViewItem"]["orderrule_id"]);

                if($this->request->data["order_complete"][$i] == '1'){
                    $a['id'] = $this->request->data["packaging_id"][$i];
                    $a['done_date'] = date('Y-m-d');
                    $a['end_quantity'] = $aPartGroup["total_send"];
                    // SAVE DATA
                    $this->DatabaseHelper->save("HdIntPrplPackaging", $a);
                    unset($a);
                    // END SAVE DATA

                    $a["id"] = $item['HdIntPrplViewItem']["HdIntPrplGeneral"]["id"];
                    $a["order_quantity_new"] = $aPartGroup["total_send"];

                    // SAVE DATA
                    $this->DatabaseHelper->save("HdIntPrplGeneral", $a);
                    unset($a);
                    // END SAVE DATA

                    // MUTATE STATUS
                    $this->loadComponent('MutateStatus');
                    $this->MutateStatus->mutateOrderStatus($item["HdIntPrplViewItem"]["orderrule_id"], key($_SESSION['adminlogin']['name_user']), 0, 1, 110);
                }

                $this->loadModel("FRbkhADRESAFLEVER");
                $aAflever = $this->FRbkhADRESAFLEVER->get($item["HdIntPrplViewItem"]["afleveradres_id"], ["contain" => ["FRbkhLAND"]]);
                $country = strtolower($aAflever->FRbkhLAND->BKHLACODE);

                if($country == ""){
                    $this->loadModel("FRbkhLAND");
                    $aCountry = $this->FRbkhLAND->get($item["HdIntPrplViewItem"]["FRbkhADRES"]["BKHAD_BKHLANRINT"]);
                    $country = strtolower($aCountry->BKHLACODE);
                }

                /************** ****************/
                /**       PDF PAKBONNEN       **/
                /************** ****************/

                // KLANT PDF
                ob_start();
                $a = array("order_nrint" => $item["HdIntPrplViewItem"]["orderrule_id"], "quantity" => $item["quantity"]);

                $aDataPDF = $this->HTML2PDF->getDataPackagingList($a);
                $sHTML = $this->HTML2PDF->loadTemplate("sendPackagingListCustomer", $aDataPDF);
                $this->HTML2PDF->setTitle( (int) round(microtime(true)*1000));
                $sFilePath = $this->HTML2PDF->makePDF("Orders verstuurd naar drukkerij", $sHTML, "F", 'packaging_list_cust');

                // ADD TO BATCH FILE
                $aBatch[] = $aDataPDF;

                unset($a);

                // GET PACKER

                $aPack = $this->HdIntPrplPackaging->get($item["packaging_id"]);
                $aCust = $this->FRbkhADRES->get($aPack["adres_nrint"]);



                // SAVE PAKBON TO ORDER
                $a["id"] = 0;
                $a["order_nrint"] = $item["order"]["order_nrint"];
                $a["pdf_title"] = $this->HTML2PDF->getTitle();
                $packId = $this->DatabaseHelper->save("hd_int_prpl_packinglist", $a);
                unset($a);
                ob_end_flush();

                // CREATE LOG
                $this->loadComponent('Log');
                if($this->request->data["order_complete"][$i] == '1') {
                    $this->Log->createLogEntry($item['order']["ORDERREGELNRINT"], 'general', 'Order verzonden naar klant', "Definitief aantal: " . number_format($aPartGroup["total_send"], 0, ",", "."), key($_SESSION['adminlogin']['name_user']), 0);
                }else{
                    $this->Log->createLogEntry($item['order']["ORDERREGELNRINT"], 'general', 'Order verzonden naar klant', "Verstuurd: ".number_format($item["quantity"], 0, ",", ".")."<br />Nieuwe aantal: " . number_format($aPartGroup["total_send"], 0, ",", "."), key($_SESSION['adminlogin']['name_user']), 0);
                }


                if(
                    $aPack->adres_nrint == "BGR2F2Z2" &&
                    ($country == 'nl' || $country == 'be' || strpos(strtolower($aAflever->BKHAAFNAAM), "hodi") !== false) &&
                    in_array($item->adres_id, $this->m_aNoOrderNL) === false
                ){

                    // CREATE TRANSPORT LINE
                    $a['id'] = 0;
                    $a['partial_delivery_id'] = $partID;
                    $a['order_nrint'] = $item->order_nrint;
                    $a["wait_nl_date"] = date('Y-m-d');
                    $a["packinglist_id"] = $packId;
                    $this->DatabaseHelper->save('HdIntPrplTransport', $a);
                    unset($a);

                }



                $i++;

            }

            // BATCH PDF
            if(!empty($aBatch)) {
                ob_start();
                $aHtml = array();

                foreach($aBatch as $page) {
                    $sHTML = $this->HTML2PDF->loadTemplate("sendPackagingListCustomer", $page);
                    $aHtml[] = $sHTML;
                }
                //var_dump($aHtml); die();

                $this->HTML2PDF->setTitle((int)round(microtime(true) * 1000));
                $sFilePath = $this->HTML2PDF->makeArrayPDF("Orders verstuurd naar drukkerij", $aHtml, "F", 'packaging_list_batch');
                ob_end_flush();

                $email = new Email();
                $email->from(['logistiek@hodi-international.nl' => 'Logistiek - Hodi International'])
                    ->to('logistiek@hodi-international.nl', 'Logistiek - Hodi International')
                    ->addTo('tompak1@vp.pl', 'Tompak')
                    ->addTo('mike@hd-it.nl', 'Logistiek - Hodi International')
                    ->subject('PDF - Gereed product verzonden')
                    //->viewVars(['company_name' => $this->request->data["printer_name"]])
                    ->template('to_customer_pdf')
                    ->emailFormat('html')
                    ->attachments([$sFilePath]);

                /** UITGESCHAKELD ^MG 01-12-2017 **/
                $aCustomer = $aCust;
//                if ($aCustomer["BKHADEMAIL"] != "") {
//                    $mailadres = explode(";", $aCustomer["BKHADEMAIL"]);
//                    foreach ($mailadres as $mail) {
//                        $email->addTo(trim($mail), $aCust["BKHADNAAM"]);
//                        //echo $mail;
//                    }
//                    //$email->addTo(trim($aCustomer["BKHADEMAIL"]), $aCust["BKHADNAAM"]);
//                }

                $this->loadModel("FRbkhCONTACT");
                $aContacts = $this->FRbkhCONTACT->getContactsByAddressNrint($aPack->adres_nrint, "PAK");
                foreach($aContacts as $mail){
                    if(trim($mail["BKHCOEMAIL"]) != ""){
                        $name = $mail["BKHCOTOTAALNAAM"] != "" ? $mail["BKHCOTOTAALNAAM"] : $aCustomer["BKHADNAAM"];
                        $email->addTo(trim($mail["BKHCOEMAIL"]), $name);
//                        echo trim($mail["BKHCOEMAIL"])."<br />".$name."<hr />";
                    }

                }

                $email->send();
            }

            //die();
            // LEEG BATCH
            $this->DatabaseHelper->delete("HdIntPrplDeliveryBatch", [1 => 1]);

            $this->Flash->success(__('Aantallen in batch verwerkt'));
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
