<?php

namespace App\Model\Table;

use Cake\I18n\Date;
use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class InvoiceTable extends Table
{

    public $m_oList;
    public $m_aConditions = [];
    public $m_aStatus = [
        0 => ["text" => "Open", "color" => "orange"],
        1 => ["text" => "Payment late", "color" => "red"],
        2 => ["text" => "Paid", "color" => "green"],
    ];

    public function initialize(array $config)
    {
        $this->table('FRbkhVERKFACT');
        $this->primaryKey('BKHVFNRINT');

        $this->hasOne('Address', [
            'propertyName' => 'Address',
            'foreignKey' => 'BKHADNRINT',
            'bindingKey' => 'BKHVF_BKHADNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('InvoiceLine', [
            'propertyName' => 'InvoiceLine',
            'foreignKey' => 'BKHVR_BKHVFNRINT',
            'bindingKey' => 'BKHVFNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('InvoicePayments', [
            'propertyName' => 'InvoicePayments',
            'foreignKey' => 'BKHVB_BKHVFNRINT',
            'bindingKey' => 'BKHVBNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('PaymentCondition', [
            'propertyName' => 'PaymentCondition',
            'foreignKey' => 'BKHBTNRINT',
            'bindingKey' => 'BKHVF_BKHBTNRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('HdOnlinePayments', [
            'propertyName' => 'HdOnlinePayments',
            'foreignKey' => 'BKHVFNRINT',
            'bindingKey' => 'BKHVFNRINT',
            'joinType' => 'LEFT',
        ]);

    }

    /**
     * @param $p_sCustomerNrint
     * @return $this
     *
     * BASISGEGEVENS ORDERLIJST PORTAL !!
     *
     */
    public function getInvoiceListCustomer($p_sCustomerNrint){
        return $this->find('all')
            ->select(["BKHVFNRINT", "BKHVFNR", "BKHVFDATUM", "BKHVFBEDRAG_EUR", "BKHVFDATUM_VV", "BKHVFOPEN_VAL", "BKHVFTEKST1", "BKHVFBTW", "BKHVFJAARPER", "BKHBTOMS" => "PaymentCondition.BKHBTOMS", "HdOnlinePayments.status"])
            ->contain(["PaymentCondition", "HdOnlinePayments"])
            ->where(["BKHVF_BKHADNRINT" => $p_sCustomerNrint])
            ->order(["BKHVFDATUM_VV" => "DESC"]);
    }
    public function __getInvoiceListCustomer($p_sCustomerNrint){
//        $aInvoices = $this->find('all')
//            ->select(["BKHVFNRINT", "BKHVFNR", "BKHVFDATUM", "BKHVFBEDRAG_EUR", "BKHVFDATUM_VV", "BKHVFOPEN_VAL", "InvoiceLine.BKHVRNRINT"])
//            ->contain(["InvoiceLine"])
//            ->where(["BKHVF_BKHADNRINT" => $p_sCustomerNrint])
//            ->order(["BKHVFDATUM_VV" => "DESC"]);

        $aInvoices = $this->find('all')
            ->select(["BKHVFNRINT", "BKHVFNR", "BKHVFDATUM", "BKHVFBEDRAG_EUR", "BKHVFDATUM_VV", "BKHVFOPEN_VAL"])
            ->contain(["InvoiceLine.Article.ArticleUnit" => function($q){ return $q->where(["BKHVRTYPE" => 0]); }, "Address.Country"])
            ->where(["BKHVF_BKHADNRINT" => $p_sCustomerNrint])
            ->order(["BKHVFDATUM_VV" => "DESC"]);

        foreach($aInvoices as $inv){
            // GET ADDITIONAL INVOICE INFO FROM ORDER
            $sOrderNrint = $this->getOrderNrintFromInvoiceLine($inv->InvoiceLine[0]->BKHVRNRINT);
            $this->Order = TableRegistry::get("Order");
            if(!is_null($sOrderNrint)) {
                $aOrder = $this->Order->getOrderCustomer($sOrderNrint, $p_sCustomerNrint);
            }else{
                $aOrder = [];
            }
            $inv->Order = $aOrder;
        }

        return $aInvoices;
    }

    /**
     * @param $p_sInvoiceNrint
     * @param $p_sCustomerNrint
     * @return mixed
     *
     * BASISGEGEVENS ORDER PORTAL !!
     *
     */
    public function getInvoiceCustomer($p_sInvoiceNrint, $p_sCustomerNrint){
        $aInvoice = $this->find('all')
            ->contain(["InvoiceLine.Article.ArticleUnit" => function($q){ return $q->where(["BKHVRTYPE" => 0]); }, "Address.Country"])
            ->where(["BKHVF_BKHADNRINT" => $p_sCustomerNrint, "BKHVFNRINT" => $p_sInvoiceNrint])
            ->first();

        // GET ADDITIONAL INVOICE INFO FROM ORDER
        if(!empty($aInvoice->InvoiceLine)) {
            $sOrderNrint = $this->getOrderNrintFromInvoiceLine($aInvoice->InvoiceLine[0]->BKHVRNRINT);
            $this->Order = TableRegistry::get("Order");
            $aOrder = $this->Order->getOrderCustomer($sOrderNrint, $p_sCustomerNrint);
        }else{
            $aOrder = null;
        }
        $aInvoice->Order = $aOrder;


        return $aInvoice;
    }

    public function getOpenAmountCustomer($p_sCustomerNrint){

        $query = $this->find('all')
            ->contain(["HdOnlinePayments"])
            ->where([
                //"HdOnlinePayments.status !=" => "Completed",
                "BKHVF_BKHADNRINT" => $p_sCustomerNrint,
                "BKHVFOPEN" => 1
            ]);

        $oInvoices = new \stdClass();
        @$oInvoices->Total->amount = 0;
        @$oInvoices->Total->invoices = [];
        @$oInvoices->Late->amount = 0;
        @$oInvoices->Late->invoices = [];
        @$oInvoices->Open->amount = 0;
        @$oInvoices->Open->invoices = [];

        $oNow = new Date();

        foreach($query as $inv){
            if(property_exists($inv, 'HdOnlinePayments') && $inv->HdOnlinePayments->status != "Completed") {
                if ($inv->BKHVFDATUM_VV < $oNow) {
                    $oInvoices->Late->invoices[] = $inv;
                    $oInvoices->Late->amount += $inv->BKHVFOPEN_VAL;
                } else {
                    $oInvoices->Open->invoices[] = $inv;
                    $oInvoices->Open->amount += $inv->BKHVFOPEN_VAL;
                }
                $oInvoices->Total->invoices[] = $inv;
                $oInvoices->Total->amount += $inv->BKHVFOPEN_VAL;
            }else{
                if ($inv->BKHVFDATUM_VV < $oNow) {
                    $oInvoices->Late->invoices[] = $inv;
                    $oInvoices->Late->amount += $inv->BKHVFOPEN_VAL;
                } else {
                    $oInvoices->Open->invoices[] = $inv;
                    $oInvoices->Open->amount += $inv->BKHVFOPEN_VAL;
                }
                $oInvoices->Total->invoices[] = $inv;
                $oInvoices->Total->amount += $inv->BKHVFOPEN_VAL;
            }
        }
        
        return $oInvoices;

    }



    /****************************************************/
    /****************** EXTRA FUNCTIES ******************/
    /****************************************************/

    /**
     * @return array
     */
    public function getStatusArray(){
        return $this->m_aStatus;
    }

    /**
     * @param $p_sInvoiceLineNrint
     * @return mixed
     */
    private function getOrderNrintFromInvoiceLine($p_sInvoiceLineNrint){
        $this->InvoiceLine = TableRegistry::get('InvoiceLine');
        $aOrder = $this->InvoiceLine->find('all')
            ->select(["Order.ORDORNRINT"])
            ->contain(['TussenRrVr.OrderLine.Order'])
            ->where(['BKHVRNRINT' => $p_sInvoiceLineNrint])
            ->first();

        return is_null($aOrder) ? null : $aOrder->Order->ORDORNRINT;
    }

    /**
     * @param $p_aList
     * @return mixed
     */
    public function setInvoiceListStatus($p_aList){
        if($p_aList->count() > 0){
            foreach($p_aList as $row){
                $row->BKHVFSTATUS = $this->setInvoiceStatus($row);
            }
            $this->setStatusTextList($p_aList);
        }
        return $p_aList;
    }

    /**
     * @param $p_sCustomerNrInt
     * @return array
     */
    public function getDueInvoices($p_sCustomerNrInt, $p_iAfterDays = 0){
        $result = $this->getInvoiceListCustomer($p_sCustomerNrInt);

        $oDate = new Time();
        $a = [];
        foreach($result as $row){

            $oDatevv = new Time($row->BKHVFDATUM_VV);
            if($p_iAfterDays !== 0){
                $oDatevv->modify('+'.$p_iAfterDays.' days');
            }

            if($oDatevv->format('Y-m-d') < $oDate->format("Y-m-d") && $row->BKHVFOPEN_VAL > 0){
                $a[] = $row;
            }
        }
        return $a;
    }

    /**
     * @param $p_aLines
     * @return int
     */
    public function setInvoiceStatus($p_aLine){

        $oTime = new Time();

        if(!is_null($p_aLine->HdOnlinePayments) && $p_aLine->HdOnlinePayments->status == "Completed"){
            return 2; // OPEN
        }

        if($p_aLine->BKHVFOPEN_VAL < 0 && $p_aLine->BKHVFBEDRAG_EUR > 0){
            return 0; // OPEN
        }

        if($p_aLine->BKHVFOPEN_VAL < 0 && $p_aLine->BKHVFBEDRAG_EUR < 0){
            return 0; // OPEN
        }

        if($p_aLine->BKHVFOPEN_VAL > 0 && $p_aLine->BKHVFDATUM_VV < $oTime){
            return 1; // LATE
        }

        if($p_aLine->BKHVFOPEN_VAL <= 0 && $p_aLine->BKHVFBEDRAG_EUR >= 0){
            return 2; // PAID
        }

        if($p_aLine->BKHVFOPEN_VAL <= 0 && $p_aLine->BKHVFBEDRAG_EUR >= 0){
            return 2; // PAID
        }

        if($p_aLine->BKHVFOPEN_VAL == 0){
            return 2; // PAID
        }

        return 0; // OPEN
    }

    /**
     * @param $p_aList
     * @return mixed
     */
    public function setStatusTextList($p_aList){
        if($p_aList->count() > 0){
            foreach($p_aList as $row){
                $row->BKHVFSTATUSTEXT = $this->m_aStatus[$row->BKHVFSTATUS];
            }
        }
        return $p_aList;
    }

    /**
     * @param $p_aItem
     * @return mixed
     */
    public function setStatusText($p_aItem){
        if($p_aItem){
            $p_aItem->BKHVFTATUSTEXT = $this->m_aStatus[$p_aItem->BKHVFSTATUS];
        }
        return $p_aItem;
    }




    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
    }

}

?>