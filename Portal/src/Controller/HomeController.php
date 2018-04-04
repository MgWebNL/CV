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
use Cake\Event\Event;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class HomeController extends AppController
{
    public $m_aHelperText = [];

    public function initialize()
    {
        parent::initialize();
        $this->m_aHelperText[__FUNCTION__] = [
            'nl' => 'Op uw dashboard ziet u een beknopte weergave van de lopende zaken en actiepunten in uw Portal. Ook wordt hier uw besteladvies weergegeven.',
        ];

    }

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index(){
//        $this->m_aHelperText[__FUNCTION__] = [
//            'nl' => 'Indien er geen beschijving wordt toegevoegd aan een pagina, zal deze knop niet zichtbaar zijn.',
//            'en' => 'When a description is not provided, this button will not show.'
//        ];

        $aModules = $this->loadDashboard(
            [
                ["quotes", 12, 6, 4, 4],
                ["orders", 12, 6, 4, 4],
                ["invoiceOpen", 12, 6, 4, 4],
                ["invoiceExpired", 12, 6, 4, 4],
                ["trackTrace", 12, 6, 4, 4],
                ["recommended", 12, 6, 4, 4],
                ["orderAdvice", 12, 12, 12, 12],
                ["crossselling", 12, 12, 6, 6],
                ["helpvideo", 12, 12, 6, 6],
            ]
        );

        $this->set("aModules", $aModules);
    }

    private function setKeysArray(&$p_aArray, $p_aKeys){
        $i = 0;
        $newArray = [];
        foreach($p_aArray as $v){
            $newArray[$p_aKeys[$i]] = $v;
            $i++;
        }
        $p_aArray = $newArray;
    }

    private function loadDashboard($p_aOptions){
    /** OPBOUW VAN ARRAY $p_aOptions
     *  [
     *      [MODULE, XS, SM, MD, LG]
     *  ]
     */
        $aActiveModules = [];
        foreach($p_aOptions as $aModule){
            $moduleFunction = "loadDashboardModule".ucfirst($aModule[0]);
            $aModule[] = $this->$moduleFunction();
            $this->setKeysArray($aModule, ["name", "xs", "sm", "md", "lg", "count"]);
            $aActiveModules[] = $aModule;
        }
        return $aActiveModules;
    }

    private function loadDashboardModuleQuotes(){
        $this->loadModel("Quotation");
        $aList = $this->Quotation->getQuotationListCustomer($this->m_iPartner);
        $this->loadComponent('Functions');
        $this->Functions->filter_array($aList, "ORDOFSTATUS", 0);
        return count($aList);
    }

    private function loadDashboardModuleOrders(){
        $this->loadModel("Order");
        $this->loadModel("TempOrders");
        $this->loadModel("TrackTrace");

//        $aList = $this->Order->getOrderListCustomer($this->m_iPartner)->all();
//        $this->Order->setOrderListStatus($aList);
//        $this->TrackTrace->setOrderListStatus($aList);

        // ORDERS OHMEGA
        $aList1 = $this->Order->getOrderListCustomer($this->m_iPartner);
        $this->Order->setOrderListStatus($aList1);
        $this->TrackTrace->setOrderListStatus($aList1);
        $this->Order->setStatusTextList($aList1);

        // ORDERS TEMP
        $aList2 = $this->TempOrders->getTempOrdersCustomer($this->m_iPartner);
        $this->Order->setOrderListStatus($aList2);
        //$this->TrackTrace->setOrderListStatus($aList2);
        $this->Order->setStatusTextList($aList2);

        // MERGE !!
        $aList = $aList1->append($aList2);
        $aList = $aList->sortBy('ORDORDATUM', SORT_DESC);
        $aList = $aList->toList();

        $this->loadComponent('Functions');
        $this->Functions->filter_array($aList, "ORDORSTATUS", [0,1], "in_array");

        return count($aList);
    }

    private function loadDashboardModuleInvoiceOpen(){
        $this->loadModel("Invoice");
        return $this->Invoice->getOpenAmountCustomer($this->m_iPartner);
    }

    private function loadDashboardModuleInvoiceExpired(){
        $this->loadModel("Invoice");
        return $this->Invoice->getOpenAmountCustomer($this->m_iPartner);
    }

    private function loadDashboardModuleTrackTrace(){
        $this->loadModel("TrackTrace");
        return $this->TrackTrace->getTracesByCustomer($this->m_iPartner);
    }

    private function loadDashboardModuleRecommended(){
        $this->loadModel("Ledger");
        $this->loadModel("OrderLine");
        $aGBs = unserialize(HD_ARRAY_EXCLUDE_GB);

        // ALLEMAAL
        $ledger = $this->Ledger->find()->where(["BKHGBNR LIKE" => '8%', "BKHGBNR NOT IN" => $aGBs], ["BKHGBNR" => "string"])->order(["BKHGBNR"])->all();
        $oAll = $this->Functions->mergeToObjectKey($ledger, "BKHGBNRINT");

        // VERKOCHT LAATSTE JAAR
        $latest = $this->OrderLine->query();
        $latest
            ->select(["ORDRR_BKHGBNRINT"])
            ->contain(["Order"])
            ->where([
                "ORDRR_BKHGBNRINT <>" => "",
                "Order.ORDOR_BKHADNRINT" => $this->m_iPartner,
                "Order.ORDORDATUM >=" => date('Y-m-d', strtotime("-1 years"))
            ])
            ->group(["ORDRR_BKHGBNRINT"]);
        $aLatest = $latest->toList();

        $oLatest = $this->Functions->mergeToObjectKey($aLatest, "ORDRR_BKHGBNRINT");
        $iNoOrder = count((array)$oAll);

        foreach($oAll as $k=>$v){
            if(isset($oLatest->$k)){
                $iNoOrder--;
            }
        }

        return $iNoOrder;

    }

    private function loadDashboardModuleCrossselling(){
        $this->loadComponent("ArticleHelper");
        return $this->ArticleHelper->getCrosssell();
    }

    private function loadDashboardModuleHelpvideo(){
        return [];
    }

    private function loadDashboardModuleOrderAdvice(){
        return [];
    }

    private function OLD_______loadDashboardModuleOrderAdvice(){
        $startDate = date('Y-m-d', strtotime("-".HD_ADVICE_MARGE." months"));
        $endDate = date('Y-m-d', strtotime("+".HD_ADVICE_MARGE." months"));
        $this->loadComponent("ArticleHelper");
        $a = $this->ArticleHelper->getArticleListCustomerAdvice($this->m_iPartner);
        $aRet = $this->ArticleHelper->setAdvicePeriod($a, $startDate, $endDate);

        return $aRet;

    }

    public function loadDashboardModuleOrderAdviceAjax(){
        $startDate = date('Y-m-d', strtotime("-".HD_ADVICE_MARGE." months"));
        $endDate = date('Y-m-d', strtotime("+".HD_ADVICE_MARGE." months"));
        $this->loadComponent("ArticleHelper");
        $this->loadComponent("Functions");
        $a = $this->ArticleHelper->getArticleListCustomerAdvice2($this->m_iPartner);
        $aRet = $this->ArticleHelper->setAdvicePeriod2($a, $startDate, $endDate);

        foreach($aRet as $k => $aArt){
            $aPrices = $this->ArticleHelper->getArticleBulkPricesCustomer($aArt->BKHARNRINT, $this->m_iPartner, 0);
            $aRet[$k]["ArticleUsage"]["opt_bst"] = $this->ArticleHelper->roundOptBstQuantity2($aArt, $aPrices);
        }


        $aModule = ["orderAdvice", 12, 12, 12, 12];
        $aModule[] = $aRet;
        $this->setKeysArray($aModule, ["name", "xs", "sm", "md", "lg", "count"]);

        foreach($aModule as $k => $v){
            $this->set($k, $v);
        }

//        $this->viewBuilder()->layout(false);
        $this->render('/Element/Dashboard/Ajax/orderAdvice');

    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->set("aPageHelper", $this->m_aHelperText);
    }






    public function checkIpAjax($p_sDomain, $p_sIP){
        $this->viewBuilder()->layout(false);
        $this->render(false);
        $this->loadComponent("IP");
        $this->IP->dnsbllookup($p_sDomain, $p_sIP);
    }

    public function saveBlacklistAjax($p_sDomain, $p_sIP){
        $this->viewBuilder()->layout(false);
        $this->render(false);

    }

    public function checkIp($p_sIP){
        $this->set("ip", $p_sIP);
    }












































































    public function convertLogin(){
        $this->render(false);

        $this->loadModel("OldCustomerLogin");
        $aList = $this->OldCustomerLogin->find()
            ->select([
                "nrint" => "OldCustomerLogin.FRbkhADRES_NRINT",
                "username" => "Address.BKHADGEBRUIKERSNAAM",
                "password" => "OldCustomerPwdLogin.FRbkhPASSWORD",
                "contact" => "Address.BKHADTAV_D",
                "telephone" => "Address.BKHADTELEFOON",
                "oldPassword" => "OldCustomerLogin.password",
                "oldUserName" => "Address.BKHADGEBRUIKERSNAAM"

            ])
            ->contain(["Address", "OldCustomerPwdLogin"])
            ->where(["BKHADGEBRUIKERSNAAM <>" => ''])
            //->limit(1)
            ->all();

        $this->loadModel("CustomerLogin");
        foreach($aList as $user){
            $this->CustomerLogin->createNewUser($user);
        }
        debug($aList); die();


    }
}
