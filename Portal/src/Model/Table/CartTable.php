<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class CartTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('cart');
        $this->primaryKey('session_id');

    }

    public function saveArray($p_aArray){
        $a = $this->newEntity($p_aArray);
        return $this->save($a);
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