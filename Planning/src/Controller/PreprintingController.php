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
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PreprintingController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index(){


        $aStatus = [100];

        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplStatus");
        $this->loadModel("HdIntPrplExceptionrules");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel("FRbkhADRES");

        $this->loadComponent("Functions");

        $aStatusList = $this->HdIntPrplStatus->getStatus($aStatus);

        $aOrders = $this->HdIntPrplViewItem->getOrdersByStatus($aStatus);
        $aGrouped = $this->Functions->groupObjectByKey($aOrders, "general_status", ["HdIntPrplGeneral"]);

        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();

        $aEditie = $this->HdIntPrplArticleEditions->getEditions();
        $aCompanies = $this->FRbkhADRES->getCompanyAddressList('print');

        $this->set('aOrders', $aOrders);
        $this->set('aGrouped', $aGrouped);
        $this->set('aStatusList', $aStatusList);
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);
        $this->set('aCompanies', $aCompanies);


    }
    public function _index()
    {

        // START STATUS
        $this->loadModel('Status');
        $status = $this->Status->find('all', [
            'conditions' => ['status_type' => 'preprint', 'hidden' => '0'],
        ])->toArray();

        $aStatus = array();

        foreach($status as $a){
            $aStatus[$a["id"]] = $a;
        }
        // END STATUS

        // START NOTES
        $this->loadModel("Note");
        $aNotes = $this->Note->getNotesGrouped();

        // START ORDERS
        $this->loadModel('Orders');
//        $orders = $this->Orders->find('all', [
//            'contain' => ['Orderrules', 'General', 'Customer'],
//        ])->toArray();
        $orders = $this->Orders->find('all')->toArray();

        $aOrders = array();

        foreach($orders as $ord){
            if(isset($aStatus[$ord["general_status"]])){
                $aOrders[] = $ord;
            }
        }
        // END ORDERS

        // START COMPANY
        $this->loadModel('Customer');
        $company = $this->Customer->find('all', [
            'contain' => ['Company'],
        ])->where(['company_type' => 'print'])->toArray();

        foreach($company as $comp){
            if($comp["company"]["adres_alias"] != "") {
                $comp["BKHADNAAM"] = $comp["company"]["adres_alias"];
            }
            $aCompany[$comp["BKHADNRINT"]] = $comp;
        }

        //$orders = $this->Orders->find('all')->toArray();
        // END COMPANY



        // START TELLERS
        $this->viewBuilder()->helpers(['Subcount']);
        // END TELLERS

        $this->set('aOrders', $aOrders);
        $this->set('aStatus', $aStatus);
        $this->set('aCompany', $aCompany);
        $this->set('aNotes', $aNotes);
    }

    public function confirmPrintingOrder()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            if(count($this->request->data["order_nrint"]) > 0){

                $aPost = $this->request->data;

                $aProforma = array();
                $this->loadModel('HdIntPrplViewItem');
                $this->loadModel('FRbkhADRES');

                //$aGrootboek = $this->HdGrootboekrekeningActive->getAllGrootboek();

                // HAAL ALLE BIJBEHORENDE ORDERS OP
                foreach($aPost["order_nrint"] as $nrint){
                    $oDateTime = new Date();
                    $aOrder = $this->HdIntPrplViewItem->getOrder($nrint);
                    $iModify = $aOrder->HdIntPrplGrootboekActief["delivery_printing"];
                    $aOrder["article_type"] = $aOrder["ledger_name"];
                    $aOrder["newdate"] = $oDateTime->modify("+ ".$iModify." days");
                    $aProforma["Orders"][] = $aOrder;
                }

                // HAAL ADRESGEGEVENS DRUKKERIJ OP
                $aProforma["Printer"] = $this->FRbkhADRES->get($aPost["company_nrint"], [
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

    public function sendOrdersToPrinter()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {



            $aPost = $this->request->data;

            // DATABASEHELPER
            $this->loadModel("HdIntPrplViewItem");
            $this->loadComponent("DatabaseHelper");
            foreach($aPost["order_nrint"] as $k => $nrint){

                $a["id"] = 0;
                $a["order_nrint"] = $nrint;
                $a["adres_nrint"] = $aPost["printer_nrint"];
                $a["start_quantity"] = $aPost["quantity"][$k];
                $a["start_date"] = date('Y-m-d');
                $a["end_date"] = $aPost["end_date"][$k];
                $a["email_send"] = $aPost["submit"] == 'ok_send' ? 1 : 0 ;

                // SAVE DATA
                $this->loadComponent("DatabaseHelper");
                $this->DatabaseHelper->save("HdIntPrplPrinting", $a);
                $aData = $a;
                unset($a);
                // END SAVE DATA

                $a["id"] = $aPost["general_id"][$k];
                $a["order_quantity_new"] = $aPost["quantity"][$k];
                $a["order_start_quantity"] = $aPost["quantity"][$k];
                // SAVE DATA
                $this->DatabaseHelper->save("HdIntPrplGeneral", $a);
                $aData = array_merge($aData, $a);
                unset($a);
                // END SAVE DATA

                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($nrint, key($_SESSION['adminlogin']['name_user']), 0, 0, 101);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($nrint, 'general', 'Drukwerk besteld bij drukkerij', $aPost["printer_name"], key($_SESSION['adminlogin']['name_user']), 1, $aPost["end_date"][$k]);

                // ADD DATA TO ARRAY
                $aData["end_quantity"] = $aData["order_start_quantity"];
                $aPdfLines[] = array_merge($this->HdIntPrplViewItem->getOrder($nrint)->toArray(), $aData);

            }

            //print_r($aPdfLines); die();

            // MAKE PDF
            $this->loadComponent('HTML2PDF');
            $aDataPDF = $this->HTML2PDF->convertDataToRows($aPdfLines);
            $aDataPDF["company_name"] = $this->request->data["printer_name"];
            $sHTML = $this->HTML2PDF->loadTemplate("sendOrdersToPrinter", $aDataPDF);
            $this->HTML2PDF->setTitle(time());
            $sFilePath = $this->HTML2PDF->makePDF("Orders verstuurd naar drukkerij", $sHTML, "F", 'to_printer');

            $email = new Email();
            $email->from(['logistiek@hodi-international.nl' => 'Logistiek - Hodi International'])
                // TODO: EMAIL ACTIVEREN!!
                ->to('logistiek@hodi-international.nl', 'Logistiek - Hodi International')
                ->bcc('mike@hd-it.nl', 'Logistiek - Hodi International')
                ->subject('Aanmelding nieuw drukwerk')
                ->viewVars(['company_name' => $this->request->data["printer_name"]])
                ->template('to_printer')
                ->emailFormat('html')
                ->attachments([$sFilePath]);

/** UITGESCHAKELD ^MG 01-12-2017 **/
//            $this->loadModel("FRbkhADRES");
//            $aCustomer = $this->FRbkhADRES->get($this->request->data["printer_nrint"]);
//            if($aCustomer["BKHADEMAIL"] != ""){
//                $mailadres = explode(";", $aCustomer["BKHADEMAIL"]);
//                foreach($mailadres as $mail){
//                    $email->addTo(trim($mail), $this->request->data["printer_name"]);
//                    //echo $mail;
//                }
//            }

            $this->loadModel("FRbkhCONTACT");
            $aCustomer = $this->FRbkhCONTACT->getContactsByAddressNrint($this->request->data["printer_nrint"], "PAK");
            foreach($aCustomer as $mail){
                if(trim($mail["BKHCOEMAIL"]) != ""){
                    $name = $mail["BKHCOTOTAALNAAM"] != "" ? $mail["BKHCOTOTAALNAAM"] : $this->request->data["printer_name"];
                    $email->addTo(trim($mail["BKHCOEMAIL"]), $name);
//                    echo trim($mail["BKHCOEMAIL"])."<br />".$name."<hr />";
                }

            }

            $email->send();

            //die();

            $this->Flash->success(__('Orders succesvol aangeboden bij')." ".$this->request->data["printer_name"]);
            return $this->redirect(['action' => 'index']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'index']);
        }
    }
}
