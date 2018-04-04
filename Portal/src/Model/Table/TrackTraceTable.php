<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class TrackTraceTable extends Table
{

    public $m_bHasTT = false;

    public function initialize(array $config)
    {
        $this->table('hd_tracktrace');
        $this->primaryKey('tt_trackingnumber');

        $this->hasOne('Order', [
            'propertyName' => 'Order',
            'foreignKey' => 'ORDORNR',
            'bindingKey' => 'tt_trackingnumber',
            'joinType' => 'INNER',
        ]);

    }

    public function getTracesByCustomer($p_sCustomerNrint){
        return $this->find()
            ->contain(["Order"])
            ->where([
                "tt_last_status <" => 4,
                "tt_hide" => 0,
                "Order.ORDOR_BKHADNRINT" => $p_sCustomerNrint
            ])
            ->all();
    }

    public function setOrderListStatus($p_aList){
        if($p_aList->count() > 0){

            $aDelivered = $this->find()
                ->select(["tt_trackingnumber", "tt_follownumber", "tt_last_status"])
                ->where(["tt_hide" => 0])
                ->group(["tt_trackingnumber"])
                ->all();

            $a = [];
            foreach($aDelivered as $del){
                $a[$del->tt_trackingnumber] = $del;
            }
            $aDelivered = $a;
            foreach($p_aList as $row){
                if(
                    ($row->ORDORSTATUS == 2 && $row->ORDOR_ORDVVNRINT == 'MPG3OVZ1') ||
                    ($row->ORDORSTATUS == 2 && isset($aDelivered[$row->ORDORNR]) && $aDelivered[$row->ORDORNR]->tt_last_status == 4) ||
                    ($row->ORDORSTATUS == 2 && !isset($aDelivered[$row->ORDORNR]))
                ) {
                    $row->ORDORSTATUS = 3;
                }
            }
        }
        return $p_aList;
    }

    public function setOrderStatus($p_aOrder){
        if(
            $p_aOrder->ORDORSTATUS == 2 && ($p_aOrder->ORDOR_ORDVVNRINT == 'MPG3OVZ1') ||
            ($p_aOrder->ORDORSTATUS == 2 && $this->m_bHasPending === false && $this->m_bHasTT === true) ||
            ($p_aOrder->ORDORSTATUS == 2 && $this->m_bHasTT === false)) {
            $p_aOrder->ORDORSTATUS = 3;
        }
        return $p_aOrder;
    }

    public function getOrderTraces($p_aOrder){
        $aDelivered = $this->find()
            ->select(["tt_trackingnumber", "tt_follownumber", "tt_last_status"])
            ->where(["tt_trackingnumber" => $p_aOrder->ORDORNR, "tt_hide" => 0])
            ->all();

        if($aDelivered->count() > 0){
            $this->m_bHasTT = true;
        }
        $this->m_bHasPending = false;
        foreach($aDelivered as $a){
            if($a->tt_last_status != 4){
                $this->m_bHasPending = true;
            }
        }

        return $aDelivered; // PENDING
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