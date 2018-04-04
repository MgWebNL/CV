<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplDeliveryBatchTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_delivery_batch');
        $this->primaryKey('id');

        $this->hasOne('HdIntPrplViewItem', [
            'propertyName' => 'HdIntPrplViewItem',
            'foreignKey' => 'orderrule_id',
            'bindingKey' => 'order_nrint',
            'joinType' => 'INNER',
        ]);

    }

    public function getAllDeliveryBatchData(){
        $query = $this->find('all')->toArray();

        $aData = array();
        foreach($query as $item){
            $aData[$item["order_nrint"]] = $item;
        }

        return $aData;
    }

    public function getAllDeliveryBatchOrders(){
        $query = $this->find('all', ['contain' => ['HdIntPrplViewItem.HdIntPrplGeneral', 'HdIntPrplViewItem.FRbkhADRES']]);

        $aData = array();
        foreach($query as $item){
            $aData[$item["order_nrint"]] = $item;
        }

        return $aData;
    }
}

?>