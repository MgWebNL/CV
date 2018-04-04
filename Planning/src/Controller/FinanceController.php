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
use Cake\I18n\Date;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class FinanceController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function intake()
    {

        $this->loadModel('HdIntPrplPartialDelivery');
        $orders = $this->HdIntPrplPartialDelivery->find('all', ['contain' => ['HdIntPrplViewItem.HdIntPrplGeneral']])->where(['intake' => '0'])->order(['send_date' => "ASC"])->toArray();

        $aOrders = array();
        $aGB = array();

        foreach($orders as $item){
            $oDateTimeInvoice = new Date($item["send_date"]->format('Y-m-d'));
            $oDateTimeInvoice->modify("+5 days");
            $oDateTimeNow = new Date(date('Y-m-d'));
            $item["daysToInvoice"] = $oDateTimeNow->diff($oDateTimeInvoice)->format('%r%a');
            $aOrders[] = $item;

            $aGB[$item->HdIntPrplViewItem->HdIntPrplGeneral->ledger_code][] = $item;
        }

        ksort($aGB);


        $this->set('aOrders', $aOrders);
        $this->set('aGB', $aGB);
    }

    public function setIntake($p_iSetAll = 0, $p_iID = 0)
    {
        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $id = $p_iID != 0 ? $p_iID : $this->request->data["delivery_id"];

            $this->loadComponent("DatabaseHelper");
            $this->loadModel("HdIntPrplPartialDelivery");
            $this->loadModel("HdIntPrplViewItem");
            $item = $this->HdIntPrplPartialDelivery->get($id);
            $order = $this->HdIntPrplViewItem->getOrder($item["order_nrint"]);

            if($p_iSetAll == 0){
                $a["id"] = $id;
                $a["intake"] = 1;
                $a["intake_date"] = date('Y-m-d');

                if($order->order_type == 1){
                    $a["invoice"] = $a["intake"];
                    $a["invoice_date"] = $a["intake_date"];
                }

                $this->loadComponent("DatabaseHelper");
                $this->DatabaseHelper->save("HdIntPrplPartialDelivery", $a);
                unset($a);

                $this->Flash->success(__('(Deel)order gemarkeerd als ingeslagen'));
                return $this->redirect(['action' => 'intake']);
            }else{
                $aAll = $this->HdIntPrplPartialDelivery->find('all')->where(["order_nrint" => $item["order_nrint"]])->toArray();
                foreach($aAll as $aItem){
                    $a["id"] = $aItem["id"];
                    $a["intake"] = 1;
                    $a["intake_date"] = date('Y-m-d');

                    if($order->order_type == 1){
                        $a["invoice"] = $a["intake"];
                        $a["invoice_date"] = $a["intake_date"];
                    }

                    $this->DatabaseHelper->save("HdIntPrplPartialDelivery", $a);
                    unset($a);
                }
                $this->Flash->success(__('Gehele order gemarkeerd als ingeslagen'));
                return $this->redirect(['action' => 'intake']);
            }



        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'intake']);
        }
    }

    public function invoice()
    {

        // START ORDERS
        $this->loadModel('HdIntPrplPartialDelivery');
        $this->loadModel('HdIntPrplTransport');
//        $orders = $this->Orders->find('all', [
//            'contain' => ['Orderrules', 'General', 'Customer'],
//        ])->toArray();
        $orders = $this->HdIntPrplPartialDelivery->find('all', ['contain' => ['HdIntPrplViewItem.HdIntPrplGeneral']])->where(['intake !=' => '0', 'invoice' => '0'])->order(["intake_date" => "ASC"])
            ->toArray();

        $transports = $this->HdIntPrplTransport->find('all', ['fields' => ['partial_delivery_id']]);

        $aOrders = array();
        $aTransports = array();

        foreach($transports as $trans){
            $aTransports[$trans->partial_delivery_id] = $trans->partial_delivery_id;
        }

        $iTotal = 0;
        foreach($orders as $item){

            // Check if Transport-rule exists..
            $item["truck"] = 0;
            if(isset($aTransports[$item->id])){
                $item["truck"] = 1;
            }

            $oDateTimeInvoice = new Date($item["send_date"]->format('Y-m-d'));
            $oDateTimeInvoice->modify("+5 days");
            $oDateTimeNow = new Date(date('Y-m-d'));
            $item["daysToInvoice"] = $oDateTimeNow->diff($oDateTimeInvoice)->format('%r%a');
            $aOrders[] = $item;

            $iTotal += $item["quantity_send"];
        }

        // END ORDERS


        $this->set('aOrders', $aOrders);
        $this->set('iTotal', $iTotal);
    }

    public function setInvoice($p_iSetAll = 0, $p_iID = 0)
    {
        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $id = $p_iID != 0 ? $p_iID : $this->request->data["delivery_id"];

            if($p_iSetAll == 0){
                $a["id"] = $id;
                $a["invoice"] = 1;
                $a["invoice_date"] = date('Y-m-d');

                $this->loadComponent("DatabaseHelper");
                $this->DatabaseHelper->save("HdIntPrplPartialDelivery", $a);
                unset($a);

                $this->Flash->success(__('(Deel)order gemarkeerd als gefactureerd'));
                return $this->redirect(['action' => 'invoice']);
            }else{
                $this->loadComponent("DatabaseHelper");
                $this->loadModel("HdIntPrplPartialDelivery");
                $item = $this->HdIntPrplPartialDelivery->get($id);

                $aAll = $this->HdIntPrplPartialDelivery->find('all')->where(["order_nrint" => $item["order_nrint"]])->toArray();
                foreach($aAll as $aItem){
                    $a["id"] = $aItem["id"];
                    $a["invoice"] = 1;
                    $a["invoice_date"] = date('Y-m-d');

                    $this->DatabaseHelper->save("HdIntPrplPartialDelivery", $a);
                    unset($a);
                }
                $this->Flash->success(__('Gehele order gemarkeerd als gefactureerd'));
                return $this->redirect(['action' => 'invoice']);
            }



        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'invoice']);
        }
    }

    public function transport()
    {
        // START ORDERS
        $this->loadModel('HdIntPrplPartialDelivery');
//        $orders = $this->Orders->find('all', [
//            'contain' => ['Orderrules', 'General', 'Customer'],
//        ])->toArray();
        $aOrders = $this->HdIntPrplPartialDelivery->find('all', ['contain' => ['HdIntPrplViewItem.HdIntPrplGeneral']])->where(['intake !=' => '0', 'invoice !=' => '0', 'transport_cost' => '0'])
            ->order(["HdIntPrplViewItem.order_nr" => "ASC"])
            ->toArray();

        $this->set('aOrders', $aOrders);
    }

    public function setTransport()
    {

        // PAGINA ALLEEN ALS "POST" OPENEN
        if ($this->request->is('post')) {

            $this->loadComponent("DatabaseHelper");
            $this->loadModel("HdIntPrplPartialDelivery");

            // TRANSPORT SAMENVOEGEN
            if(isset($this->request->data["merge_transport"])){
                if(count($this->request->data["order_nrint"]) < 2){
                    $this->Flash->error(__('U moet minimaal 2 regels selecteren'));
                    return $this->redirect(['action' => 'transport']);
                }elseif($this->request->data["merge_transport_cost"] == ""){
                    $this->Flash->error(__('U heeft geen gecombineerd bedrag ingevoerd.'));
                    return $this->redirect(['action' => 'transport']);
                }else{
                    $iTotal = 0;

                    // GET TOTAL
                    foreach($this->request->data["order_nrint"] as $id => $v){
                        $iTotal += $this->request->data["quantity"][$id];
                    }

                    // GET PERCENTAGE EN SAVE
                    foreach($this->request->data["order_nrint"] as $id => $v){


                        // TEL ORDERS IN FINANCE
                        $iFinance = $this->countOrdersInFinance($v);

                        // KIJK OF ORDER COMPLEET IS VERSTUURD
                        $iSendAll = $this->checkSendAll($v);

                        // BEIDE WAAR?? --> MUTEER STATUS
                        if($iFinance == 1 && $iSendAll !== false){
                            // MUTATE STATUS
                            $this->loadComponent('MutateStatus');
                            $this->MutateStatus->mutateOrderStatus($v, key($_SESSION['adminlogin']['name_user']), 0, 1, 99);
                        }

                        // OPSLAAN
                        $a["id"] = $id;
                        $a["transport_cost"] = $this->request->data["quantity"][$id]/$iTotal * $this->request->data["merge_transport_cost"];
                        $a["transport_cost_date"] = date('Y-m-d');
                        $this->DatabaseHelper->save("HdIntPrplPartialDelivery", $a);
                        unset($a);


                    }

                    $this->Flash->success(__("Transportkosten van EUR ".number_format($this->request->data["merge_transport_cost"],2,",",".")." naar verhouding verdeeld over ".count($this->request->data["order_nrint"])." regels"));
                    return $this->redirect(['action' => 'transport']);
                }
            }
            // ANDERS 1 REGEL VERWERKEN
            else{
                $id = $this->request->data["saveSingleLine"];
                if($this->request->data["transport_cost"][$id] == ""){
                    $this->Flash->error(__('U heeft geen bedrag ingevoerd.'));
                    return $this->redirect(['action' => 'transport']);
                }

                // GET ORDER
                $aOrder = $this->HdIntPrplPartialDelivery->get($id);

                // TEL ORDERS IN FINANCE
                $iFinance = $this->countOrdersInFinance($aOrder["order_nrint"]);

                // KIJK OF ORDER COMPLEET IS VERSTUURD
                $iSendAll = $this->checkSendAll($aOrder["order_nrint"]);

                // BEIDE WAAR?? --> MUTEER STATUS
                if($iFinance == 1 && $iSendAll == 1){
                    // MUTATE STATUS
                    $this->loadComponent('MutateStatus');
                    $this->MutateStatus->mutateOrderStatus($aOrder["order_nrint"], key($_SESSION['adminlogin']['name_user']), 0, 1, 99);
                }

                // OPSLAAN
                $a["id"] = $id;
                $a["transport_cost"] = $this->request->data["transport_cost"][$id];
                $a["transport_cost_date"] = date('Y-m-d');
                $this->DatabaseHelper->save("HdIntPrplPartialDelivery", $a);
                unset($a);



                $this->Flash->success(__('Transportkosten opgeslagen'));
                return $this->redirect(['action' => 'transport']);
            }

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect(['action' => 'transport']);
        }
    }

    private function countOrdersInFinance($p_sNrint = null){
        $query = TableRegistry::get('HdIntPrplGeneral')->find('all')
            ->where(['order_nrint' => $p_sNrint])
            ->andWhere(['general_status' => '110'])
            ->count();
        //debug($query); //die();
        return $query;
    }

    private function checkSendAll($p_sNrint = null){
        $query = TableRegistry::get('HdIntPrplPartialDelivery')->find('all')
            ->where(['order_nrint' => $p_sNrint])
            ->andWhere(['transport_cost' => '0'])
            ->count();
        //debug($query); //die();
        return $query;
    }

    public function menu(){

    }
}
