<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class HdAddressTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_address');
        $this->primaryKey('FRbkhADRES_NRINT');

        $this->hasOne('Employee', [
            'propertyName' => 'Employee',
            'foreignKey' => 'ORDMWNRINT',
            'bindingKey' => 'projectmanager',
            'joinType' => 'LEFT',
        ]);

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