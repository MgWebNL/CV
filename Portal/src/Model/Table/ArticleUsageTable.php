<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class ArticleUsageTable extends Table
{

    public function initialize(array $config)
    {
        //$this->table('hd_view_articleusage');
        $this->table('hd_articleusage');
        $this->primaryKey('BKHARNRINT');

        $this->hasOne('Article', [
            'propertyName' => 'Article',
            'foreignKey' => 'BKHARNRINT',
            'bindingKey' => 'BKHARNRINT',
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