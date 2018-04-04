<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplPartialDeliveryTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_partial_delivery');
        $this->primaryKey('id');

        $this->hasOne('HdIntPrplViewItem', [
            'propertyName' => 'HdIntPrplViewItem',
            'foreignKey' => 'orderrule_id', // VELD IN EXTERNE TABEL
            'bindingKey' => 'order_nrint', // VELD INTERNE TABEL
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('General', [
            'foreignKey' => 'order_nrint', // VELD IN EXTERNE TABEL
            'bindingKey' => 'order_nrint', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

        $this->hasOne('HdIntPrplPackaging', [
            'foreignKey' => 'order_nrint', // VELD IN EXTERNE TABEL
            'bindingKey' => 'order_nrint', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

    }

    public function groupPartialDeliveries(&$aMainData = array())
    {
        $query = $this->find('all')->where(['transport_cost' => '0']);
        $query->select($this);
        $query->select(['total_send' => $query->func()->sum('quantity_send')]);
        $query->group('order_nrint');

        $aData = array();
        foreach($query as $item){
            $aData[$item["order_nrint"]] = $item;
        }

        $aRes = array();
        if(empty($aMainData)){
            $aRes = $aData;
            return $aRes;
        }else{
            foreach($aMainData as $a){
                $nrint = is_null($a["order_nrint"]) ? $a["orderrule_id"] : $a["order_nrint"];
                if(isset($aData[$nrint])){
                    $a->quantity_delivered = $aData[$nrint]["quantity_send"];
                }else{
                    $a->quantity_delivered = 0;
                }
            }
        }



    }

    public function groupPartialDeliveriesByOrder($p_sNrint)
    {
        $query = $this->find('all')->where(['order_nrint' => $p_sNrint]);
        $query->select($this);
        $query->select(['total_send' => $query->func()->sum('quantity_send')]);
        $query->group('order_nrint');

        $aData = array();
        foreach($query as $item){
            $aData = $item;
        }

        return $aData;
    }


}

?>