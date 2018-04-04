<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class HdIntPrplViewDeliveryDateTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_view_delivery_date');
        $this->primaryKey('order_nrint');
    }

    public function setDeliveryDates(&$p_oOrders){
        $aIds = [];
        foreach($p_oOrders as $oOrder){
            $aIds[] = $oOrder->orderrule_id;
        }

        $aDates = $this->find()->where(["orderrule_id IN" => $aIds]);
        $aDeliveryDate = [];
        foreach($aDates as $aDate){
            $aDeliveryDate[$aDate->orderrule_id] = $aDate;
        }

        foreach($p_oOrders as $oOrder){
            $oOrder->HdIntPrplViewDeliveryDate = isset($aDeliveryDate[$oOrder->orderrule_id]) ? $aDeliveryDate[$oOrder->orderrule_id] : null;
        }

        return $p_oOrders;
    }

}

?>