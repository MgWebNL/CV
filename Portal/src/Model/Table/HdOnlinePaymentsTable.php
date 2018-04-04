<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class HdOnlinePaymentsTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_invoices_onlinepayment');
        $this->primaryKey('id');

    }

    public function checkPaymentByNrint($p_sNrint){
        $a = $this->find()->where(["BKHVFNRINT" => $p_sNrint])->first();
        return $a === null ? false : $a->id;
    }

    public function getBatchByNumber($p_sBatchNo){
        $a = $this->find()->where(["batchnumber" => $p_sBatchNo])->all();
        return $a === null ? false : $a;
    }

}

?>