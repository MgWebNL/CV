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
class QuotationController extends AppController
{
    public $m_aHelperText = [];

    public function initialize()
    {
        parent::initialize();
        $this->m_aHelperText[__FUNCTION__] = [
            'nl' => 'Hier heeft u een overzicht van al uw offertes. In het menu kunt u een filter toepassen om een specifieke status te bekijken. U kunt hier ook offertes annuleren, wijzigen en orderen.',
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

        $this->loadModel("Quotation");

        $aStatus = $this->Quotation->getStatusArray();

        $aList = $this->Quotation->getQuotationListCustomer($this->m_iPartner);

        $this->Quotation->setStatusTextList($aList);

        if($p_iStatus != null){
            $this->loadComponent('Functions');

            // MERGE ORDERED + PART.ORDERED
            if($p_iStatus == 1){
                $aStatusShown = [1,3];
                $this->Functions->filter_array($aList, "ORDOFSTATUS", $aStatusShown, "in_array");
            }
            // SHOW ALL OTHERS
            else{
                $this->Functions->filter_array($aList, "ORDOFSTATUS", $p_iStatus);
            }

            $this->set("iStatus".$p_iStatus, "active");
            $this->set("sStatus", $aStatus[$p_iStatus]["text"]);
        }else{
            $this->set("iStatus", "active");
            $this->set("sStatus", 'All');
        }

        $this->set("aList", $aList);

    }

    public function view($p_sNrint){

        $this->loadModel("Quotation");
        $this->loadModel("OrderLine");

        $aQuotation = $this->Quotation->getQuotationCustomer($p_sNrint, $this->m_iPartner);
        $aOrderCount = $this->OrderLine->orderCountArticle($aQuotation->QuotationLine);

        $this->Quotation->setStatusText($aQuotation);

        $this->set("aQuotation", $aQuotation);
        $this->set("aOrderCount", $aOrderCount);

    }

    public function sendNewRequest(){
        if($this->request->is('post')){
            $aPost = $this->request->data();
            $this->loadModel("CustomerLogin");
            $aUser = $this->CustomerLogin->getUserById($this->request->session()->read('customerlogin')["customer_user_id"]);

            //$p_sEmailaddress = "mike@hd-it.nl";
            $p_sEmailaddress = HD_EMAIL;

            $to = ($p_sEmailaddress == '') ? HD_EMAIL : $p_sEmailaddress;

            $email = new Email();
            $email
                ->emailFormat('html')
                ->from([HD_EMAIL_NOREPLY => HD_COMPANYNAME])
                ->template('nl/newQuoteRequest')
                ->to($to)
                ->subject('Portal - Nieuwe offerteaanvraag')
                ->viewVars([
                    'customerCode' => $aUser->Address->BKHADCODE,
                    'customerName' => $aUser->Address->BKHADNAAM,
                    'request' => $aPost["request"],
                    'userName' => $aUser->full_name,
                    'userEmail' => $aUser->emailaddress,
                    'userTel' => $aUser->telephone
                ])
                ->send();

            $this->Flash->success(__('Your request has been submitted.'));
            $this->redirect('/Quotation/');

        }else{
            $this->Flash->error(__('You\'ve been redirected here because have no permissions for the page you tried to visit.'));
            $this->redirect('/');
        }
    }

    public function answerQuotation(){
        if($this->request->is('post')){
            $aPost = $this->request->data();
            $aTemplates = [
                -1 => "reject",
                1  => "approve"
            ];

            $aConversionOhmegaOfferteStatus = [
                // Tempstatus => OhmegaStatus
                -1 => 2,
                1  => 1
            ];

            $this->loadModel("CustomerLogin");
            $aUser = $this->CustomerLogin->getUserById($this->request->session()->read('customerlogin')["customer_user_id"]);

            $this->loadModel("Quotation");
            $aQuote = $this->Quotation->get($aPost["quotation_nrint"], ["contain" => ["QuotationLine"]]);

            // SAVE ANSWER IN TEMP
            //if($aPost["answer"] != 1) {
            $this->loadModel("TempQuotationStatus");
            $id = $this->TempQuotationStatus->checkTempQuote($aPost["quotation_nrint"]);
            if ($id == 0) {
                $a = $this->TempQuotationStatus->newEntity();
                $a->offerte_id = $aPost["quotation_nrint"];
            } else {
                $a = $this->TempQuotationStatus->get($id);
            }
            $a->new_status = $aConversionOhmegaOfferteStatus[$aPost["answer"]];
            $a->reason = isset($aPost["changes"]) ? $aPost["changes"] : "";
            $a->timestamp = date('Y-m-d H:i:s');
            $a->user_email = $this->request->session()->read('customerlogin')["customer_user_email"];
            $this->TempQuotationStatus->save($a);

            $p_sEmailaddress = HD_EMAIL;
            //$p_sEmailaddress = "rene@hodi.nl";

            $to = ($p_sEmailaddress == '') ? HD_EMAIL : $p_sEmailaddress;

            $email = new Email();
            $email
                ->emailFormat('html')
                ->from([HD_EMAIL_NOREPLY => HD_COMPANYNAME])
                ->template('nl/' . $aTemplates[$aPost["answer"]] . 'Quote')
                ->to($to)
                ->subject('Portal - Offerte ' . $aQuote->ORDOFNR)
                ->viewVars([
                    'customerCode' => $aUser->Address->BKHADCODE,
                    'customerName' => $aUser->Address->BKHADNAAM,
                    'quoteChanges' => isset($aPost["changes"]) ? $aPost["changes"] : "",
                    'quoteNo' => $aQuote->ORDOFNR,
                    'quoteDesc' => $aQuote->ORDOFOMS,
                    'userName' => $aUser->full_name,
                    'userEmail' => $aUser->emailaddress,
                    'userTel' => $aUser->telephone,
                ])
                ->send();

            $this->Flash->success(__('The change of status of your quote has been sent.'));
            return $this->redirect('/Quotation/index/0/');
            //}

//            // MAAK ORDER IN WINKELWAGEN
//            else{
//                $cartClass = HD_CART_CLASS;
//                $this->loadComponent($cartClass);
//                foreach($aQuote->QuotationLine as $line){
//                    if($line["ORDFR_BKHARNRINT"] != "") {
//                        $this->$cartClass->add($line["ORDFR_BKHARNRINT"], $line["ORDFRAANTAL"], $line["ORDFRPRIJS"]);
//                    }
//                }
//                $this->request->session()->write('cartOptions.remark', 'Besteld: Offerte #'.$aQuote->ORDOFNR);
//                return $this->redirect('/Cart/');
//            }

        }else{
            $this->Flash->error(__('You\'ve been redirected here because have no permissions for the page you tried to visit.'));
            $this->redirect('/');
        }
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->set("aPageHelper", $this->m_aHelperText);
    }

}
