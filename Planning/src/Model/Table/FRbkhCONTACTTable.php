<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FRbkhCONTACTTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhCONTACT');
        $this->primaryKey('BKHCONRINT');
    }

    public function getContactsByAddressNrint($p_sNrint, $p_sType = ""){
        $aContacts = $this->find()->where(["BKHCO_BKHADNRINT" => $p_sNrint]);
        if($p_sType != ""){
            $aContacts->andWhere(["BKHCO_EMAIL_".$p_sType => "1"]);
        }
        return $aContacts;

    }

    public function getContactByNrint($p_sNrint){

    }
}

?>