<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class AanlogOnlineTable extends Table
{

    public static function defaultConnectionName() {
        return "HodiOnline";
    }

    public function initialize(array $config)
    {
        //$this->table('customer');
        $this->primaryKey('id');
        $this->table("aanlogPTWB"); // this is very important for joining and associations.
    }

    public function saveArray($p_aArray){
        $a = $this->newEntity($p_aArray);
        $this->save($a);
    }


}

?>