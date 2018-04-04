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
use Cake\I18n\Date;
use Cake\I18n\Time;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PrepackagingController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index(){


        $aStatus = [102];

        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplStatus");
        $this->loadModel("HdIntPrplExceptionrules");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel("FRbkhADRES");

        $this->loadComponent("Functions");

        $aStatusList = $this->HdIntPrplStatus->getStatus($aStatus);

        $aOrders = $this->HdIntPrplViewItem->getOrdersByStatus($aStatus);
        $aOrders->contain(["HdIntPrplPrinting"]);
        $aOrders->contain(["HdIntPrplGeneral.HdIntPrplNapkins"]);
        $aGrouped = $this->Functions->groupObjectByKey($aOrders, "adres_nrint", ["HdIntPrplPrinting"]);

        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();

        $aEditie = $this->HdIntPrplArticleEditions->getEditions();
        $aCompanies = $this->FRbkhADRES->getCompanyAddressList('print');
        $aCompanies = $this->Functions->rebuildObjectToKey($aCompanies, "BKHADNRINT");

        $this->set('aOrders', $aOrders);
        $this->set('aGrouped', $aGrouped);
        $this->set('aStatusList', $aStatusList);
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);
        $this->set('aCompanies', $aCompanies);


    }

    public function confirmPackagingOrder()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $aPost = $this->request->data;

            if(count($aPost["order_nrint"]) > 0){
                $aProforma = array();
                $this->loadModel('HdIntPrplViewItem');
                $this->loadModel('FRbkhADRES');

                // HAAL ALLE BIJBEHORENDE ORDERS OP
                foreach($aPost["order_nrint"] as $nrint){
                    $oDateTime = new Date();
                    $aOrder = $this->HdIntPrplViewItem->getOrder($nrint);
                    $aProforma["Orders"][] = $aOrder;
                }

                // HAAL ADRESGEGEVENS DRUKKERIJ OP
                $aProforma["Printer"] = $this->FRbkhADRES->get($this->request->data["company_nrint"], [
                    'contain' => ['HdIntPrplCompanies'],
                ]);

                $this->set('aProforma', $aProforma);
                $this->set('aPost', $aPost);

            }else{
                $this->Flash->error(__('U heeft geen orders geselecteerd'));
                return $this->redirect(['action' => 'index']);
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

            $aPost = $this->request->data;

            // DATABASEHELPER
            $this->loadModel("HdIntPrplViewItem");
            $this->loadComponent("DatabaseHelper");

            foreach($this->request->data["order_nrint"] as $k => $nrint){

                // VERWERK NAAR : OP MACHINE
                $aOrder = $this->HdIntPrplViewItem->getOrder($nrint);

                if($aOrder["ledger_code"] == "8029" || $aOrder["ledger_code"] == "8040"){
                    // MUTATE STATUS
                    $this->loadComponent('MutateStatus');
                    $this->MutateStatus->mutateOrderStatus($nrint, key($_SESSION['adminlogin']['name_user']), 0, 1, 104);

                    // CREATE LOG
                    $this->loadComponent('Log');
                    $this->Log->createLogEntry($nrint, 'general', 'Drukwerk binnen en klaar voor uitgifte thuiswerk', "", key($_SESSION['adminlogin']['name_user']), 0);

                }else{
                    // MUTATE STATUS
                    $this->loadComponent('MutateStatus');
                    $this->MutateStatus->mutateOrderStatus($nrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 103);

                    $iModify = $aOrder["HdIntPrplGrootboekActief"]["delivery_machine"];

                    // CREATE MACHINE RECORD
                    $a["id"] = 0;
                    $a["order_nrint"] = $nrint;
                    $a["start_date"] = date('Y-m-d');
                    $a["end_date"] = date('Y-m-d', strtotime("+ ".$iModify." days"));
                    $this->DatabaseHelper->save("HdIntPrplMachine", $a);
                    unset($a);

                    // CREATE LOG
                    $this->loadComponent('Log');
                    $this->Log->createLogEntry($nrint, 'general', 'Drukwerk aangekomen bij productie', "", key($_SESSION['adminlogin']['name_user']), 0);

                }



            }

            $this->Flash->success(__('Orders succesvol aangeboden bij productie'));
            return $this->redirect(['action' => 'index']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function onMachine(){

        $aStatus = [103];

        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplStatus");
        $this->loadModel("HdIntPrplExceptionrules");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel("FRbkhADRES");
        $this->loadModel("HdIntPrplMachineBatch");

        $this->loadComponent("Functions");

        $aStatusList = $this->HdIntPrplStatus->getStatus($aStatus);

        $aOrders = $this->HdIntPrplViewItem->getOrdersByStatus($aStatus);
        $aOrders->contain(["HdIntPrplMachine"]);

        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();

        $aEditie = $this->HdIntPrplArticleEditions->getEditions();
        $aCompanies = $this->FRbkhADRES->getCompanyAddressList('print');
        $aCompanies = $this->Functions->rebuildObjectToKey($aCompanies, "BKHADNRINT");

        $aBatch = $this->HdIntPrplMachineBatch->getAllMachineBatchData();

        $this->set('aOrders', $aOrders);
        $this->set('aStatusList', $aStatusList);
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);
        $this->set('aCompanies', $aCompanies);
        $this->set('aBatch', $aBatch);
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
            $a["id"] = $this->DatabaseHelper->checkRecord("HdIntPrplMachine", "order_nrint", $aPost["order_nrint"], "id");
            $this->DatabaseHelper->save("HdIntPrplMachine", $a);
            unset($a);

            // MAKE LOG
            $this->loadComponent('Log');
            $this->Log->createLogEntry($aPost["order_nrint"], 'general', 'Order is vertraagd. Nieuwe datum: '.$aPost["end_date_late"]->format('d-m-Y'), "", key($_SESSION['adminlogin']['name_user']), 0);

            $this->Flash->success(__('Leverdatum aangepast'));
            return $this->redirect(['action' => 'onMachine']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function saveBatch()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {
            $this->loadComponent("DatabaseHelper");

            // LEEG BATCH
            $this->DatabaseHelper->delete("HdIntPrplMachineBatch", [1 => 1]);

            // SAVE ALL LINES IN BATCH QTY > 0
            foreach($this->request->data["order_nrint"] as $k => $nrint){
                if(intval($this->request->data["machine_quantity"][$k]) > 0){
                    $a["id"] = 0;
                    $a["order_nrint"] = $this->request->data["order_nrint"][$k];
                    $a["quantity"] = $this->request->data["machine_quantity"][$k];

                    // SAVE DATA
                    $this->DatabaseHelper->save("HdIntPrplMachineBatch", $a);
                    unset($a);
                    // END SAVE DATA
                }
            }

            // IF SAVE-BUTTON
            //pr($this->request->data); die();
            if($this->request->data["submit"] == "saveBatch"){

                $this->Flash->success(__('Batch succesvol opgeslagen'));
                return $this->redirect(['action' => 'onMachine']);

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

    public function showBatch()
    {

        $this->loadModel('HdIntPrplMachineBatch');
        $aBatch = $this->HdIntPrplMachineBatch->getAllMachineBatchOrders();

        $this->set('aBatch', $aBatch);
    }

    public function saveBatchToPack()
    {
        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            // START BATCH DATA
            $this->loadModel('HdIntPrplMachineBatch');
            $aOrders = $this->HdIntPrplMachineBatch->getAllMachineBatchOrders();
            // END COMPANY

            $this->loadComponent("DatabaseHelper");

            foreach($aOrders as $k => $item){

                $sCheckRecord = $this->DatabaseHelper->checkRecord("HdIntPrplMachineBatch", "order_nrint", $item["order_nrint"], "id");

                //debug($sCheckRecord); die();

                if($sCheckRecord !== false){
                    $a["id"] = $sCheckRecord;
                }else{
                    $a["id"] = 0;
                }
                $a["order_nrint"] = $item["order_nrint"];
                $a["start_quantity"] = $item["HdIntPrplViewItem"]["HdIntPrplGeneral"]["order_quantity_new"];
                $a["end_quantity"] = $item["quantity"];
                $a["done_date"] = date('Y-m-d');

                // SAVE DATA
                $this->DatabaseHelper->save("HdIntPrplMachine", $a);
                unset($a);
                // END SAVE DATA

                $a["id"] = $item["HdIntPrplViewItem"]["HdIntPrplGeneral"]["id"];
                $a["order_quantity_new"] = $item["quantity"];

                // SAVE DATA
                $this->DatabaseHelper->save("HdIntPrplGeneral", $a);
                unset($a);
                // END SAVE DATA

                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus( $item["HdIntPrplViewItem"]["orderrule_id"], key($_SESSION['adminlogin']['name_user']), 0, 0, 104);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($item["HdIntPrplViewItem"]["orderrule_id"], 'general', 'Order op machine geweest', "Nieuwe aantal: ".number_format($item["quantity"],0,",","."), key($_SESSION['adminlogin']['name_user']), 0);
            }

            // LEEG BATCH
            $this->DatabaseHelper->delete("HdIntPrplMachineBatch", [1 => 1]);

            $this->Flash->success(__('Aantallen in batch verwerkt'));
            return $this->redirect(['action' => 'OnMachine']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'showBatch']);
        }
    }
}
