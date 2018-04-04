<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;

class HdIntPrplExceptionrulesTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_exceptionrules');
        $this->primaryKey('id');
    }

    public function getNotes($p_sCustCode){

        $query = $this->find('all', [
            'conditions' => ['customer_code' => $p_sCustCode],
        ]);

        if($query->count() > 0){
            return $query->toArray();
        }else{
            return array();
        }

    }

    public function getNotesGrouped(){

        $query = $this->find('all');

        if($query->count() > 0){
            $a = array();
            foreach($query->toArray() as $row) {
                $a[$row["customer_code"]][] = $row;
            }
            return $a;
        }else{
            return array();
        }

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