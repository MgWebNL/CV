<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class OrderTable extends Table
{

    public $m_oList;
    public $m_aConditions = [];
    public $m_aStatus = [
        0 => ["text" => "Pending", "color" => "orange"],
        1 => ["text" => "Partial sent", "color" => "orange"],
        2 => ["text" => "Sent", "color" => "green"],
        3 => ["text" => "Delivered", "color" => "green"],
       99 => ["text" => "On demand", "color" => "green"],
    ];

    public function initialize(array $config)
    {
        $this->table('FRordORDER');
        $this->primaryKey('ORDORNRINT');

        $this->hasOne('Address', [
            'propertyName' => 'Address',
            'foreignKey' => 'BKHADNRINT',
            'bindingKey' => 'ORDOR_BKHADNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('AddressDelivery', [
            'propertyName' => 'AddressDelivery',
            'foreignKey' => 'BKHAAFNRINT',
            'bindingKey' => 'ORDOR_BKHAAFNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('Employee', [
            'propertyName' => 'Employee',
            'foreignKey' => 'ORDMWNRINT',
            'bindingKey' => 'ORDOR_ORDMWNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('Contactperson', [
            'propertyName' => 'Contactperson',
            'foreignKey' => 'BKHCONRINT',
            'bindingKey' => 'ORDOR_BKHCONRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasMany('OrderLine', [
            'propertyName' => 'OrderLine',
            'foreignKey' => 'ORDRR_ORDORNRINT',
            'bindingKey' => 'ORDORNRINT',
            'joinType' => 'INNER',
        ]);

    }

    /**
     * @param $p_sCustomerNrint
     * @return $this
     *
     * BASISGEGEVENS ORDERLIJST PORTAL !!
     *
     */
    public function getOrderListCustomer($p_sCustomerNrint){
        $a = $this->find('all')
            ->select(["ORDORNRINT", "ORDORNR", "ORDOROMS", "ORDORDATUM", "ORDORREFERENTIE"])
            ->contain(["OrderLine" => function($q){ return
                $q
                    ->select(["OrderLine.ORDRR_ORDORNRINT", "OrderLine.ORDRR_LEVERDATUM", "ORDRRTYPE", "ORDRRAANTAL", "ORDRRAANTAL_GEFACT", "ORDRRAANTAL_GELEVERD", "ORDRR_AFROEP", "ORDRR_INAFROEP", "ORDRR_AANTAL_AFGEROEPEN"])
                    ->contain(["Article" => function($qq){
                        return $qq->select(["Article.BKHAR_NIETFYSIEK", "Article.BKHARCODE"]);
                    }])
                    ->where(["ORDRRTYPE" => 0]);

            }])
            ->where(["ORDOR_BKHADNRINT" => $p_sCustomerNrint])
            ->order(["ORDORDATUM" => "DESC"]);

        $this->determineDeliveryDateOrders($a);

        return $a;
    }

    /**
     * @param $p_sOrderNrint
     * @param $p_sCustomerNrint
     * @return mixed
     *
     * BASISGEGEVENS ORDER PORTAL !!
     *
     */
    public function getOrderCustomer($p_sOrderNrint, $p_sCustomerNrint){
        $aOrder = $this->find('all')
            ->contain(["OrderLine.Article.ArticleUnit", "Address.Country", "AddressDelivery.Country", "Employee", "Contactperson"])
            ->where(["ORDOR_BKHADNRINT" => $p_sCustomerNrint, "ORDORNRINT" => $p_sOrderNrint])
            ->first();

        $this->determineDeliveryDateOrders($aOrder, 1);

        if(!empty($aOrder->OrderLine)) {
            foreach ($aOrder->OrderLine as $k => $rule) {
                if ($rule->ORDRRTYPE == 1) {
                    $aOrder->ORDORBEDRAG_BTW = $rule->ORDRRBEDRAG;
                    unset($aOrder->OrderLine[$k]);
                }
                if ($rule->ORDRRTYPE == 2) {
                    $aOrder->ORDORBEDRAG_INCL = $rule->ORDRRBEDRAG;
                    unset($aOrder->OrderLine[$k]);
                }
            }
        }
        return $aOrder;
    }

    public function determineDeliveryDateOrders(&$p_aList, $iSingle = 0){
        if($iSingle == 1){
            $a[] = $p_aList;
        }else{
            $a = $p_aList;
        }

        foreach($a as $v){
            $date = [];
            // CHECK OF ER MAAR 1 REGEL IS
            if(!empty($v->OrderLine)) {
                if (count($v->OrderLine) == 1) {
                    $v->deliveryDate = $v->OrderLine[0]->ORDRR_LEVERDATUM;
                } elseif (count($v->OrderLine) > 1) {
                    foreach ($v->OrderLine as $vv) {
                        if (!is_null($vv->ORDRR_LEVERDATUM)) {
                            $date[$vv->ORDRR_LEVERDATUM->format('Y-m-d')][] = $vv;
                        }
                    }
                    // MEERDERE LEVERINGEN
                    if (count($date) > 1) {
                        $v->deliveryDate = "tooltip";
                    } else {
                        $v->deliveryDate = $v->OrderLine[0]->ORDRR_LEVERDATUM;
                    }
                } else {
                    $v->deliveryDate = "NA";
                }
            }else{
                @$v->deliveryDate = "NA";
            }
        }

        if($iSingle == 1){
            return $a[0];
        }else{
            return $a;
        }
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
     * @param $p_aList
     * @return mixed
     */
    public function setOrderListStatus($p_aList){
        if($p_aList->count() > 0){
            foreach($p_aList as $row){
                if($row->ORDORDATUM >= new Time('2016-07-01')){
                    $row->ORDORSTATUS = $this->setOrderStatus($row->OrderLine);
                }else{
                    $row->ORDORSTATUS = 3;
                }
            }
            $this->setStatusTextList($p_aList);
        }
        return $p_aList;
    }

    /**
     * @param $p_aLines
     * @return int
     */
    public function setOrderStatus($p_aLines){
        if(count($p_aLines) > 0){
            $iCount = 0;
            $iTotal = 0;
            $iInvoiced = 0;
            $iDelivered = 0;
            $iDemand = 0;
            $iDemanded = 0;
            $iToDemand = 0;
            foreach($p_aLines as $row){
                if($row->ORDRRTYPE == 0 && $row->Article->BKHAR_NIETFYSIEK == 0) {
                    $iCount ++;
                    $iTotal += $row->ORDRRAANTAL;
                    $iInvoiced += $row->ORDRRAANTAL_GEFACT;
                    $iDelivered -= $row->ORDRRAANTAL_GELEVERD;
                    $iDemand += $row->ORDRR_AFROEP;
                    $iDemanded += $row->ORDRR_AANTAL_AFGEROEPEN;
                    $iToDemand += $row->ORDRR_INAFROEP;
                }
            }

            if($iCount == $iDemand && $iDemand > 0 && $iToDemand > $iDemanded){
                return 99;
            }

            if($iTotal == $iDelivered){
                return 2; // SENT
            }

            if($iDelivered > 0){
                return 1; // PART. SENT
            }

            return 0; // PENDING
        }
        return 0; // PENDING
    }

    /**
     * @param $p_aList
     * @return mixed
     */
    public function setStatusTextList($p_aList){
        if($p_aList->count() > 0){
            foreach($p_aList as $row){
                $row->ORDORSTATUSTEXT = $this->m_aStatus[$row->ORDORSTATUS];
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
            $p_aItem->ORDORSTATUSTEXT = $this->m_aStatus[$p_aItem->ORDORSTATUS];
        }
        return $p_aItem;
    }

    public function getInvoiceNrintFromOrderLine($p_oOrder){

        $nrints = [];
        foreach($p_oOrder->OrderLine as $rule){
            $nrints[] = $rule->ORDRRNRINT;
        }

        $this->OrderLine = TableRegistry::get('OrderLine');
        $aInvoice = $this->OrderLine->find('all')
            //->select(["Invoice.BKHVFNRINT"])
            ->contain(['TussenRrVr.InvoiceLine.Invoice'])
            ->where(['ORDRRNRINT IN' => $nrints])
            ->all();

        $a = [];
        foreach($aInvoice as $inv){
            foreach($inv->TussenRrVr as $tussen) {
                $a[$tussen->InvoiceLine->Invoice->BKHVFNRINT] = [
                    'BKHVFNRINT' => $tussen->InvoiceLine->Invoice->BKHVFNRINT,
                    'BKHVFNR' => $tussen->InvoiceLine->Invoice->BKHVFNR,
                ];
            }
        }

        return $a;
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