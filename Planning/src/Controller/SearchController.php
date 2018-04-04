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
class SearchController extends AppController
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
        // PAGINA ALLEEN ALS "POST" OPENEN
        if($this->request->is('post')) {

            // ALLE NOG NIET GELEVERDE ORDERS + ARCHIEF
            $query = TableRegistry::get('HdIntPrplViewItem')->find('all')
                     ->contain(["HdIntPrplGeneral"])
                     ->where(['order_description LIKE' => '%'.$this->request->data("searchKey").'%'])
                     ->orWhere(['product_code LIKE' => '%'.$this->request->data("searchKey").'%'])
                     ->orWhere(['adres_code LIKE' => '%'.$this->request->data("searchKey").'%'])
                     ->orWhere(['adres_name LIKE' => '%'.$this->request->data("searchKey").'%'])
                     ->orWhere(['order_nr LIKE' => '%'.$this->request->data("searchKey").'%'], ['order_nr' => 'string'])
                     ->toArray();

            $aNrints = [];
            foreach($query as $a){
                if($a["general_status"] != 110){
                    $aNrints[] = $a->orderrule_id;
                }
            }

            // FINANCE
            $query2 = TableRegistry::get('HdIntPrplPartialDelivery')->find('all')
                ->innerJoinWith('HdIntPrplViewItem')
                ->where(['order_description LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['product_code LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['adres_code LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['adres_name LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['order_nr LIKE' => '%'.$this->request->data("searchKey").'%'], ['order_nr' => 'string'])
                ->toArray();

            foreach($query2 as $a){
                $aNrints[] = $a->orderrule_id;
            }

            // HAAL LEVERDATUM OP
            $aDeliveryDates = array();
            if(!empty($aNrints)) {
                $query3 = TableRegistry::get('HdIntPrplViewDeliveryDate')->find('all')->where(["orderrule_id IN" => $aNrints])->toArray();
                foreach ($query3 as $a) {
                    $aDeliveryDates[$a["orderrule_id"]] = $a;
                }
            }


            // STANDAARD RESULTATEN!!
            $aOrders = array();
            foreach($query as $a){
                if($a["general_status"] != 110){
                    $a->delivery_date = new Time($aDeliveryDates[$a["orderrule_id"]]["leverdatum"] == null ? "1970-01-01" : $aDeliveryDates[$a["orderrule_id"]]["leverdatum"]);
                    $a->delivery_date_base = new Time($aDeliveryDates[$a["orderrule_id"]]["leverdatum_base"] == null ? "1970-01-01" : $aDeliveryDates[$a["orderrule_id"]]["leverdatum_base"]);
                    $a->date_def = $aDeliveryDates[$a["orderrule_id"]]["date_def"];
                    $aOrders[] = $a;
                }
            }

            // DEELLEVERING RESULTATEN!!
            if(empty($query2)){
                echo '';
                unset($query2);
            }else{
                foreach($query2 as $a){
                    if($a->transport_cost == 0) {
                        $order = $this->HdIntPrplViewItem->getOrder($a["order_nrint"]);
                        $order["delivery_date"] = new Time($order["send_date"]);
                        $order["delivery_date_base"] = new Time($aDeliveryDates[$a["order_nrint"]]["leverdatum_base"] == null ? "1970-01-01" : $aDeliveryDates[$a["order_nrint"]]["leverdatum_base"]);
                        $order["date_def"] = 1;
                        if ($a["intake"] === false) {
                            $order["HdIntPrplGeneral"]["general_status"] = 106;
                        } elseif ($a["invoice"] == false) {
                            $order["HdIntPrplGeneral"]["general_status"] = 107;
                        } elseif ($a["transport_cost"] == 0) {
                            $order["HdIntPrplGeneral"]["general_status"] = 108;
                        }
                        $aOrders[] = $order;
                    }
                }
            }

            // START STATUS
            $this->loadModel('HdIntPrplStatus');
            $status = $this->HdIntPrplStatus->find('all', [
                'conditions' => ['hidden' => '0'],
            ])->toArray();
            foreach($status as $a){
                $aStatus[$a["id"]] = $a;
            }
            // END STATUS

            $this->set("aOrders", $aOrders);
            $this->set("aStatus", $aStatus);

            $adminlogin = $this->request->session()->read('adminlogin');
            if(isset($adminlogin["supplier_nrint"]) && $adminlogin["supplier_nrint"] != ""){
                $this->render('../SearchSupplier/index');
            }

        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect('/dashboard/');
        }
    }
}
