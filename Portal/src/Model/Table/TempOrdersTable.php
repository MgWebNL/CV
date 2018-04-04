<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class TempOrdersTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_temp_orders');
        $this->primaryKey('id');

        $this->hasMany('TempOrderRules', [
            'propertyName' => 'TempOrderRules',
            'foreignKey' => 'order_id',
            'bindingKey' => 'id',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('TempAddressDelivery', [
            'propertyName' => 'TempAddressDelivery',
            'foreignKey' => 'id',
            'bindingKey' => 'newdeliveryaddress_id',
            'joinType' => 'LEFT',
        ]);
    }

    public function getTempOrdersCustomer($p_sCustomerNrint){
        $result = $this->find()->contain(["TempOrderRules", "TempAddressDelivery"])->where(["customer_id" => $p_sCustomerNrint, "downloaded !=" => 1, "deleted" => 0]);
        $aResult = $this->renameTempOrders($result);
        return $aResult;
    }

    public function getTempOrder($p_iID, $p_sCustomerNrint){
        $result =
            $this->find()
                ->contain(["TempOrderRules", "TempAddressDelivery"])
                ->where(["customer_id" => $p_sCustomerNrint,"TempOrders.id" => $p_iID, "downloaded !=" => 1, "deleted" => 0])->first();
        $aResult = $this->renameTempOrder($result);
        return $aResult;
    }

    public function renameTempOrders($p_aList){
        foreach($p_aList as $item){
            $this->renameTempOrder($item);
        }
        return $p_aList;
    }

    public function renameTempOrder($p_aItem){
        $this->Address = TableRegistry::get('Address');
        $this->AddressDelivery = TableRegistry::get('AddressDelivery');

        $p_aItem->ORDORNRINT        = $p_aItem->id;
        $p_aItem->ORDORNR           = __('N/A');
        $p_aItem->ORDOROMS          = $p_aItem->ordernumber;
        $p_aItem->ORDORDATUM        = $p_aItem->orderdate;
        $p_aItem->ORDORREFERENTIE   = $p_aItem->orderreference;
        $p_aItem->OrderLine         = $this->renameTempOrderLines($p_aItem);
        $p_aItem->Address           = $this->Address->get($p_aItem->customer_id, ["contain" => ["Country"]]);
        //if($p_aItem->alternatiefafleveradres == 0){
        if($p_aItem->alternativedeliveryaddress == 0){
            $p_aItem->AddressDelivery   = $this->AddressDelivery->get($p_aItem->deliveryadres_id, ["contain" => ["Country"]]);
        }else{
            $p_aItem->AddressDelivery   = $this->renameDeliveryAddress($p_aItem->TempAddressDelivery);
        }


        $p_aItem->ORDORSTATUS       = 0;
        $p_aItem->TempOrderRules    = null;
        $p_aItem->deliveryDate      = "NA";
        $p_aItem->ORDORBEDRAG_VAL   = $p_aItem->amount;
        $p_aItem->ORDORBEDRAG_BTW   = $p_aItem->vat;
        $p_aItem->ORDORBEDRAG_INCL  = $p_aItem->vat + $p_aItem->amount;
        return $p_aItem;
    }

    public function renameDeliveryAddress($p_aAddress){
        $p_aAddress->BKHAAFNAAM = $p_aAddress->company;
        $p_aAddress->BKHAAFSTRAAT = $p_aAddress->address;
        $p_aAddress->BKHAAFHUISNR = $p_aAddress->housenr;
        $p_aAddress->BKHAAFHUISNR_TOE = $p_aAddress->housenr_extra;
        $p_aAddress->BKHAAFPOSTCODE = $p_aAddress->zipcode;
        $p_aAddress->BKHAAFPLAATS = $p_aAddress->city;
        $p_aAddress->Country = new \stdClass();
        $p_aAddress->Country->BKHLAOMS = $p_aAddress->country;
        return $p_aAddress;
    }

    public function renameTempOrderLines($p_aRows){
        $this->Article = TableRegistry::get('Article');
        foreach($p_aRows->TempOrderRules as $row){
            $row->ORDRR_ORDORNRINT = $p_aRows->id;
            $row->ORDRR_LEVERDATUM = $row->deliverydate;
            $row->ORDRRTYPE = 0;
            $row->ORDRRAANTAL = $row->quantity;
            $row->ORDRRPRIJS = $row->price;
            $row->ORDRRBEDRAG = $row->price * $row->quantity;
            $row->ORDRRAANTAL_GEFACT = 0;
            $row->ORDRRAANTAL_GELEVERD = 0;
            $row->Article = $this->Article->getArticleByCode($row->article);
            $row->ORDRROMS = $row->Article->BKHAROMS;
            $row->ORDRROMS = $row->Article->BKHAROMS;
        }
        return $p_aRows->TempOrderRules;
    }

    public function saveTempOrder($p_aCartBasics, $p_iNoTransportCost){

        $a = $this->newEntity();

        $a->orderdate = new Time();
        $a->customer_id = $p_aCartBasics["basis"]["customer_id"];
        $a->contactperson = $p_aCartBasics["basis"]["contact"];
        $a->newcustomer = 0;
        //$a->deliveryadres = $p_aCartBasics["basis"]["delAdres"];
        $a->deliveryadres_id = $p_aCartBasics["basis"]["delivery-address"];
        //$a->alternatiefafleveradres = 0;
        $a->alternativedeliveryaddress = 0;
        $a->orderreference = $p_aCartBasics["basis"]["reference"];
        $a->remarks =$p_aCartBasics["basis"]["remark"];
        //$a->remarks_transport = ;
        $a->amount = 0;
        $a->vat = 0;
        $a->discount = 0;
        $a->paymentkind =  $p_aCartBasics["basis"]["invoice-payment"] == "invoice" ? "factuur" : "msp";
        $a->paymentstatus = "";
        $a->downloaded = -1;
        $a->rejected = 0; // TODO:: SCRIPT VOOR WEIGERING !!

        // LOOP DOOR REGELS VOOR BEDRAG
        foreach($p_aCartBasics["lines"] as $line){
            $a->amount += $line->article_price * $line->quantity;
        }
        // EVENTUEEL TRANSPORTKOSTEN TOEVOEGEN
        if($a->amount < HD_CART_TRANS_MIN && $p_iNoTransportCost == 0){
            $a->amount += HD_CART_TRANS;
        }
        // EVENTUEEL BTW BEREKENEN
        if(strpos($p_aCartBasics["basis"]["adres"], "Nederland") !== false){
            $a->vat = $a->amount*0.21;
        }

        $order = $this->save($a);

        $a = $this->get($order->id);
        $a->ordernumber = $this->generateOrderNumber($order->id);
        $this->save($a);

        return $order->id;

    }

    /**
     * @param $p_aValue
     */
    public function updateTempOrder($p_iID, $p_aValue){
        $a = $this->get($p_iID);

        foreach($p_aValue as $k=>$v){
            if($k !== 'id'){
                $a->$k = $v;
            }
        }
        $this->save($a);
    }


    private function generateOrderNumber($p_iOrderId){

        $number = str_pad($p_iOrderId, 6, "0", STR_PAD_LEFT);

        return HD_CART_ORDER_CODE.$number;
    }


}

?>