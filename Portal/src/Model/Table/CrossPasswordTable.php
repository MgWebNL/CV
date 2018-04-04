<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class CrossPasswordTable extends Table
{

    public static function defaultConnectionName() {
        return "HodiOnline";
    }

    public function initialize(array $config)
    {
        //$this->table('customer');
        $this->primaryKey('customer_id');
        $this->table("customer_pwd"); // this is very important for joining and associations.
    }


}

?>