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
class ArticleController extends AppController
{
    public $m_aHelperText = [];

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadComponent("DatabaseHelper");

        $this->m_aHelperText[__FUNCTION__] = [
            'nl' => 'In dit overzicht staan alle artikelen die u al eens heeft besteld bij ons, gegroepeerd per productgroep. Ook wordt hier het besteladvies weergegeven voor deze artikelen. Artikelen zijn ingedeeld in afnamegroepen: Regulier, incidenteel, historie.',
        ];
    }


    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index($p_iStatus = null){

        $this->loadModel("Ledger");
        $this->loadComponent("ArticleHelper");
        $this->loadComponent("Functions");

        $a = $this->ArticleHelper->getArticleListCustomerAdvice($this->m_iPartner, $p_iStatus);

//        $aStatus = $this->ArticleHelper->getStatusArray();
//        $aList = $this->ArticleHelper->getArticleListCustomer($this->m_iPartner);
//        $aList->order(["BKHARCODE"]);
//
//        $this->ArticleHelper->truncateArticleDescription($aList);
//        $this->ArticleHelper->determineArticleType($aList);
//        $this->ArticleHelper->setStatusTextList($aList);
//        $this->ArticleHelper->setArticleListUsage($aList, $this->m_iPartner, 1);
//
//        //debug($aList); die();
//
//        if($p_iStatus != null){
//            $this->loadComponent('Functions');
//            $this->Functions->filter_array($aList, "BKHARCUSTOMERSTATUS", $p_iStatus);
//            $this->set("iStatus".$p_iStatus, "active");
//            $this->set("sStatus", $aStatus[$p_iStatus]["text"]);
//        }else{
//
//            $this->set("iStatus", "active");
//            $this->set("sStatus", 'All');
//        }
//
//        $aGBs = unserialize(HD_ARRAY_EXCLUDE_GB);
//
//        $ledger = $this->Ledger->find()->where(["BKHGBNR LIKE" => '8%', "BKHGBNR NOT IN" => $aGBs], ["BKHGBNR" => "string"])->order(["BKHGBNR"])->all();
//        $oLedger = $this->Functions->mergeToObjectKey($ledger, "BKHGBNRINT");
//        $aList = $this->Functions->groupByObjectKey($aList, "BKHAR_BKHGBNRINT_VF");
//        $a = new \stdClass();
//
//        foreach($oLedger as $ledger){
//            if(property_exists($aList,$ledger->BKHGBNRINT)){
//                $a->{$ledger->BKHGBNRINT} = $aList->{$ledger->BKHGBNRINT};
//            }
//        }

        $this->set("aList", $a);


    }

    public function order(){

        $startDate = date('Y-m-d', strtotime("-3 months"));
        $endDate = date('Y-m-d', strtotime("+3 months"));

        $this->loadComponent("ArticleHelper");
        $a = $this->ArticleHelper->getArticleListCustomerAdvice2($this->m_iPartner);
        $aList = $this->ArticleHelper->setAdvicePeriod2($a, $startDate, $endDate);

        foreach($aList as $k => $aArt){
            $aPrices = $this->ArticleHelper->getArticleBulkPricesCustomer($aArt->BKHARNRINT, $this->m_iPartner, 0);
            $aList[$k]["ArticleUsage"]["opt_bst"] = $this->ArticleHelper->roundOptBstQuantity2($aArt, $aPrices);
        }

        $this->set("iStatus3", 'active');
        $this->set("aList", $aList);

    }

    public function ondemand(){

        $this->loadModel("OrderLine");
        $this->loadComponent("ArticleHelper");
        $aList = $this->OrderLine->getDemandLines($this->m_iPartner);
        $this->ArticleHelper->truncateArticleDescription($aList);

        $this->set("iStatus4", 'active');
        $this->set("aList", $aList);


    }

    public function saveCustomerArticleCode(){
        if($this->request->is('post')){
            $aPost = $this->request->data();
            $this->loadModel("HdArticle");
            $aRow = $this->HdArticle->find()->where(["article_nrint" => $aPost["article_id"], "address_nrint" => $aPost["customer_id"]])->first();
            if(is_null($aRow)){
                $a = $this->HdArticle->newEntity();
                $a->FRbkhADRES_ADNRINT = $a->address_nrint = $aPost["customer_id"];
                $a->article_nrint = $aPost["article_id"];
            }else{
                $a = $aRow;
            }
            $a->customer_artNumber = $aPost["newCode"];

            $this->HdArticle->save($a);

            $this->Flash->success(__('Your article code has been updated'));
            return $this->redirect($this->referer());

        }else{
            $this->Flash->error(__('You have been redirected to the homepage because you made an illegal request'));
            return $this->redirect('/');
        }
    }





    public function view($p_sArticleNrint, $iRoundQty = 0){

        $this->loadComponent("ArticleHelper");
        $this->loadComponent("Media");

        $aStatus = $this->ArticleHelper->getStatusArray();
        $aList = $this->ArticleHelper->getArticleCustomer($p_sArticleNrint, $this->m_iPartner);

        $this->ArticleHelper->setAdditionalArticleInfoCustomer($aList, $this->m_iPartner);
        $this->ArticleHelper->setArticleListUsage($aList, $this->m_iPartner, 1);


        $this->ArticleHelper->determineArticleType($aList);
        $this->ArticleHelper->setStatusTextList($aList);

        $aList = $aList->first();
        if($iRoundQty > 0){
            $iOrder = $aList->ArticleUsage["opt_bst"] + 1;
            $iPallet = $aList->Article->BKHARPALLETFACTOR;
            $aList->ArticleUsage["opt_bst"] = ceil($iOrder / $iPallet) * $iPallet;
        }




        // TEST






        $this->set("aList", $aList);

    }



    public function ajax($p_sFunctionName){
        if($this->request->is('post')) {
            switch ($p_sFunctionName) {
                case "saveArticleNotification":
                    $this->saveArticleNotification($this->request->data);
                    break;
            }
            echo 1;
        }
        die();
    }

    /** AJAX FUNCTIONS ! **/
    private function saveArticleNotification($p_aData){
        $this->loadModel('HdCustomerArticle');
        $entry = $this->HdCustomerArticle->find('all')
            ->where([
                "address_nrint" => $p_aData["customer"],
                "article_nrint" => $p_aData["article"]
            ])->first();
        $a = [
            "id" => $entry->id,
            "notify" => $p_aData["value"]
        ];
        $this->DatabaseHelper->save("HdCustomerArticle", $a);
    }


    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->set("aPageHelper", $this->m_aHelperText);
    }


}