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
class OrderController extends AppController
{

    public $m_aHelperText = [];

    public function initialize()
    {
        parent::initialize();
        $this->m_aHelperText[__FUNCTION__] = [
            'nl' => '	Hier heeft u een overzicht van al uw orders. In het menu kunt u een filter toepassen om een specifieke status te bekijken. U kunt hier ook orders opnieuw bestellen en het transport van uw order volgen.',
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

        $this->loadModel("Order");
        $this->loadModel("TempOrders");
        $this->loadModel("TrackTrace");

        $aStatus = $this->Order->getStatusArray();

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


        if($p_iStatus != null){
            $this->loadComponent('Functions');

            // MERGE ORDERED + PART.ORDERED
            if($p_iStatus == 0){
                $aStatusShown = [0,1];
                $this->Functions->filter_array($aList, "ORDORSTATUS", $aStatusShown, "in_array");
            }
            // SHOW ALL OTHERS
            else{
                $this->Functions->filter_array($aList, "ORDORSTATUS", $p_iStatus);
            }

            $this->set("iStatus".$p_iStatus, "active");
            $this->set("sStatus", $aStatus[$p_iStatus]["text"]);
        }else{
            $this->set("iStatus", "active");
            $this->set("sStatus", 'All');
        }

        $this->set("aList", $aList);

    }


    public function __overview(){

        $aStatusShown = [0,1];

        $this->loadModel("Order");
        $aList = $this->Order->getOrderListCustomer($this->m_iPartner);
        $this->Order->setOrderListStatus($aList);

        $this->loadComponent('Functions');
        $this->Functions->filter_array($aList, "ORDORSTATUS", $aStatusShown, "in_array");

        $this->set("iStatusX", "active");
        $this->set("sStatus", "Trending");
        $this->set("aList", $aList);

        // IMPORTANT:: FORCE INDEX VIEW !!
        $this->render('/Order/index');

    }





    public function view($p_sNrint){

        $this->loadModel("Order");
        $this->loadModel("TempOrders");
        $this->loadModel("TrackTrace");

        $aInvoices = [];
        if(is_numeric($p_sNrint)){
            $aOrder = $this->TempOrders->getTempOrder($p_sNrint, $this->m_iPartner);
            $aTraces = $this->TrackTrace->getOrderTraces($aOrder);

            $aOrder->ORDORSTATUS = $this->Order->setOrderStatus($aOrder->OrderLine);

            $this->Order->setStatusText($aOrder);
        }else{
            $aOrder = $this->Order->getOrderCustomer($p_sNrint, $this->m_iPartner);
            $aTraces = $this->TrackTrace->getOrderTraces($aOrder);

            $aOrder->ORDORSTATUS = $this->Order->setOrderStatus($aOrder->OrderLine);

            $this->TrackTrace->setOrderStatus($aOrder);
            $this->Order->setStatusText($aOrder);

            $aInvoices = $this->Order->getInvoiceNrintFromOrderLine($aOrder);
        }


        $this->loadComponent("Media");
        $sProof = $this->Media->getProofPdf($aOrder->Address->BKHADCODE, $aOrder->ORDORNR);


        $this->set("aOrder", $aOrder);
        $this->set("aTraces", $aTraces);
        $this->set("aInvoices", $aInvoices);
        $this->set("sProof", $sProof);

    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->set("aPageHelper", $this->m_aHelperText);
    }

}
