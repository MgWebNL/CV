<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class LedgerTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhGROOTBOEK');
        $this->primaryKey('BKHGBNRINT');

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