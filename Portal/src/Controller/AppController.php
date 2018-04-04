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

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Log\Log;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $m_aOnlineIDs = [
        8001 => 2,
        8002 => 23,
        8003 => 61,
        8004 => 44,
        8005 => 100,
        8006 => 5,
        8007 => 34,
        8008 => 93,
        8009 => 93,
        8010 => 223,
        8011 => 92,
        8014 => 93,
        8016 => 93,
        8017 => 82,
        8018 => 38,
        8019 => 226
    ];


    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $loginSession = $this->request->session()->read('customerlogin');

        /**
         * GET HODI COMPANY CONFIG
         */
        require ROOT . DS .  'config' . DS . 'hodi_config.php';
        $oHodiConfig = new \HodiConfig();
        $oHodiConfig->setDefaultConfig();

        // SET PARTNER CONFIG
        if($loginSession) {
            if ($loginSession["customer_invoice_to"] != "") {
                $conf = $oHodiConfig->setCompanyConfig($loginSession["customer_invoice_to"]);
            } else {
                $conf = $oHodiConfig->setCompanyConfig("VM");
            }
        }else{
            $conf = $oHodiConfig->setCompanyConfig("");
        }
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        foreach($conf as $flash){
            foreach($flash as $type => $message){
                $this->Flash->set($message, ["element" => $type]);
            }
        }

        /**
         * Trigger Front-end-auth
         */
        $aNoLogin = ['Authorization'];
        if(is_null($loginSession['customer_nrint']) && !in_array($this->request->params['controller'], $aNoLogin)){
            Configure::write('Config.language', 'en');
            header('Location: /authorization/login');
            die();
        }elseif(!is_null($loginSession['customer_nrint'])){

            Log::config('CustomerInfo', [
                'className' => 'File',
                'path' => LOGS,
                'levels' => [],
                'scopes' => ['customerInfo'],
                'file' => '_customerinfo.log',
            ]);

            Log::config('BrowserInfo', [
                'className' => 'File',
                'path' => LOGS,
                'levels' => [],
                'scopes' => ['browserInfo'],
                'file' => '_browserinfo.log',
            ]);

            Log::config('HodiInfo', [
                'className' => 'File',
                'path' => LOGS,
                'levels' => [],
                'scopes' => ['hodiInfo'],
                'file' => '_hodiinfo.log',
            ]);


            // SET LANGUAGE !!
            if($loginSession["customer_force_language"] != ""){
                ini_set('intl.default_locale', $loginSession["customer_force_language"]);
                Configure::write('Config.language', $loginSession["customer_force_language"]);
            }elseif($loginSession["customer_language"] != ""){
                ini_set('intl.default_locale', $loginSession["customer_language"]);
                Configure::write('Config.language', $loginSession["customer_language"]);
            }else{
                ini_set('intl.default_locale', 'en');
                Configure::write('Config.language', 'en');
            }

            // SET PARTNER !!
            $this->m_iPartner = $loginSession['customer_nrint'];
            $this->set("sCustomerNrint", $this->m_iPartner);

            // SET PRICEGROUP !!
            $this->loadModel("PriceGroup");
            $this->loadModel("Address");
            $this->m_aPriceGroup = $this->Address->get($this->m_iPartner, [
                "fields" => [
                    "BKHPGNRINT" => "PriceGroup.BKHPGNRINT",
                    "BKHPG_BKHPGNRINT" => "PriceGroup.BKHPG_BKHPGNRINT",
                    "BKHPGPERCENTAGE" => "PriceGroup.BKHPGPERCENTAGE",
                ],
                "contain" => [
                    "PriceGroup"
                ]
            ]);
            if($this->m_aPriceGroup->BKHPGNRINT == null){
                $this->m_aPriceGroup->BKHPGNRINT = HD_DEFAULT_PRICEGROUP;
            }
            $this->request->session()->write('customerlogin.PriceGroup', $this->m_aPriceGroup);

            // SET ACCOUNTMANAGER
            $this->loadModel("HdAddress");
            $this->m_aHdAddress = $this->HdAddress->get(
                $this->m_iPartner,
                [
                    "fields" => ["Employee.ORDMWNRINT", "Employee.ORDMWROEPNAAM", "HdEmployee.telephone", "HdEmployee.emailaddress"],
                    "contain" => ["Employee.HdEmployee"]
                ]);
            $this->request->session()->write('customerlogin.Accountmanager', $this->m_aHdAddress->Employee);

            // LOG ACTION !!
            $this->loadComponent("LogHodi");
            $this->LogHodi->log();

            // START CART !!
            $sCartClass = HD_CART_CLASS;
            $sStartSession = isset($this->request->query['startsession']) ? $this->request->query['startsession'] : "0";
            $this->loadComponent('ArticleHelper');
            $this->loadComponent($sCartClass);
            $this->$sCartClass->getCart($sStartSession);
            $aCustomerArticles = $this->ArticleHelper->getArticleListCustomerCompact($this->m_iPartner);

            $this->set("aCustomerArticles", $aCustomerArticles);
            $this->set("aGBLink", $this->m_aOnlineIDs);
        }

        /**
         * TRIGGER ACTIVE MENU ITEM
         */
        $this->set("menuItem_".$this->name, "active");
        $this->set("menuItemSub_".$this->name, "toggled");
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
