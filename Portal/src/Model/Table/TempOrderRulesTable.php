<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class TempOrderRulesTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_temp_orderregels');
        $this->primaryKey('id');
    }

    /**
     * @param string $p_sTableName
     */
    public function loadModel($p_sTableName){
        $this->$p_sTableName = TableRegistry::get($p_sTableName);
    }

    public function saveTempOrderRules($p_aCartBasics, $p_iTempOrderId, $p_iTransportCost = 0){

        $totalAmount = 0;

        foreach($p_aCartBasics["lines"] as $line){
            $a = $this->newEntity();
            $a->order_id = $p_iTempOrderId;
            $a->deliverydate = $p_aCartBasics["basis"]["delivery-date"] == "sap" ? $p_aCartBasics["basis"]["delivery-date-date"] : $p_aCartBasics["basis"]["del-date"][$line->article_id];
            $a->article = $line->article_code;
            $a->description = $line->article_name;
            $a->quantity = $line->quantity;
            $a->price = $line->article_price;
            $a->amount = $line->article_price * $line->quantity;
            $totalAmount += $a->amount;
            $this->save($a);
        }

        // EVENTUEEL TRANSPORTKOSTEN TOEVOEGEN
        if($totalAmount < HD_CART_TRANS_MIN && $p_iTransportCost != 0){
            $this->loadModel("Article");
            $aTrans = $this->Article->get(HD_CART_TRANS_ART_ID);

            $a = $this->newEntity();
            $a->order_id = $p_iTempOrderId;
            $a->deliverydate = $p_aCartBasics["basis"]["delivery-date-date"];
            $a->article = $aTrans->BKHARCODE;
            $a->description = $aTrans->BKHAROMS;
            $a->quantity = 1;
            $a->price = HD_CART_TRANS;
            $a->amount = HD_CART_TRANS;
            $this->save($a);
        }

    }


}

?>