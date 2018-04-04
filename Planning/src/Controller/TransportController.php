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
use Cake\Chronos\Date;
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class TransportController extends AppController
{

    private $m_aPrices = [
        "ECK" =>    [
            "nl" => 0,
            "be" => 0
        ],

        "BELGIE" =>    [
            "nl" => 0,
            "be" => 0
        ],

        "ANDERE" =>    [
            "nl" => 0,
            "be" => 0
        ]
    ];


    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function waitinglist()
    {
        $this->loadModel('HdIntPrplTransport');
        $orders = $this->HdIntPrplTransport->find('all', [
            'contain' => [
                'HdIntPrplPartialDelivery.HdIntPrplViewItem.HdIntPrplGeneral',
                'HdIntPrplPackaging'
            ]
        ])
            ->where(['to_nl' => '0'])
            //->order(['wait_nl_date' => "ASC"])
            ->order(['HdIntPrplViewItem.order_nr' => "ASC"])
            ->toArray();

        $aOrders = array();

        foreach($orders as $item){
            $oDateTimeInvoice = new Date($item["wait_nl_date"]->format('Y-m-d'));
            $oDateTimeNow = new Date(date('Y-m-d'));
            $item["daysToInvoice"] = $oDateTimeInvoice->diff($oDateTimeNow)->format('%r%a');
            $aOrders[] = $item;
        }

        $this->loadComponent("Functions");
        $aGrouped = $this->Functions->groupObjectByKey($aOrders, "adres_nrint", ["HdIntPrplPackaging"]);

        $this->loadModel('HdIntPrplExceptionrules');
        $this->loadModel('HdIntPrplArticleEditions');
        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();
        $aEditie = $this->HdIntPrplArticleEditions->getEditions();
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);


        // START COMPANY
        $this->loadModel('FRbkhADRES');
        $company = $this->FRbkhADRES->find('all', [
            'contain' => ['HdIntPrplCompanies'],
        ])->where(['company_type' => 'packaging'])->toArray();
        //$orders = $this->Orders->find('all')->toArray();
        foreach($company as $comp){
            //var_dump($comp); die();
            if($comp["HdIntPrplCompanies"]["adres_alias"] != "") {
                $comp["BKHADNAAM"] = $comp["HdIntPrplCompanies"]["adres_alias"];
            }
            $aCompany[$comp["BKHADNRINT"]] = $comp;
        }
        // END COMPANY

        $this->set('aOrders', $aOrders);
        $this->set('aGrouped', $aGrouped);
        $this->set('aCompany', $aCompany);
    }

    public function intake()
    {
        $this->loadModel('HdIntPrplTransport');
        $orders = $this->HdIntPrplTransport->find('all', [
            'contain' => [
                'HdIntPrplPartialDelivery.HdIntPrplViewItem.HdIntPrplGeneral',
                'HdIntPrplPackaging'
            ]
        ])
            ->where(['to_nl' => '1', 'in_nl' => '0', 'loading_order !=' => 0])
            //->order(['wait_nl_date' => "ASC"])
            ->order(['HdIntPrplViewItem.order_nr' => "ASC"])
            ->toArray();

        $aOrders = array();

        foreach($orders as $item){
            $oDateTimeInvoice = new Date($item["to_nl_date"]->format('Y-m-d'));
            $oDateTimeNow = new Date(date('Y-m-d'));
            $item["daysToInvoice"] = $oDateTimeInvoice->diff($oDateTimeNow)->format('%r%a');
            $aOrders[] = $item;
        }

        $this->loadComponent("Functions");
        $aGrouped = $this->Functions->groupObjectByKey($aOrders, "adres_nrint", ["HdIntPrplPackaging"]);


        $this->loadModel('HdIntPrplExceptionrules');
        $this->loadModel('HdIntPrplArticleEditions');
        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();
        $aEditie = $this->HdIntPrplArticleEditions->getEditions();
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);


        // START COMPANY
        $this->loadModel('FRbkhADRES');
        $company = $this->FRbkhADRES->find('all', [
            'contain' => ['HdIntPrplCompanies'],
        ])->where(['company_type' => 'packaging'])->toArray();
        //$orders = $this->Orders->find('all')->toArray();
        foreach($company as $comp){
            //var_dump($comp); die();
            if($comp["HdIntPrplCompanies"]["adres_alias"] != "") {
                $comp["BKHADNAAM"] = $comp["HdIntPrplCompanies"]["adres_alias"];
            }
            $aCompany[$comp["BKHADNRINT"]] = $comp;
        }
        // END COMPANY

        $this->set('aOrders', $aOrders);
        $this->set('aGrouped', $aGrouped);
        $this->set('aCompany', $aCompany);
    }

    public function loading()
    {
        $this->loadModel('HdIntPrplTransport');
        $orders = $this->HdIntPrplTransport->find('all', [
            'contain' => [
                'HdIntPrplPartialDelivery.HdIntPrplViewItem.HdIntPrplGeneral',
                'HdIntPrplPackaging'
            ]
        ])
            ->where(['to_nl' => '1', 'in_nl' => '0', 'loading_order' => 0])
            //->order(['wait_nl_date' => "ASC"])
            ->order(['HdIntPrplViewItem.order_nr' => "ASC"])
            ->toArray();

        $aOrders = array();

        foreach($orders as $item){
            $oDateTimeInvoice = new Date($item["to_nl_date"]->format('Y-m-d'));
            $oDateTimeNow = new Date(date('Y-m-d'));
            $item["daysToInvoice"] = $oDateTimeInvoice->diff($oDateTimeNow)->format('%r%a');
            $aOrders[] = $item;
        }


        $this->loadModel('HdIntPrplExceptionrules');
        $this->loadModel('HdIntPrplArticleEditions');
        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();
        $aEditie = $this->HdIntPrplArticleEditions->getEditions();
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);

        // START COMPANY
        $this->loadModel('FRbkhADRES');
        $company = $this->FRbkhADRES->find('all', [
            'contain' => ['HdIntPrplCompanies'],
        ])->where(['company_type' => 'packaging'])->toArray();
        //$orders = $this->Orders->find('all')->toArray();
        foreach($company as $comp){
            //var_dump($comp); die();
            if($comp["HdIntPrplCompanies"]["adres_alias"] != "") {
                $comp["BKHADNAAM"] = $comp["HdIntPrplCompanies"]["adres_alias"];
            }
            $aCompany[$comp["BKHADNRINT"]] = $comp;
        }
        // END COMPANY

        $this->set('aOrders', $aOrders);
        $this->set('aCompany', $aCompany);
    }

    public function assign()
    {
        $this->loadModel('HdIntPrplTransport');
        $orders = $this->HdIntPrplTransport->find('all', [
            'contain' => [
                'HdIntPrplPartialDelivery.HdIntPrplViewItem.HdIntPrplGeneral',
                'HdIntPrplPackaging'
            ]
        ])
            ->where(['to_nl' => '1', 'in_nl' => '1', 'to_transport' => 0])
            //->order(['wait_nl_date' => "ASC"])
            ->order(['HdIntPrplViewItem.order_nr' => "ASC"])
            ->toArray();

        $aOrders = array();

        foreach($orders as $item){
            $oDateTimeInvoice = new Date($item["in_nl_date"]->format('Y-m-d'));
            $oDateTimeNow = new Date(date('Y-m-d'));
            $item["daysToInvoice"] = $oDateTimeInvoice->diff($oDateTimeNow)->format('%r%a');
            $aOrders[] = $item;
        }

        $this->loadComponent("Functions");
        $aGrouped = $this->Functions->groupObjectByKey($aOrders, "adres_nrint", ["HdIntPrplPackaging"]);

        $this->loadModel('HdIntPrplExceptionrules');
        $this->loadModel('HdIntPrplArticleEditions');
        $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();
        $aEditie = $this->HdIntPrplArticleEditions->getEditions();
        $this->set('aExceptions', $aExceptions);
        $this->set('aEditie', $aEditie);

        // START COMPANY
        $this->loadModel('FRbkhADRES');
        $company = $this->FRbkhADRES->find('all', [
            'contain' => ['HdIntPrplCompanies'],
        ])->where(['company_type' => 'packaging'])->toArray();
        //$orders = $this->Orders->find('all')->toArray();
        foreach($company as $comp){
            //var_dump($comp); die();
            if($comp["HdIntPrplCompanies"]["adres_alias"] != "") {
                $comp["BKHADNAAM"] = $comp["HdIntPrplCompanies"]["adres_alias"];
            }
            $aCompany[$comp["BKHADNRINT"]] = $comp;
        }
        // END COMPANY

        $this->set('aOrders', $aOrders);
        $this->set('aGrouped', $aGrouped);
        $this->set('aCompany', $aCompany);
    }

    public function setSendDate()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $aPost = $this->request->data;

            if(count($aPost["id"]) == 0){
                $this->Flash->error(__('U heeft geen items geselecteerd.'));
                return $this->redirect(['action' => 'waitinglist']);
            }

            // DATABASEHELPER
            $this->loadComponent("DatabaseHelper");
            $this->loadModel("HdIntPrplPartialDelivery");

            $aTable = [
                "header" => [
                    "Ordernummer" => ["align" => "left", "width" => 100],
                    "Debiteur" => ["align" => "left", "width" => 175],
                    "Artikelcode" => ["align" => "left", "width" => 125],
                    "Omschrijving" => ["align" => "left"],
                    "Aantal" => ["align" => "right", "width" => 100]
                ]
            ];

            $count = 0;
            foreach($aPost["pallets"] as $k => $pal){
                if($pal > 0){
                    $a["id"] = $k;
                    $a["to_nl"] = 1;
                    $a["to_nl_date"] = date('Y-m-d');
                    $a["total_colli"] = $pal;
                    $this->DatabaseHelper->save("HdIntPrplTransport", $a);
                    unset($a);

                    $nrint = $aPost["id"][$k];
                    $count++;

                    // GET RULE
                    $this->loadModel("HdIntPrplTransport");
                    $aRule = $this->HdIntPrplTransport->get($k);

                    // GET ORDERRULE
                    $aOrder = $this->HdIntPrplPartialDelivery->get($aRule->partial_delivery_id, ["contain" => ["HdIntPrplViewItem"]]);
                    $aTable[] = [
                        $aOrder->HdIntPrplViewItem->order_nr => ["align" => "left", "width" => 100],
                        $aOrder->HdIntPrplViewItem->adres_name => ["align" => "left", "width" => 175],
                        $aOrder->HdIntPrplViewItem->product_code => ["align" => "left", "width" => 125],
                        $aOrder->HdIntPrplViewItem->order_description => ["align" => "left"],
                        number_format($aOrder->quantity_send,0,",",".") => ["align" => "right", "width" => 100]
                    ];

                    // CREATE LOG
                    $this->loadComponent('Log');
                    $this->Log->createLogEntry($nrint, 'general', '(Deel)levering onderweg naar Nederland', "", key($_SESSION['adminlogin']['name_user']), 0);
                }

                $this->loadComponent("HTML2PDF");
                $this->loadComponent("Functions");
                $aDataPDF["table"] = $this->Functions->arrayToTable($aTable);

                $sHTML = $this->HTML2PDF->loadTemplate("sendOrdersToNL", $aDataPDF);
                $this->HTML2PDF->setTitle( (int) round(microtime(true)*1000));
                $sFilePath = $this->HTML2PDF->makePDF("Orders verstuurd naar drukkerij", $sHTML, "F", 'to_nl');

                if(!empty($aTable)){
                    // PDF
                    $email = new Email();
                    $email->from(['logistiek@hodi-international.nl' => 'Logistiek - Hodi International'])
                        ->to('logistiek@hodi-international.nl', 'Logistiek - Hodi International')
                        //->to('mike@hd-it.nl', 'Logistiek - Hodi International')
                        ->cc($this->request->session()->read('adminlogin')["emailadres"])
                        ->subject('PDF - Gereed product verzonden naar Hodi')
                        //->viewVars(['company_name' => $this->request->data["printer_name"]])
                        ->template('to_customer_pdf')
                        ->emailFormat('html')
                        ->attachments([$sFilePath]);
                    $email->send();
                }
            }

            if($count > 0) {
                $this->request->session()->delete('waitinglist');

                $this->Flash->success(__('Verzenden orders succesvol verwerkt'));
            }else{
                $this->Flash->error(__('Geen palletaantallen ingevoerd!'));
            }
            return $this->redirect(['action' => 'waitinglist']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'intake']);
        }
    }

    public function setReceiveDate()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $aPost = $this->request->data;

            if(count($aPost["id"]) == 0){
                $this->Flash->error(__('U heeft geen items geselecteerd.'));
                return $this->redirect(['action' => 'intake']);
            }

            // DATABASEHELPER
            $this->loadComponent("DatabaseHelper");

            $count = 0;
            foreach($aPost["destination"] as $k => $dest){
                if($dest != "") {
                    // VERWERK ONTVANGST
                    $a["id"] = $k;
                    $a["in_nl"] = $dest;
                    $a["in_nl_date"] = date('Y-m-d');
                    $this->DatabaseHelper->save("HdIntPrplTransport", $a);
                    unset($a);

                    $nrint = $aPost["id"][$k];
                    $count++;

//                // MUTATE STATUS
//                $this->loadComponent('MutateStatus');
//                $this->MutateStatus->mutateOrderStatus($nrint, key($_SESSION['adminlogin']['name_user']), 0,0, 202);

                    // CREATE LOG
                    $this->loadComponent('Log');
                    $this->Log->createLogEntry($nrint, 'general', '(Deel)levering aangekomen in Nederland', "", key($_SESSION['adminlogin']['name_user']), 0);
                }
            }

            if($count > 0) {
                $this->request->session()->delete('intake');

                $this->Flash->success(__('Aankomst orders succesvol verwerkt'));
            }else{
                $this->Flash->error(__('Geen eindbestemmingen ingevoerd!'));
            }
            return $this->redirect(['action' => 'intake']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'intake']);
        }
    }

    public function setLoadingOrder()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $aPost = $this->request->data;

            if(count($aPost["id"]) == 0){
                $this->Flash->error(__('U heeft geen items geselecteerd.'));
                return $this->redirect(['action' => 'intake']);
            }

            // DATABASEHELPER
            $this->loadComponent("DatabaseHelper");

            $count = 0;
            $orders = [];

            foreach($aPost["destination"] as $k => $dest){
                if($dest != "") {
                    // VERWERK ONTVANGST
                    $a["id"] = $k;
                    $a["loading_order"] = $dest;
                    $this->DatabaseHelper->save("HdIntPrplTransport", $a);
                    unset($a);

                    $nrint = $aPost["id"][$k];

                    if($dest == -1){
                        $orders[] = $nrint;
                    }
                    $count++;

//                // MUTATE STATUS
//                $this->loadComponent('MutateStatus');
//                $this->MutateStatus->mutateOrderStatus($nrint, key($_SESSION['adminlogin']['name_user']), 0,0, 202);

                }
            }

            if($count > 0) {

                $this->loadModel("HdIntPrplViewItem");

                foreach($orders as $nrint){
                    $aOrder = $this->HdIntPrplViewItem->get($nrint);
                    $aOrders[] = $aOrder->order_nr;
                }

                if(isset($aOrders)) {
                    // MAKE EMAIL
                    $email = new Email();
                    $email->from(['logistiek@hodi-international.nl' => 'Logistiek - Hodi International'])
                        ->to('logistiek@hodi-international.nl', 'Logistiek - Hodi International')
                        ->cc('mike@hd-it.nl', 'Mike')
                        ->subject('Loadingorder for batch')
                        ->viewVars([
                            'aOrders' => $aOrders
                        ])
                        ->template('transportOrder')
                        ->emailFormat('html');

                    $email->send();
                }

                $this->Flash->success(__('Volgorde laden orders succesvol verwerkt'));
            }else{
                $this->Flash->error(__('Geen volgorde aangegeven ingevoerd!'));
            }
            return $this->redirect(['action' => 'loading']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'intake']);
        }
    }

    public function setTransportAssignment()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $aPost = $this->request->data;

            if(count($aPost["id"]) == 0){
                $this->Flash->error(__('U heeft geen items geselecteerd.'));
                return $this->redirect(['action' => 'assign']);
            }

            $totalTransportCost = 0;

            // DATABASEHELPER
            $this->loadComponent("DatabaseHelper");
            foreach($aPost["id"] as $k => $nrint){

                // VERWERK ONTVANGST
                $a["id"] = $k;
                $a["to_transport"] = $aPost["pallets"][$k];
                $a["to_transport_date"] = date('Y-m-d');
                $a["transporter_code"] = $aPost["transporter_code"];
                $this->DatabaseHelper->save("HdIntPrplTransport", $a);
                unset($a);

                // GENEREER TXT
                $txt = $this->makeTransportCSV($k, $aPost["transporter_code"]); // TODO ACTIVATE CSV VAN ECK
                //$txt = $this->makeTransportCSV($k, "TEST");


                // UPLOAD TXT


                // MUTATE STATUS
                $this->loadComponent('MutateStatus');
                $this->MutateStatus->mutateOrderStatus($nrint, key($_SESSION['adminlogin']['name_user']), 0,0, 99);

                // CREATE LOG
                $this->loadComponent('Log');
                $this->Log->createLogEntry($nrint, 'general', '(Deel)levering verzonden naar klant', "", key($_SESSION['adminlogin']['name_user']), 0);

                $this->loadModel('HdIntPrplViewItem');
                $aOrder = $this->HdIntPrplViewItem->getOrder($nrint);

                $code = strtolower($aOrder->afleveradres_countrycode == '' ? $aOrder->adres_countrycode : $aOrder->afleveradres_countrycode);

                $cost = $aPost["pallets"][$k] * $this->m_aPrices[$aPost["transporter_code"]][$code];

                $totalTransportCost += $cost;

            }

            // MAKE EMAIL
            $email = new Email();
            $email->from(['logistiek@hodi-international.nl' => 'Logistiek - Hodi International'])
                ->to('logistiek@hodi-international.nl', 'Logistiek - Hodi International')
                ->to('mike@hd-it.nl', 'Mike')
                ->subject('Transportkosten voor batch '.$aPost["transporter_code"])
                ->viewVars([
                    'count' => count($aPost["id"]),
                    'total' => $totalTransportCost,
                    'trans' => $aPost["transporter_code"]
                ])
                ->template('transportCost')
                ->emailFormat('html');

            //$email->send();

            $this->Flash->success(__('Verzenden orders naar klant succesvol verwerkt'));
            return $this->redirect(['action' => 'assign']);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'intake']);
        }
    }


    public function setSession($p_sName = ""){
        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $sName = ($p_sName == "") ? "transport" : $p_sName;
            $sAction = ($p_sName == "") ? "waitinglist" : $p_sName;

            if($this->request->data["transport_nrint"] == ""){
                $this->request->session()->delete($sName);
            }else{
                $this->request->session()->write($sName, $this->request->data["transport_nrint"]);
            }

            return $this->redirect(['action' => $sAction]);

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'showBatch']);
        }
    }

    private function makeTransportCSV($p_iID, $p_sTransporterCode){
        switch($p_sTransporterCode){
            case "ECK":
                return $this->makeCsvEck($p_iID);
            case "TEST":
                return $this->makeCsvTEST($p_iID);
            default:
                return false;
        }
    }

    //region TRANSPORTERCODE
    private function makeCsvTEST($p_iID){
        $this->loadModel("Transport");
        $transport = $this->Transport->get($p_iID, ['contain' => 'HdPartialDelivery.Orders']);

        $csv = "";
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laadtijd vanaf
        $csv .= ""; // Laadtijd tot
        $csv .= ""; // Losdatum
        $csv .= ""; // Lostijd vanaf
        $csv .= ""; // Lostijd tot
        $csv .= ""; // Opdrachtgever-code
            $csv .= ""; // Extern nummer laadadres (LEEG)
        $csv .= ""; // Laad Naam
        $csv .= ""; // Laad Adres
        $csv .= ""; // Laad Land
        $csv .= ""; // Laad Postcode
        $csv .= ""; // Laad Plaats
        $csv .= ""; // Laad Telefoonnummer
            $csv .= ""; // Contactpersoon Hodi (LEEG)
            $csv .= ""; // Referentie Hodi (LEEG)
            $csv .= ""; // Extern nummer losadres (LEEG)
        $csv .= ""; // Los Naam
        $csv .= ""; // Los Adres
        $csv .= ""; // Los Land
        $csv .= ""; // Los Postcode
        $csv .= ""; // Los Plaats
        $csv .= ""; // Los Telefoonnummer
        $csv .= ""; // Los TAV
        $csv .= ""; // Los Referentie
        $csv .= ""; // Chauffeursopmerking
            $csv .= ""; // Merk (LEEG)
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum
        $csv .= ""; // Laaddatum

        $file = $this->createTempFile($transport->HdPartialDelivery->Orders->BKHORNR.".txt", $csv);
        $this->uploadFileViaFTP($file, "ECK");

        debug($transport);
        die();
    }

    private function makeCsvEck($p_iID){
        $this->loadModel("HdIntPrplTransport");
        $transport = $this->HdIntPrplTransport->get($p_iID, ['contain' => 'HdIntPrplPartialDelivery.HdIntPrplViewItem']);

        //debug($transport); die();

        $HdPartialDelivery = $transport->HdIntPrplPartialDelivery;
        $Orders = $HdPartialDelivery->HdIntPrplViewItem;

        if($Orders->afleveradres_address == ""){
            $street = $Orders->adres_address;
            $postcode = $Orders->adres_postalcode;
            $plaats = $Orders->adres_town;
        } else {
            $street = $Orders->afleveradres_address;
            $postcode = $Orders->afleveradres_postalcode;
            $plaats = $Orders->afleveradres_town;
        }

        $csv = "0;";
        $csv .= date('d-m-Y').";"; // Laaddatum
        $csv .= "09:00;"; // Laadtijd vanaf
        $csv .= "17:00;"; // Laadtijd tot
        $csv .= date('d-m-Y',strtotime("+1 weekday")).";"; // Losdatum
        $csv .= "09:00;"; // Lostijd vanaf
        $csv .= "17:00;"; // Lostijd tot
        $csv .= "1585;"; // Opdrachtgever-code
            $csv .= ";"; // Extern nummer laadadres (LEEG)
        $csv .= "Hodi International;"; // Laad Naam
        $csv .= "Kernreactorstraat 1;"; // Laad Adres
        $csv .= "NL;"; // Laad Land
        $csv .= "3903 LG;"; // Laad Postcode
        $csv .= "Veenendaal;"; // Laad Plaats
        $csv .= "0318561100;"; // Laad Telefoonnummer
            $csv .= ";"; // Contactpersoon Hodi (LEEG)
            $csv .= ";"; // Referentie Hodi (LEEG)
            $csv .= ";"; // Extern nummer losadres (LEEG)
        $csv .= $Orders->adres_name.";"; // Los Naam
        $csv .= $street.";"; // Los Adres
        $csv .= "NL;"; // Los Land
        $csv .= $postcode.";"; // Los Postcode
        $csv .= $plaats.";"; // Los Plaats
        $csv .= ";"; // Los Telefoonnummer
        $csv .= ";"; // Los TAV
        $csv .= $Orders->order_nr.";"; // Los Referentie (KENMERK)
        $csv .= ";"; // Chauffeursopmerking
            $csv .= ";"; // Merk (LEEG)
            $csv .= ";"; // (LEEG)
        $csv .= $Orders->order_nr.";"; // Ordernummer
            $csv .= ";"; // LEEG
            $csv .= ";"; // LEEG
            $csv .= ";"; // LEEG
            $csv .= ";"; // LEEG
            $csv .= ";"; // LEEG
            $csv .= ";"; // LEEG
        $csv .= "3;"; // Zendingtype
            $csv .= ";"; // Email pakbon (LEEG)
        $csv .= "002;"; // Ordertype
        $csv .= "N\r\n"; // Neutraal leveren J/N
        $csv .= "1;"; // Embalage
        $csv .= $transport->total_colli.";"; // Colli
        $csv .= "EUR;"; // Colli eenheid
            $csv .= ";"; // LEEG
            $csv .= ";"; // LEEG
            $csv .= ";"; // LEEG
            $csv .= ";"; // LEEG
            $csv .= ";"; // LEEG
        $csv .= "Disposables\r\n"; // Omschrijving zending


        $file = $this->createTempFile($Orders->order_nr.".txt", $csv);
//        $this->uploadFileViaFTP($file, "TEST", $Orders->BKHORNR.".txt");
    }


    //endregion

    private function createTempFile($p_sFileName, $p_sContent){
        $sFolder = TMP."/Transport/";
        $myfile = fopen($sFolder.$p_sFileName, "w") or die("Unable to open file!");
        fwrite($myfile, $p_sContent);
        fclose($myfile);
        return $sFolder.$p_sFileName;
    }

    private function uploadFileViaFTP($p_sFilePath, $p_sConnection, $p_sForceFileName = false){
        $aConnections = [
            'ECK' => [
                'server' => 'vpn.expeditievaneck.nl',
                'port' => "2021",
                'username' => 'EXPEDITIEVANECK\Hodi_FTP',
                'password' => '@Van3cK!',
                'folder' => "/"
            ],
            'TEST' => [
                'server' => "ftp.mgweb.nl",
                'port' => "21",
                'username' => "zmgwebnlnl",
                'password' => "pf37czRU",
                'folder' => "/hodi/"
            ]
        ];

        $aThisConnection = $aConnections[$p_sConnection];

        // connect and login to FTP server
        $ftp_conn = ftp_connect($aThisConnection["server"],$aThisConnection["port"]) or die("Could not connect to ".$aThisConnection['server'].":".$aThisConnection['port']);
        $login = ftp_login($ftp_conn, $aThisConnection["username"], $aThisConnection["password"]);

        ftp_pasv($ftp_conn, true);

        $file = $p_sFilePath;
        $filename = $p_sForceFileName !== false ? $p_sForceFileName : (microtime(true)*10000).".txt";

        // upload file
        if (ftp_put($ftp_conn, $aThisConnection["folder"].$filename, $file, FTP_ASCII))
        {
            echo "Successfully uploaded $file.";
        }
        else
        {
            echo "Error uploading $file.";
        }

        // close connection
        ftp_close($ftp_conn);
        unlink($p_sFilePath);
    }

    public function menu(){

    }

}
