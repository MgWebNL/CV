<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class InvoiceLineTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhVFREGEL');
        $this->primaryKey('BKHVRNRINT');

        $this->hasOne('Invoice', [
            'propertyName' => 'Invoice',
            'foreignKey' => 'BKHVFNRINT',
            'bindingKey' => 'BKHVR_BKHVFNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('Article', [
            'propertyName' => 'Article',
            'foreignKey' => 'BKHARNRINT',
            'bindingKey' => 'BKHVR_BKHARNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('TussenRrVr', [
            'propertyName' => 'TussenRrVr',
            'foreignKey' => 'ORDTOF_BKHVRNRINT',
            'bindingKey' => 'BKHVRNRINT',
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