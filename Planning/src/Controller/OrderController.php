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
use Cake\I18n\Time;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\I18n\Date;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class OrderController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index($p_sOrderNrint){

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
        $aDeliveryDate = $this->HdIntPrplViewDeliveryDate->find()->where(["orderrule_id" => $p_sOrderNrint])->first();
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

    public function setReprint($p_sOrderNrint){

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {
            $this->loadModel('HdIntPrplGeneral');
            $query = $this->HdIntPrplGeneral->query();

            // CONTROLEER OF GENERAL BESTAAT
            if(count($this->HdIntPrplGeneral->getByOrderLineId($p_sOrderNrint)) > 0){

                $this->loadComponent("DatabaseHelper");

                $a["id"] = $this->request->data["general_id"];
                $a["reprint"] = 1;
                $a["fsc_order"] = isset($this->request->data["fsc_order"]) ? $this->request->data["fsc_order"] : 0;
                $a["priority"] = isset($this->request->data["priority"]) ? $this->request->data["priority"] : 0;
                $a["napkin_nrint"] = $this->request->data["napkin_nrint"];
                $a["box_nrint"] = $this->request->data["box_nrint"];
                $a["article_editions"] = isset($this->request->data["article_editions"]) ? $this->request->data["article_editions"] : "";
                $a["article_box_quantity"] = $this->request->data["article_box_quantity"];
                $a["order_remarks"] = $this->request->data["order_remarks"];

                $this->DatabaseHelper->save('HdIntPrplGeneral', $a);

                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 1, 8);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'general', 'Order is een ongewijzigde herdruk', "", key($_SESSION['adminlogin']['name_user']), 1);

                $this->Flash->success(__("Order is gemarkeerd als ongewijzigde herdruk"));
                return $this->redirect(['action' => 'index', $p_sOrderNrint]);
            }else{

                // NEE ?? WEGWEZEN !!
                $this->Flash->error(__('General-record bestaat niet'));
                return $this->redirect(['action' => 'index', $p_sOrderNrint]);
            }

        }
        // ANDERS METEEN WEG !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);
        }


    }

    public function instructions($p_sOrderNrint)
    {
        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplNapkins");
        $this->loadModel("HdIntPrplBoxes");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel('HdIntPrplLog');
        $this->loadModel('HdIntPrplStatus');
        $this->loadModel('HdIntPrplPrepress');

        $aOrder = $this->HdIntPrplViewItem->getOrder($p_sOrderNrint);
        $aNapkin = $this->HdIntPrplNapkins->find();
        $aBox = $this->HdIntPrplBoxes->find();
        $aEdition = $this->HdIntPrplArticleEditions->find();
        $aLog = $this->HdIntPrplLog->getOrderLog($p_sOrderNrint);
        $aStatus = $this->HdIntPrplStatus->getStatus();
        $aPrepress = $this->HdIntPrplPrepress->getPrepress($p_sOrderNrint);

        $this->set("aOrder", $aOrder);
        $this->set("aNapkin", $aNapkin);
        $this->set("aBox", $aBox);
        $this->set("aEdition", $aEdition);
        $this->set("aLog", $aLog);
        $this->set("aStatus", $aStatus);
        $this->set("aPrepress", $aPrepress);
    }

    public function savePrepressForm($p_sOrderNrint){

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {
            $this->loadModel("HdIntPrplGeneral");
            $order = $this->HdIntPrplGeneral->getByOrderLineId($this->request->data["order_nrint"]);
            if($this->request->data["prepress_distributer_logo"] == "0" && $this->request->data["prepress_product_logo"] == "0"){
                if($order->general_status < 100) {
                    $this->Flash->error(__('U moet een distributeurslogo OF merklogo kiezen !!'));
                    echo "<script>history.go(-1);</script>";
                    die();
                }
            }

            //$this->loadModel('Prepress');
            $this->loadComponent('DatabaseHelper');

            // GENERAL WEGSCHRIJVEN
            $a["id"] = $this->request->data["general_id"];
            $a["order_nrint"] = $this->request->data["order_nrint"];
            $a["fsc_order"] = isset($this->request->data["fsc_order"]) ? $this->request->data["fsc_order"] : 0;
            $a["priority"] = isset($this->request->data["priority"]) ? $this->request->data["priority"] : 0;
            $a["napkin_nrint"] = $this->request->data["napkin_nrint"];
            $a["box_nrint"] = $this->request->data["box_nrint"];
            $a["article_editions"] = isset($this->request->data["article_editions"]) ? $this->request->data["article_editions"] : "";
            $a["article_box_quantity"] = $this->request->data["article_box_quantity"];
            $a["order_remarks"] = $this->request->data["order_remarks"];

            //debug($a); die();

            $this->DatabaseHelper->save('HdIntPrplGeneral', $a);
            unset($a);

            $a["id"] = $iPrepressID = $this->request->data["prepress_id"];
            $a["order_nrint"] = $this->request->data["order_nrint"];
            $a["order_type"] = $this->request->data["order_type"];

            unset(  $this->request->data["general_id"],
                    $this->request->data["prepress_id"],
                    $this->request->data["order_nrint"],
                    $this->request->data["fsc_order"],
                    $this->request->data["priority"],
                    $this->request->data["napkin_nrint"],
                    $this->request->data["box_nrint"],
                    $this->request->data["article_editions"],
                    $this->request->data["article_box_quantity"],
                    $this->request->data["order_remarks"],
                    $this->request->data["order_type"]
            );

            // FORCE CHECKBOXES
            if($order->general_status < 100) {
                $this->request->data["prepress_logo_front"] = isset($this->request->data["prepress_logo_front"]) ? $this->request->data["prepress_logo_front"] : 0;
                $this->request->data["prepress_photo_front"] = isset($this->request->data["prepress_photo_front"]) ? $this->request->data["prepress_photo_front"] : 0;
                $this->request->data["prepress_logo_back"] = isset($this->request->data["prepress_logo_back"]) ? $this->request->data["prepress_logo_back"] : 0;
                $this->request->data["prepress_photo_back"] = isset($this->request->data["prepress_photo_back"]) ? $this->request->data["prepress_photo_back"] : 0;
                $this->request->data["prepress_distributer_logo"] = isset($this->request->data["prepress_distributer_logo"]) ? $this->request->data["prepress_distributer_logo"] : 0;
                $this->request->data["prepress_product_logo"] = isset($this->request->data["prepress_product_logo"]) ? $this->request->data["prepress_product_logo"] : 0;

                $listID = $this->DatabaseHelper->save('HdIntPrplPrepressInstructions', $this->request->data);


                $a["prepress_form_id"] = $listID;
                $this->DatabaseHelper->save('HdIntPrplPrepress', $a);
                unset($a);
            }
            // CHECK FOR NEW ENTRY OR UPDATE
            $sTypeSave = "bijgewerkt";
            $iOrderTable = 0;
            if($iPrepressID == 0) {
                $sTypeSave = "opgeslagen";
                $iOrderTable = 1;

                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 2);
            }

            // CREATE LOG
            $this->loadComponent('Log');
            $this->Log->createLogEntry($p_sOrderNrint, 'general', 'Prepress-instructies '.$sTypeSave, "", key($_SESSION['adminlogin']['name_user']), $iOrderTable);

            $this->Flash->success(__('Prepressformulier '.$sTypeSave));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);

        }
        // ANDERS METEEN WEG !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'Instructions', $p_sOrderNrint]);
        }


    }

    public function saveStudioAnswer($p_sOrderNrint){

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $iStatus = $this->studioSwitchStatus($this->request->data["submit"]);

            // CHECK IF ORDER = DONE || ORDER = AFGEKEURD
            if($this->request->data["submit"] == "afgekeurd"){
                $bStatusRollback = 1;
                $sUpdateValue = -1;
            }else{
                $bStatusRollback = 0;
                $sUpdateValue = 1;

                if($this->request->data["submit"] == "done_2") {
                    $sItem = "Design voorstel gemaakt door studio";
                }elseif($this->request->data["submit"] == "done_5") {
                    $sItem = "Drukproef gemaakt door studio";
                }elseif($this->request->data["submit"] == "done_8") {
                    $sItem = "Bestand gecertificeerd en ge&uuml;pload";
                }
            }

            // DEFINIEER UPDATEVELD PREPRESS
            $this->loadModel('HdIntPrplPrepress');
            $this->loadComponent("DatabaseHelper");
            $aPrepress = $this->HdIntPrplPrepress->getPrepress($p_sOrderNrint);

            if($this->request->data["submit"] == "done_2" && isset($this->request->data["direct_proof"]) && !isset($this->request->data["direct_upload"])){
                $b["id"] = $aPrepress->HdIntPrplPrepressInstructions->id;
                $b["direct_proof"] = 1;
                $this->DatabaseHelper->save("HdIntPrplPrepressInstructions", $b);
                unset($b);
            }

            // SLA ALLES OP
            if((!$aPrepress && $this->request->data["submit"] == "done_8") || ($this->request->data["submit"] == "done_2" && isset($this->request->data["direct_upload"]))){
                $a["id"] = !$aPrepress ? 0 : $aPrepress["id"];
                $a["order_nrint"] = $p_sOrderNrint;
                $a["prepress_form_id"] = 0;
                $a["prepress_artwork_edit"] = 1;
                $a["prepress_artwork_ok"] = 1;
                $a["prepress_artwork_to_customer"] = 1;
                $a["prepress_drukproof_edit"] = 1;
                $a["prepress_drukproof_ok"] = 1;
                $a["prepress_drukproof_to_customer"] = 1;
                $a["prepress_done"] = 1;
            }elseif($this->request->data["submit"] == "done_5" && isset($this->request->data["direct_upload"])){
                $a["id"] = $aPrepress["id"];
                $a["prepress_drukproof_ok"] = 1;
                $a["prepress_drukproof_to_customer"] = 1;
                $a["prepress_done"] = 1;
                $a["prepress_drukproof_ok"] = 1;
                $a["prepress_done_date"] = date('Y-m-d');
            }elseif($this->request->data["submit"] == "done_2" && isset($this->request->data["direct_proof"])){
                $a["id"] = $aPrepress["id"];
                $a["prepress_artwork_edit"] = 1;
                $a["prepress_artwork_ok"] = 1;
                $a["prepress_artwork_to_customer"] = 1;
                $a["prepress_drukproof_ok"] = 1;

                $iStatus = 6;
            }else{
                $sUpdateField = $this->studioSwitch($aPrepress);

                $a["id"] = $aPrepress["id"];
                $a[$sUpdateField] = $sUpdateValue;
            }

            $this->DatabaseHelper->save("HdIntPrplPrepress", $a);
            unset($a);

            // MUTATE STATUS
            if(isset($this->request->data["direct_upload"])) {
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 1, 100);
            }else{
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), $bStatusRollback, 1, $iStatus);
            }


            // CREATE LOG IF AFGEKEURD
            if($bStatusRollback == 1){
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'prepress', 'Artwork afgekeurd door studio', $this->request->data["studio_msg"], key($_SESSION['adminlogin']['name_user']), 1);
            }else{
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'prepress', $sItem, $this->request->data["studio_msg"], key($_SESSION['adminlogin']['name_user']), 1);
            }

            return $this->redirect(['controller' => 'Studio', 'action' => 'index']);

        }
        // ANDERS METEEN WEG !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'Instructions', $p_sOrderNrint]);
        }


    }

    private function studioSwitch($p_aPrepressObject){

        $aCheckFields = array('prepress_artwork_ok', 'prepress_drukproof_ok', 'prepress_done');
        $aPrepress = $p_aPrepressObject;

        foreach($aCheckFields as $sField){
            if($aPrepress[$sField] != 1){
                return $sField;
            }
        }

        return 'prepress_done';

    }

    private function studioSwitchStatus($p_sSubmitName){

        switch($p_sSubmitName){
            case "done_2":
                return 3;
            case "done_5":
                return 6;
            case "afgekeurd":
                return 1;
        }
        return 100;

    }

    public function newArtwork($p_sOrderNrint){

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $this->loadModel('HdIntPrplPrepress');
            $this->loadComponent('DatabaseHelper');
            $aPrepress = $this->HdIntPrplPrepress->get($p_sOrderNrint);

            $a["id"] = $aPrepress["id"];
            $a["prepress_artwork_ok"] = 0;
            $this->DatabaseHelper->save("HdIntPrplPrepress", $a);
            unset($a);

            // MUTATE STATUS
            $this->loadComponent('MutateStatus');
            $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 2);

            // CREATE LOG
            $this->loadComponent('Log');
            $this->Log->createLogEntry($p_sOrderNrint, 'prepress', 'Nieuw artwork aangeleverd', $this->request->data["sales_msg"], key($_SESSION['adminlogin']['name_user']));

            $this->Flash->success(__('Status van de order succesvol bijgewerkt'));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);

        }
        // ANDERS METEEN WEG !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'Instructions', $p_sOrderNrint]);
        }


    }

    public function sendArtworkToCustomer($p_sOrderNrint, $p_iTime, $p_bReminder = 0){

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $iMutateTime = $p_iTime+1;
            $oDateTime = new Date();
            $newDate = $oDateTime->modify("+".$iMutateTime." days");

            // PREPRESS UPDATE
            $this->loadModel("HdIntPrplPrepress");
            $aPrepress = $this->HdIntPrplPrepress->getPrepress($p_sOrderNrint);
            $a["id"] = $aPrepress["id"];
            $a["prepress_artwork_to_customer"] = -1;
            $a["prepress_artwork_retour_date"] = $newDate->format('Y-m-d');

            $this->loadComponent("DatabaseHelper");
            $this->DatabaseHelper->save("HdIntPrplPrepress", $a);
            unset($a);

            if($p_bReminder == 0){
                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 4);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'general', 'Design voorstel verstuurd naar klant', "Klant heeft bedenktijd tot ".$newDate->format('d-m-Y'), key($_SESSION['adminlogin']['name_user']), 1, $newDate->format('Y-m-d'));

                $this->Flash->success(__('Status van de order succesvol bijgewerkt'));
            }else{
                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'general', 'Reminder design verstuurd naar klant', "Klant heeft bedenktijd tot ".$newDate->format('d-m-Y'), key($_SESSION['adminlogin']['name_user']), 1, $newDate->format('Y-m-d'));

                $this->Flash->success(__('Melding van reminder design aangemaakt'));
            }


            return $this->redirect(['action' => 'index', $p_sOrderNrint]);

        }
        // ANDERS METEEN WEG !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);
        }


    }



    public function saveDeliveryAddress ($p_sOrderNrint, $p_iId){

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $this->loadComponent("DatabaseHelper");

            $a["id"] = $p_iId;
            $a["deliver_hodi"] = $this->request->data["deliveryHodi"];

            $this->DatabaseHelper->save("HdIntPrplGeneral", $a);
            unset($b);

            $this->Flash->success(__('Afleveradres bijgewerkt'));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);

        }
        // ANDERS METEEN WEG !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);
        }


    }




    public function customerDesignAnswer ($p_sOrderNrint, $p_bAnswer){

    // PAGINA ALLEEN ALS "POST" OPENEN
    if ($this->request->is('post')) {

        // PREPRESS UPDATE
        $this->loadModel("HdIntPrplPrepress");
        $this->loadComponent("DatabaseHelper");

        $aPrepress = $this->HdIntPrplPrepress->getPrepress($p_sOrderNrint);
        $a["id"] = $aPrepress["id"];
        $a["prepress_artwork_to_customer"] = $p_bAnswer;

        // AKKOORD !!
        if($p_bAnswer == 1 || $p_bAnswer == 2){

            if($aPrepress["Instructions"]["direct_proof"] == "1" || $p_bAnswer == 2){

                $b["id"] = $aPrepress["HdIntPrplPrepressInstructions"]["id"];
                $b["direct_proof"] = "0";
                $this->DatabaseHelper->save("HdIntPrplPrepressInstructions", $b);
                unset($b);

                $b["id"] = $aPrepress["id"];
                $b["prepress_artwork_to_customer"] = "1";
                $b["prepress_drukproof_to_customer"] = "1";
                $this->DatabaseHelper->save("HdIntPrplPrepress", $b);
                unset($b);

                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 8);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'prepress', 'Design en proefdruk akkoord', $this->request->data["sales_msg"], key($_SESSION['adminlogin']['name_user']), 1);

            }else{

                $b["id"] = $aPrepress["id"];
                $b["prepress_artwork_to_customer"] = "1";
                $this->DatabaseHelper->save("HdIntPrplPrepress", $b);
                unset($b);

                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 5);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'prepress', 'Design voorstel akkoord', $this->request->data["sales_msg"], key($_SESSION['adminlogin']['name_user']), 1);

            }



        }else{

            $b["id"] = $aPrepress["HdIntPrplPrepressInstructions"]["id"];
            $b["direct_proof"] = "0";
            $this->DatabaseHelper->save("HdIntPrplPrepressInstructions", $b);
            unset($b);

            // ARTWORK NOT OK
            $a["prepress_artwork_ok"] = 0;

            // MUTATE STATUS
            $this->loadComponent('MutateStatus');
            $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 2);

            // CREATE LOG
            $this->loadComponent('Log');
            $this->Log->createLogEntry($p_sOrderNrint, 'prepress', 'Design voorstel afgewezen door klant', $this->request->data["sales_msg"], key($_SESSION['adminlogin']['name_user']), 1);

        }

        $this->DatabaseHelper->save("HdIntPrplPrepress", $a);
        unset($a);

        $this->Flash->success(__('Status van de order succesvol bijgewerkt'));
        return $this->redirect(['action' => 'index', $p_sOrderNrint]);

    }
    // ANDERS METEEN WEG !!
    else{
        $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
        return $this->redirect(['action' => 'index', $p_sOrderNrint]);
    }


}

    public function sendProofToCustomer($p_sOrderNrint, $p_iTime, $p_bReminder = 0){

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $iMutateTime = $p_iTime+1;
            $oDateTime = new Date();
            $newDate = $oDateTime->modify("+".$iMutateTime." days");

            // PREPRESS UPDATE
            $this->loadModel("HdIntPrplPrepress");
            $aPrepress = $this->HdIntPrplPrepress->getPrepress($p_sOrderNrint);
            $a["id"] = $aPrepress["id"];
            $a["prepress_drukproof_to_customer"] = -1;
            $a["prepress_drukproof_retour_date"] = $newDate->format('Y-m-d');

            $this->loadComponent("DatabaseHelper");
            $this->DatabaseHelper->save("HdIntPrplPrepress", $a);
            unset($a);

            if($p_bReminder == 0){
                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 7);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'general', 'Drukproef verstuurd naar klant', "Klant heeft bedenktijd tot ".$newDate->format('d-m-Y'), key($_SESSION['adminlogin']['name_user']), 1, $newDate->format('Y-m-d'));

                $this->Flash->success(__('Status van de order succesvol bijgewerkt'));
            }else{
                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'general', 'Reminder drukproef naar klant verstuurd', "Klant heeft bedenktijd tot ".$newDate->format('d-m-Y'), key($_SESSION['adminlogin']['name_user']), 1, $newDate->format('Y-m-d'));

                $this->Flash->success(__('Melding van reminder drukproef aangemaakt'));
            }

            return $this->redirect(['action' => 'index', $p_sOrderNrint]);

        }
        // ANDERS METEEN WEG !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);
        }


    }

    public function customerProofAnswer ($p_sOrderNrint, $p_bAnswer){

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            // PREPRESS UPDATE
            $this->loadModel("HdIntPrplPrepress");
            $this->loadComponent("DatabaseHelper");

            $aPrepress = $this->HdIntPrplPrepress->getPrepress($p_sOrderNrint);
            $a["id"] = $aPrepress["id"];
            $a["prepress_drukproof_to_customer"] = $p_bAnswer;

            // AKKOORD !!
            if($p_bAnswer == 1){

                $this->loadModel("HdIntPrplGeneral");
                $aOrder = $this->HdIntPrplGeneral->getByOrderLineId($p_sOrderNrint);
                if($aOrder["ledger_code"] == "8009"){
                    // MUTATE STATUS
                    $this->loadComponent('MutateStatus');
                    $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 1, 100);
                }else{
                    // MUTATE STATUS
                    $this->loadComponent('MutateStatus');
                    $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 8);
                }

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'general', 'Drukproef akkoord', "", key($_SESSION['adminlogin']['name_user']), 1);

            }else{

                // ARTWORK NOT OK
                $a["prepress_drukproof_ok"] = 0;
                $a["prepress_artwork_ok"] = 0;
                $a["prepress_artwork_to_customer"] = 0;

                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($p_sOrderNrint, key($_SESSION['adminlogin']['name_user']), 0, 1, 2);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($p_sOrderNrint, 'prepress', 'Drukproef afgewezen door klant', $this->request->data["sales_msg"], key($_SESSION['adminlogin']['name_user']), 1);

                $b["id"] = $aPrepress["prepress_form_id"];
                $b["direct_proof"] = 0;
                $this->DatabaseHelper->save("HdIntPrplPrepressInstructions", $b);

            }

            $this->DatabaseHelper->save("HdIntPrplPrepress", $a);
            unset($a);

            $this->Flash->success(__('Status van de order succesvol bijgewerkt'));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);

        }
        // ANDERS METEEN WEG !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);
        }


    }

    public function saveRemarks($p_sOrderNrint){

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {
            $this->loadModel('HdIntPrplGeneral');

            $this->loadComponent("DatabaseHelper");

            $a["id"] = $this->request->data["id"];
            $a["order_remarks"] = $this->request->data["order_remarks"];

            $this->DatabaseHelper->save('HdIntPrplGeneral', $a);

            $this->Flash->success(__("Opmerking opgeslagen"));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);


        }
        // ANDERS METEEN WEG !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index', $p_sOrderNrint]);
        }


    }


    public function updateOrderQuantity($p_sOrderNrint){
        $this->loadModel('HdIntPrplViewItem');
        $aOrder = $this->HdIntPrplViewItem->getOrder($p_sOrderNrint);

        if ($aOrder["HdIntPrplGeneral"]["order_start_quantity"] != $aOrder["orderrule_quantity"]) {
            $a["id"] = $aOrder["HdIntPrplGeneral"]["id"];
            $a["order_start_quantity"] = $aOrder["orderrule_quantity"];
            $a["order_quantity_new"] = $aOrder["orderrule_quantity"];
            $this->loadComponent("DatabaseHelper");
            $this->DatabaseHelper->save("HdIntPrplGeneral", $a);
            unset($a);

            $this->Flash->success(__("Orderaantallen bijgewerkt"));
        }
        return $this->redirect(['action' => 'index', $p_sOrderNrint]);
    }


}
