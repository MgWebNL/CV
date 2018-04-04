<?php

namespace App\Model\Table;

use Cake\I18n\Date;
use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class InvoicePaymentsTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhVFBETALINGEN');
        $this->primaryKey('BKHVBNRINT');

        $this->belongsTo('Invoice', [
            'foreignKey' => 'BKHVBNRINT',
            'bindingKey' => 'BKHVB_BKHVFNRINT',
            'joinType' => 'INNER',
        ]);

    }

    public function getPaymentsFromList(&$p_oList){
        $aIDs = [];
        $aPay = [];
        $aMax = [];
        foreach($p_oList as $inv){
            $aIDs[] = $inv->BKHVFNRINT;
        }

        $aPayments = $this->find()->where(["BKHVB_BKHVFNRINT IN" => $aIDs])->all();
        foreach($aPayments as $pay){
            $aPay[$pay->BKHVB_BKHVFNRINT][] = $pay;
            $aMax[$pay->BKHVB_BKHVFNRINT] = $pay;
        }

        foreach($p_oList as $inv){
            if(isset($aPay[$inv->BKHVFNRINT])) {
                $inv->InvoicePayments = $aPay[$inv->BKHVFNRINT];
                $inv->InvoicePaymentsLast = $aMax[$inv->BKHVFNRINT];
            }
        }

        return $p_oList;
    }

    public function getPaymentsByInvoice(&$p_oInvoice){
        $aPay = [];
        $aMax = [];

        $aPayments = $this->find()->where(["BKHVB_BKHVFNRINT" => $p_oInvoice->BKHVFNRINT])->all();
        foreach($aPayments as $pay){
            $aPay[$pay->BKHVB_BKHVFNRINT][] = $pay;
            $aMax[$pay->BKHVB_BKHVFNRINT] = $pay;
        }

        if(isset($aPay[$p_oInvoice->BKHVFNRINT])) {
            $p_oInvoice->InvoicePayments = $aPay[$p_oInvoice->BKHVFNRINT];
            $p_oInvoice->InvoicePaymentsLast = $aMax[$p_oInvoice->BKHVFNRINT];
        }

        return $p_oInvoice;
    }

}

?>