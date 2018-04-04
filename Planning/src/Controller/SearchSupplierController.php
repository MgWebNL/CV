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
class SearchSupplierController extends AppController
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

            // HAAL LEVERDATUM OP
            $aDeliveryDates = array();
            $query = TableRegistry::get('HdDeliveryDate')->find('all')->toArray();
            foreach($query as $a){
                $aDeliveryDates[$a["order_nrint"]] = $a;
            }

            //die('1');


            // ALLE NOG NIET GELEVERDE ORDERS + ARCHIEF
            $query = TableRegistry::get('Orders')->find('all')
                ->where(['BKHOROMS LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['BKHARCODE LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['BKHADCODE LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['BKHADNAAM LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['BKHORNR LIKE' => '%'.$this->request->data("searchKey").'%'], ['BKHORNR' => 'string'])
                ->toArray();

            $aOrders = array();
            foreach($query as $a){
                if($a["general_status"] != 110){
                    $a["delivery_date"] = new Time($aDeliveryDates[$a["order_nrint"]]["leverdatum"] == null ? "1970-01-01" : $aDeliveryDates[$a["order_nrint"]]["leverdatum"]);
                    $a["delivery_date_base"] = new Time($aDeliveryDates[$a["order_nrint"]]["leverdatum_base"] == null ? "1970-01-01" : $aDeliveryDates[$a["order_nrint"]]["leverdatum_base"]);
                    $a["date_def"] = $aDeliveryDates[$a["order_nrint"]]["date_def"];
                    $aOrders[] = $a;
                }
            }

            // FINANCE
            $query2 = TableRegistry::get('HdPartialDelivery')->find('all')->innerJoinWith('Orders')
                ->where(['BKHOROMS LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['BKHARCODE LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['BKHADCODE LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['BKHADNAAM LIKE' => '%'.$this->request->data("searchKey").'%'])
                ->orWhere(['BKHORNR LIKE' => '%'.$this->request->data("searchKey").'%'], ['BKHORNR' => 'string'])
                ->toArray();

            if(empty($query2)){
                echo '';
                unset($query2);
            }else{
                foreach($query2 as $a){
                    if($a->transport_cost == 0) {
                        $order = $this->Orders->get($a["order_nrint"]);
                        $order["delivery_date"] = new Time($order["send_date"]);
                        $order["delivery_date_base"] = new Time($aDeliveryDates[$a["order_nrint"]]["leverdatum_base"] == null ? "1970-01-01" : $aDeliveryDates[$a["order_nrint"]]["leverdatum_base"]);
                        $order["date_def"] = 1;
                        if ($a["intake"] == 0) {
                            $order["general_status"] = 106;
                        } elseif ($a["invoice"] == 0) {
                            $order["general_status"] = 107;
                        } elseif ($a["transport_cost"] == 0) {
                            $order["general_status"] = 108;
                        }
                        $aOrders[] = $order;
                    }
                }
            }

            // START STATUS
            $this->loadModel('Status');
            $status = $this->Status->find('all', [
                'conditions' => ['hidden' => '0'],
            ])->toArray();
            foreach($status as $a){
                $aStatus[$a["id"]] = $a;
            }
            // END STATUS

            $this->set("aOrders", $aOrders);
            $this->set("aStatus", $aStatus);


        }

        // ANDERS, WEGWEZEN !!
        else{
            $this->Flash->error(__('U bent niet gemachtigd om deze pagina te bekijken.'));
            return $this->redirect('/dashboard/');
        }
    }
}
