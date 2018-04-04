<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class CrossArticleTable extends Table
{

    public static function defaultConnectionName() {
        return "HodiOnline";
    }

    public function initialize(array $config)
    {
        //$this->table('customer');
        $this->primaryKey('id');
        $this->table("product"); // this is very important for joining and associations.
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
        return true;
    }


}

?>