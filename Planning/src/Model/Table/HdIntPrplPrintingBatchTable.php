<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplPrintingBatchTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_printing_batch');
        $this->primaryKey('id');

        $this->hasOne('HdIntPrplViewItem', [
            'propertyName' => 'HdIntPrplViewItem',
            'foreignKey' => 'orderrule_id',
            'bindingKey' => 'order_nrint',
            'joinType' => 'INNER',
        ]);

    }

    public function getAllPrintingBatchData(){
        $query = $this->find('all')->toArray();

        $aData = array();
        foreach($query as $item){
            $aData[$item["order_nrint"]] = $item;
        }

        return $aData;
    }

    public function getAllPrintingBatchOrders($p_sPrinterNrint){
        $query = $this->find('all', ['contain' => ['HdIntPrplViewItem.HdIntPrplGeneral']])->where(["adres_nrint" => $p_sPrinterNrint])->toArray();

        $aData = array();
        foreach($query as $item){
            $aData[$item["order_nrint"]] = $item;
        }

        return $aData;
    }

}

?>