<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class CrossUserTable extends Table
{

    public static function defaultConnectionName() {
        return "HodiOnline";
    }

    public function initialize(array $config)
    {
        //$this->table('customer');
        $this->primaryKey('id');
        $this->table("customers"); // this is very important for joining and associations.
    }


    public function checkUser($p_sUserCode){
        $query = $this->find('all')
            ->where(["debiteurcode" => $p_sUserCode])
            ->first();

        if(is_null($query)){
            return false;
        }else{
            return $query;
        }
    }

    public function generateString(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $x = rand(1, 9);
        $charactersLength = strlen($characters);
        $randomString = $x;
        for ($i = 0; $i < $x; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $a["front"] = $randomString;

        $y = rand(1, 9);
        $charactersLength = strlen($characters);
        $randomString = "";
        for ($i = 0; $i < $y; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $randomString .= $y;
        $a["end"] = $randomString;

        return $a;
    }

    public function generatePassword(){
        $sPassword = '';
        $sPassword .= substr("bcdfghjkmnpqrstvwxz",mt_rand(0,18),1);
        $sPassword .= substr("aeuy",mt_rand(0,3),1);
        $sPassword .= substr("bcdfghjkmnpqrstvwxz",mt_rand(0,18),1);
        $sPassword .= substr("5678ghbcdsxz",mt_rand(0,4),1);
        $sPassword .= substr("bcdfghjkmnpqrstvwxz",mt_rand(0,18),1);
        $sPassword .= substr("aeuy",mt_rand(0,3),1);
        $sPassword .= substr("bcdfghjkmnpqrstvwxz",mt_rand(0,18),1);
        $sPassword .= substr("23456789",mt_rand(0,7),1);
        return($sPassword);
    }

    public function saveArray($p_aArray){
        $a = $this->newEntity($p_aArray);
        return $this->save($a);
    }



}

?>