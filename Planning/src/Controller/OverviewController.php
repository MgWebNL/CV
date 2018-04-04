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
use Cake\I18n\Time;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class OverviewController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function stock()
    {
        $this->loadModel("Stock");
        $this->loadModel("Napkin");
        $this->loadModel("Box");
        $this->loadModel("Septum");

        // CURRENT STOCK QUERY
        $aStock = array();

        $aNapkins = $this->Napkin->find('all')->contain(["Article"])->order(["Article.BKHARCODE" => "asc"]);
        $aBox = $this->Box->find('all');
        $aSeptum = $this->Septum->find('all');

        $aNapkins = $this->Stock->find('all')->order(["BKHARCODE" => "asc"]);




        $this->set('aNapkins', $aNapkins);
//        $this->set('aStatus', $aStatus);
    }

    public function performance(){
        $this->loadComponent("Overview");
        $aPerformance = $this->Overview->getPerformance();

        $this->set('aPerformance', $aPerformance);
    }

    public function performanceMonth($p_sPeriod){
        $this->loadComponent("Overview");
        $aList = $this->Overview->getPerformanceByPeriod($p_sPeriod);

        $this->set('aList', $aList);
        $this->set('p_sPeriod', $p_sPeriod);
    }

    public function orderssend(){
        $this->loadComponent('Overview');
        $aList = $this->Overview->getOrdersSend();
        $iTotal = $aList["total"];
        unset($aList["total"]);

        $aGB = [];

        $this->loadModel("HdIntPrplCompanies");
        $aCustomers = $this->HdIntPrplCompanies->find()
            ->contain(["FRbkhADRES"])
            ->where(["company_type" => "packaging"])
            ->order(["adres_alias"]);

        // MAKE GB's
        foreach($aList as $list){
            $aGB[] = $list->BKHGBNR;
        }
        $aGB = array_unique($aGB);
        //$gb = implode(',', $aGB);
        //debug($aGB); die();
        if(!empty($aGB)) {
            $this->loadModel("FRbkhGROOTBOEK");
            $aGBs = $this->FRbkhGROOTBOEK->find()
                ->select(["BKHGBNR", "BKHGBOMS"])
                ->where(["BKHGBNR IN " => $aGB], ["BKHGBNR" => "string"]);
        }else{
            $aGBs = [];
        }

        $this->set('aList', $aList);
        $this->set('aGBs', $aGBs);
        $this->set('aCustomers', $aCustomers);
        $this->set('iTotal', $iTotal);
    }




    public function purchaseTransport($p_sStartDate = null, $p_sEndDate = null, $p_iReinvoice = 0){
        // CHECK IF DATES ARE SET
        if(!is_null($p_sStartDate) && !is_null($p_sEndDate)){
            $this->loadModel("HdIntPrplTransport");
            $aInvoiceRules = $this->HdIntPrplTransport->find()
                ->contain(["HdIntPrplViewItem", "HdIntPrplPackaging.FRbkhADRES", "HdIntPrplPartialDelivery"])
                ->where([
                    "to_transport_date >=" => $p_sStartDate,
                    "to_transport_date <=" => $p_sEndDate,
                    "in_nl" => "1"
                ])
                ->order(["to_transport_date", "HdIntPrplViewItem.order_nr"]);
            // CHECK IF REINVOCE = TRUE
            if($p_iReinvoice == 0){
                $aInvoiceRules->andWhere(["invoiced" => 0]);
            }

            $aInvoiceRules->all();

            // GET COUNTRY LIST
            $this->loadModel('FRbkhLAND');
            $aCountry = $this->FRbkhLAND->find()
                ->select(["BKHLANRINT", "BKHLACODE", "BKHLAOMS"])
                ->all();

            $this->loadComponent("Functions");
            $aCountry = $this->Functions->groupByKey($aCountry, "BKHLANRINT");

            // DEFINE TIME OBJECTS
            $p_sStartDate = new Time($p_sStartDate);
            $p_sEndDate = new Time($p_sEndDate);

            $this->set("aCountry", $aCountry);
            $this->set("aInvoiceRules", $aInvoiceRules);
            $this->set("sStartDate", $p_sStartDate->format('d-m-Y'));
            $this->set("sEndDate", $p_sEndDate->format('d-m-Y'));
            $this->set("iReinvoice", $p_iReinvoice);
        }
    }

    public function purchaseTransportPost(){
        $this->render(false);

        if($this->request->is('post') !== true){
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect('/Overview/PurchaseTransport/');
        }

        $aPost = $this->request->data();

        $startDate = new Time($aPost["startDate"]);
        $endDate = new Time($aPost["endDate"]);
        $reinvoice = $aPost["reinvoice"] == 1 ? 1 : "";

        return $this->redirect('/Overview/PurchaseTransport/'.$startDate->format('Y-m-d').'/'.$endDate->format('Y-m-d').'/'.$reinvoice);
    }

    public function sendPurchaseTransport (){
        $this->render(false);

        if($this->request->is('post') !== true){
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect('/Overview/PurchaseTransport/');
        }

        $aPost = $this->request->data();

        $this->loadModel("HdIntPrplTransport");
        $ids = $aPost["id"];
        $this->HdIntPrplTransport->query()->update()
            ->set(['invoiced' => 1])
            ->where(['id IN' => $ids])
            ->execute();

        $this->Flash->success(__('Regels succesvol gefactureerd'));
        return $this->redirect('/Overview/PurchaseTransport/');

    }





    private function mergeStock($p_aNap, $p_aBox, $p_aSeptum){
        $a = array();
        foreach($p_aNap as $item){
            $x = $item;
            $x["article_code"] = $item;
        }
    }
}
