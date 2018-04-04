<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class PaymentVFTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhVFBETALINGEN');
        $this->primaryKey('BKHVBNRINT');

        $this->hasOne('Invoice', [
            'propertyName' => 'Invoice',
            'foreignKey' => 'BKHVFNRINT',
            'bindingKey' => 'BKHVB_BKHVFNRINT',
            'joinType' => 'INNER',
        ]);

    }

    public function getAvgPaymentRate($p_sCustomerNrint){

        $query = $this->find('all');
        $query->select(["AvgPayRate" => $query->func()->avg($query->func()->dateDiff(["BKHVBDATUM" => 'literal', "Invoice.BKHVFDATUM" => 'literal']))])
            ->contain(["Invoice"])
            ->where(["BKHVFOPEN" => 0, "BKHVFBEDRAG_EUR > " => 0, "BKHVB_BKHADNRINT" => $p_sCustomerNrint]);
        return $query->first();
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