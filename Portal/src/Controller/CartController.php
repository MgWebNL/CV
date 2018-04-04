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
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;
use Cake\Event\Event;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class CartController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->m_iTransportCostCart = $this->calculateTransport();
        $this->set('iTransportCostCart', $this->m_iTransportCostCart);

    }

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index(){

        $aCart = $this->request->session()->read("Cart");
        $aCart = $aCart->sortBy('article_name');

        $this->set('aCart', $aCart);

    }

    public function address(){

        $this->loadModel("Address");
        $this->loadModel("AddressDelivery");
        $this->loadComponent("Functions");

        $aCart = $this->request->session()->read("Cart");
        $aCart = $aCart->sortBy('article_name');

        $aAddresses = $this->Functions->mergeToObjectKey($this->AddressDelivery->getAddressesByNrint($this->m_iPartner), "BKHAAFNRINT");
        $key = $this->Functions->getKey($aAddresses, 1);

        $sessionCartOptions = ($this->request->session()->read('cartOptions'));
        $aAddress = isset($sessionCartOptions["delivery-address"]) != "" ? $aAddresses->{$sessionCartOptions["delivery-address"]} : $aAddresses->{$key} ;

        $aCustomer = $this->Address->get($this->m_iPartner, ["contain" => ["Country"]]);
        $iDeliveryDays = (date('H') < HD_DELIVERY_TIME) ? HD_DELIVERY_DAYS : (HD_DELIVERY_DAYS + 1);
        $aDeliveryDateMin = new Time(date('Y-m-d', strtotime('+'.$iDeliveryDays." weekday")));


        $this->set('aCart', $aCart);
        $this->set('aAddresses', $aAddresses);
        $this->set('aAddress', $aAddress);
        $this->set('aCustomer', $aCustomer);
        $this->set('aDeliveryDateMin', $aDeliveryDateMin);
    }

    public function summary(){

        $this->loadModel("Address");
        $this->loadModel("AddressDelivery");
        $this->loadComponent("Functions");

        $aCart = $this->request->session()->read("Cart");
        $aCart = $aCart->sortBy('article_name');

        $aAddresses = $this->Functions->mergeToObjectKey($this->AddressDelivery->getAddressesByNrint($this->m_iPartner), "BKHAAFNRINT");
        $key = $this->Functions->getKey($aAddresses, 1);

        $sessionCartOptions = ($this->request->session()->read('cartOptions'));
        $aAddress = isset($sessionCartOptions["delivery-address"]) != "" ? $aAddresses->{$sessionCartOptions["delivery-address"]} : $aAddresses->{$key} ;

        $aCustomer = $this->Address->get($this->m_iPartner, ["contain" => ["Country"]]);
        $iDeliveryDays = (date('H') < HD_DELIVERY_TIME) ? HD_DELIVERY_DAYS : (HD_DELIVERY_DAYS + 1);
        $aDeliveryDateMin = new Time(date('Y-m-d', strtotime('+'.$iDeliveryDays." weekday")));


        $this->set('aCart', $aCart);
        $this->set('aAddresses', $aAddresses);
        $this->set('aAddress', $aAddress);
        $this->set('aCustomer', $aCustomer);
        $this->set('aDeliveryDateMin', $aDeliveryDateMin);
    }





    public function add(){
        if($this->request->is('post')){
            $aPost = $this->request->data();

            $cartClass = HD_CART_CLASS;
            $this->loadComponent($cartClass);
            $this->$cartClass->add($aPost["article_id"], $aPost["quantity"]);

            $this->redirect('/Cart/');

        }else{
            $this->Flash->error(__('You\'ve been redirected here because have no permissions for the page you tried to visit.'));
            $this->redirect('/');
        }
    }

    public function addListFromOrderAdvice(){
        if($this->request->is('post')){
            $aPost = $this->request->data();
            $cartClass = HD_CART_CLASS;
            $this->loadComponent($cartClass);

            foreach($aPost["article"] as $nrint => $code){
                if($code != "") {
                    $this->$cartClass->add($nrint, $aPost["quantity"][$nrint]);
                }
            }
            $this->redirect('/Cart/');

        }else{
            $this->Flash->error(__('You\'ve been redirected here because have no permissions for the page you tried to visit.'));
            $this->redirect('/');
        }
    }

    public function destroy(){
        if($this->request->is('post')){
            $aPost = $this->request->data();

            $cartClass = HD_CART_CLASS;
            $this->loadComponent($cartClass);
            $this->$cartClass->destroy();

            $this->request->session()->delete("cartOptions");
            $this->request->session()->delete("cartOptions2");

            $this->redirect('/Cart/');

        }else{
            $this->Flash->error(__('You\'ve been redirected here because have no permissions for the page you tried to visit.'));
            $this->redirect('/');
        }
    }

    private function destroyForce(){
        $cartClass = HD_CART_CLASS;
        $this->loadComponent($cartClass);
        $this->$cartClass->destroy();
    }

    private function remove($id){
        $cartClass = HD_CART_CLASS;
        $this->loadComponent($cartClass);
        $this->$cartClass->remove($id);
    }

    public function reorder(){
        if($this->request->is('post')){
            $aPost = $this->request->data();
            $cartClass = HD_CART_CLASS;
            $this->loadComponent($cartClass);

            foreach($aPost["article"] as $nrint => $code){
                if($code != "") {
                    $this->$cartClass->add($code, $aPost["quantity"][$nrint]);
                }
            }
            $this->redirect('/Cart/');

        }else{
            $this->Flash->error(__('You\'ve been redirected here because have no permissions for the page you tried to visit.'));
            $this->redirect('/');
        }
    }

    public function processCart(){
        if($this->request->is('post')){

            $cartClass = HD_CART_CLASS;
            $this->loadComponent($cartClass);

            $aPost = $this->request->data;

            if($aPost["submitType"] == "reload"){
                $aForcedPrices = isset($aPost["force"]) ? $aPost["force"] : [];
                $this->destroyForce();
                foreach($aPost["qty"] as $id => $qty){
                    $price = isset($aForcedPrices[$id]) ? $aForcedPrices[$id] : false;
                    $this->$cartClass->add($id, $qty, $price);
                }
                return $this->redirect('/Cart/');
            }

            if($aPost["submitType"] == "next"){
                $aForcedPrices = isset($aPost["force"]) ? $aPost["force"] : [];
                $this->destroyForce();
                foreach($aPost["qty"] as $id => $qty){
                    $price = isset($aForcedPrices[$id]) ? $aForcedPrices[$id] : false;
                    $this->$cartClass->add($id, $qty, $price);
                }
                return $this->redirect('/Cart/Address/');
            }

            if(isset($aPost["remove"]) && $aPost["submitType"] == ""){
                $this->remove($aPost["remove"]);
                return $this->redirect('/Cart/');
            }
        }else{
            $this->Flash->error(__('You\'ve been redirected here because have no permissions for the page you tried to visit.'));
            return $this->redirect('/');
        }
    }

    public function saveDelivery(){
        if($this->request->is('post')){

            $cartClass = HD_CART_CLASS;
            $this->loadComponent($cartClass);

            $aPost = $this->request->data;

            $this->request->session()->write('cartOptions', $aPost);

            return $this->redirect('/Cart/Summary/');
        }else{
            $this->Flash->error(__('You\'ve been redirected here because have no permissions for the page you tried to visit.'));
            $this->redirect('/');
        }
    }

    public function savePayment(){
        if($this->request->is('post')){

            $cartClass = HD_CART_CLASS;
            $this->loadComponent($cartClass);

            $aPost = $this->request->data;

            //$this->redeemCode();
            $aPost["coupon"] = "";

            $this->request->session()->write('cartOptions2', $aPost);

            return $this->redirect('/Cart/Summary/');
        }else{
            $this->Flash->error(__('You\'ve been redirected here because have no permissions for the page you tried to visit.'));
            $this->redirect('/');
        }
    }

    public function makeOrder(){
        if($this->request->is('post')){

            $this->loadModel('Address');
            $this->loadModel('OrdAddress');
            $this->loadModel('AddressDelivery');

            $aCart = [];

            $cart = $this->request->session()->read('Cart');
            $aCart["lines"] = $cart->sortBy('article_name');
            $aCart["basis"] = $cartOptions = $this->request->session()->read('cartOptions');

            // HAAL AFLEVERADRES OP
            if($cartOptions["delivery-method"] != 'pickup'){
                $aCart["basis"]["delAdres"] = $delAdres = $this->AddressDelivery->getAddressInMarkup($cartOptions["delivery-address"]);
            }else{
                $aCart["basis"]["delAdres"] = $delAdres = "AFHALEN";
            }

            // HAAL FACTUURADRES OP
            $aCart["basis"]["adres"] = $adres = $this->Address->getAddressInMarkup($this->m_iPartner);

            // BEPAAL BEZORGDATUM
            if($cartOptions["delivery-date"] == 'sap'){
                $aCart["basis"]["delDate"] = $leverdatum = $cartOptions["delivery-date-date"];
            }else{
                $aCart["basis"]["delDate"] = $leverdatum = "Zie orderregels";
            }

            $aCart["basis"]["customer_id"] = $this->m_iPartner;
            $aCart["basis"]["contact"] = $this->request->session()->read('customerlogin')["customer_user_name"];

            // TEMP_ORDER VULLEN
            $this->loadModel("TempOrders");
            $this->loadModel("TempOrderRules");

            $this->loadModel('OrdAddress');
            $aOrdAddress = $this->OrdAddress->get($this->m_iPartner);

            $id = $this->TempOrders->saveTempOrder($aCart, $aOrdAddress->ORDAR_GEENTRANSPORT_COST);
            $this->TempOrderRules->saveTempOrderRules($aCart, $id, $this->m_iTransportCostCart);
            // HAAL WEER OP, GEEF MEE AAN MAIL
            $aOrder = $this->TempOrders->get($id, ['contain' => ["TempOrderRules" => function($q){
                return $q->order(["article"]);
            }]]);

            // Check of de klant vervallen facturen heeft. Zo ja weiger de order
//            $this->loadComponent('Rejected');
//            $this->Rejected->rejectOrder($id, $this->m_iPartner, 4);

            // VERSTUUR EMAIL TER BEVESTIGING
            $email = new Email();
            $email
                ->emailFormat('html')
                ->from([HD_EMAIL_NOREPLY => HD_COMPANYNAME])
                ->template('nl/orderConfirmation')
                ->to(HD_EMAIL)
                //->to("mike@hd-it.nl")
                ->subject('Portal - Nieuwe order')
                ->viewVars([
                    'aCart' => $aCart,
                    'aOrder' => $aOrder
                ])
                ->send();

            $this->Flash->success(__('Your order has successfully been sent. Thank you for your purchase.'));

            $this->destroyForce();

            return $this->redirect('/');
        }else{
            $this->Flash->error(__('You\'ve been redirected here because have no permissions for the page you tried to visit.'));
            $this->redirect('/');
        }
    }

    private function calculateTransport(){
        $this->loadModel('OrdAddress');
        $aOrdAddress = $this->OrdAddress->get($this->m_iPartner);
        $aCart = $this->request->session()->read("Cart");
        $aCartOptions = $this->request->session()->read("cartOptions");

        //var_dump($aOrdAddress); die();

        $iTotal = 0;
        foreach($aCart as $item){
            $iTotal += $item->quantity * $item->article_price;
        }
        if($iTotal < HD_CART_TRANS_MIN && $aOrdAddress->ORDAR_GEENTRANSPORT_COST == 0 && $aCart->count() > 0 && $aCartOptions['delivery-method'] != 'pickup'){
            return HD_CART_TRANS;
        }
        return 0;
    }

}
