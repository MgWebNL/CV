<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class HdIntPrplViewItemTable extends Table
{

    private function loadModel($p_sTableName){
        $this->$p_sTableName = TableRegistry::get($p_sTableName);
    }

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_view_item');
        $this->primaryKey('orderrule_id');

        $this->hasOne('HdIntPrplGeneral', [
            'propertyName' => 'HdIntPrplGeneral',
            'bindingKey' => 'orderrule_id', // VELD IN EXTERNE TABEL
            'foreignKey' => 'order_nrint', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

        $this->hasOne('FRbkhARTIKEL', [
            'propertyName' => 'FRbkhARTIKEL',
            'bindingKey' => 'product_id', // VELD IN EXTERNE TABEL
            'foreignKey' => 'BKHARNRINT', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

        $this->hasOne('FRbkhADRES', [
            'propertyName' => 'FRbkhADRES',
            'bindingKey' => 'adres_id', // VELD IN EXTERNE TABEL
            'foreignKey' => 'BKHADNRINT', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

        $this->hasOne('HdIntPrplGrootboekActief', [
            'propertyName' => 'HdIntPrplGrootboekActief',
            'bindingKey' => 'ledger_code', // VELD IN EXTERNE TABEL
            'foreignKey' => 'BKHGBNR', // VELD INTERNE TABEL
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('HdIntPrplPrinting', [
            'propertyName' => 'HdIntPrplPrinting',
            'bindingKey' => 'orderrule_id', // VELD IN EXTERNE TABEL
            'foreignKey' => 'order_nrint', // VELD INTERNE TABEL
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('HdIntPrplMachine', [
            'propertyName' => 'HdIntPrplMachine',
            'bindingKey' => 'orderrule_id', // VELD IN EXTERNE TABEL
            'foreignKey' => 'order_nrint', // VELD INTERNE TABEL
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('HdIntPrplPackaging', [
            'propertyName' => 'HdIntPrplPackaging',
            'bindingKey' => 'orderrule_id', // VELD IN EXTERNE TABEL
            'foreignKey' => 'order_nrint', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

        $this->hasOne('FRbkhADRES_AFLEVER', [
            'propertyName' => 'FRbkhADRES_AFLEVER',
            'bindingKey' => 'afleveradres_id', // VELD IN EXTERNE TABEL
            'foreignKey' => 'BKHAAFNRINT', // VELD INTERNE TABEL
            'joinType' => 'LEFT',
        ]);
    }


    public function getOrder($p_sOrderNrint, $p_aContain = []){
        $m_aContain = ["HdIntPrplGeneral","FRbkhARTIKEL","HdIntPrplGrootboekActief"];
        $m_aContain = array_merge($m_aContain, $p_aContain);
        return $this->get($p_sOrderNrint,
            [
                "contain" => $m_aContain
            ]
        );
    }

    /**
     * @param null $p_sSupplierNrint
     * @return array
     */
    public function getStatusCount($p_sSupplierNrint = null){
        $a = [];

        $aCount = $this->query()
                    ->select(
                        [
                            "general_status" => "HdIntPrplGeneral.general_status",
                            "general_status_type" => "HdIntPrplStatus.status_type",
                            "count" => "COUNT(*)"
                        ]
                    )
                    ->group(["HdIntPrplGeneral.general_status"])
                    ->contain(["HdIntPrplGeneral.HdIntPrplStatus"])
                    ->all();

        foreach($aCount as $row){
            $a[$row->general_status] = $row->count;
            @$a[$row->general_status_type] += $row->count;
        }

        $aFinance = $this->getFinanceStatus();
        foreach($aFinance as $k=>$v){
            $a[$k] = $v;
        }

        $aTransport = $this->getTransportStatus();
        foreach($aTransport as $k=>$v){
            $a[$k] = $v;
        }

        return $a;
    }

    public function getStatusCountQuantity($p_sSupplierNrint = null){
        $a = [];

        $aCount = $this->query()
            ->select(
                [
                    "general_status" => "HdIntPrplGeneral.general_status",
                    "general_status_type" => "HdIntPrplStatus.status_type",
                    "count" => "SUM(HdIntPrplGeneral.order_quantity_new)"
                ]
            )
            ->group(["HdIntPrplGeneral.general_status"])
            ->contain(["HdIntPrplGeneral.HdIntPrplStatus"])
            ->all();

        foreach($aCount as $row){
            $a[$row->general_status] = $row->count;
            @$a[$row->general_status_type] += $row->count;
        }

        $aFinance = $this->getFinanceStatus(1);
        foreach($aFinance as $k=>$v){
            $a[$k] = $v;
        }

        $aTransport = $this->getTransportStatus(1);
        foreach($aTransport as $k=>$v){
            $a[$k] = $v;
        }
        return $a;
    }

    private function getFinanceStatus($p_bQuantity = 0){
        $a = [];
        $this->loadModel('HdIntPrplPartialDelivery');
        $aFinance = $this->HdIntPrplPartialDelivery->find()->where(["transport_cost" => 0]);
        if($p_bQuantity != 1){
            foreach($aFinance as $rule){
                if($rule->intake == 0){
                    @$a[106]++;
                    @$a['finance']++;
                }elseif($rule->invoice == 0){
                    @$a[107]++;
                    @$a['finance']++;
                }else{
                    @$a[108]++;
                }
            }
        }else{
            foreach($aFinance as $rule){
                if($rule->intake == 0){
                    @$a[106] += $rule->quantity_send;
                    @$a['finance'] += $rule->quantity_send;
                }elseif($rule->invoice == 0){
                    @$a[107] += $rule->quantity_send;
                    @$a['finance'] += $rule->quantity_send;
                }else{
                    @$a[108] += $rule->quantity_send;
                }
            }
        }
        return $a;
    }

    private function getTransportStatus($p_bQuantity = 0){
        $a = [];
        $this->loadModel('HdIntPrplTransport');
        $aTransport = $this->HdIntPrplTransport->find()->contain([ 'HdIntPrplPartialDelivery.HdIntPrplViewItem.HdIntPrplGeneral',
            'HdIntPrplPackaging'])->where(["to_transport" => 0, "in_nl <>" => -1]);
        if($p_bQuantity != 1){
            foreach($aTransport as $rule){
                @$a['transport']++;
                if($rule->to_nl == 0){
                    @$a[112]++;
                }elseif($rule->to_nl == 1 && $rule->in_nl == 0 && $rule->loading_order == 0){
                    @$a[113]++;
                }elseif($rule->to_nl == 1 && $rule->in_nl == 0 && $rule->loading_order != 0){
                    @$a[114]++;
                }elseif($rule->to_nl == 1 && $rule->in_nl == 1 && $rule->to_transport == 0){
                    @$a[115]++;
                }
            }
        }else{
            foreach($aTransport as $rule){
                @$a['transport'] += $rule->HdIntPrplPartialDelivery->quantity_send;

                if($rule->to_nl == 0){
                    @$a[112] += $rule->HdIntPrplPartialDelivery->quantity_send;
                }elseif($rule->to_nl == 1 && $rule->in_nl == 0 && $rule->loading_order == 0){
                    @$a[113] += $rule->HdIntPrplPartialDelivery->quantity_send;
                }elseif($rule->to_nl == 1 && $rule->in_nl == 0 && $rule->loading_order != 0){
                    @$a[114] += $rule->HdIntPrplPartialDelivery->quantity_send;
                }elseif($rule->to_nl == 1 && $rule->in_nl == 1 && $rule->to_transport == 0){
                    @$a[115] += $rule->HdIntPrplPartialDelivery->quantity_send;
                }
            }
        }
        return $a;
    }


    public function getOrdersByStatus($p_aStatusArray = []){
        $aOrders = $this->find()
            ->contain(["HdIntPrplGeneral"])
            ->where(["HdIntPrplGeneral.general_status IN" => $p_aStatusArray])
            ->order(["HdIntPrplGeneral.priority" => "desc"]);
        return $aOrders;
    }






































    public function generateRandomStatus(){
        $aStatus = [1,2,3,4,5,6,7,8,99,100,101,102,103,104,105,106,107,108,109,110,111];
        $iLength = count($aStatus)-1;

        $aCount = $this->query()
            ->select(
                [
                    "id" => "HdGeneral.id",
                ]
            )
            ->contain(["HdGeneral"])
            ->all();

        $this->HdGeneral = TableRegistry::get("HdGeneral");

        foreach($aCount as $order){
            $aOrder = $this->HdGeneral->get($order->id);
            $iRandomStatus = $aStatus[rand(0, $iLength)];

            $aOrder->general_status = $iRandomStatus;
            $this->HdGeneral->save($aOrder);
        }
    }



}

?>