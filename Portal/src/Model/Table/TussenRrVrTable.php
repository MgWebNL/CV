<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class TussenRrVrTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRordTUSSEN_RR_VR');
        $this->primaryKey('ORDOFNRINT');

        $this->hasOne('InvoiceLine', [
            'propertyName' => 'InvoiceLine',
            'foreignKey' => 'BKHVRNRINT',
            'bindingKey' => 'ORDTOF_BKHVRNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('OrderLine', [
            'propertyName' => 'OrderLine',
            'foreignKey' => 'ORDRRNRINT',
            'bindingKey' => 'ORDTOF_ORDRRNRINT',
            'joinType' => 'INNER',
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