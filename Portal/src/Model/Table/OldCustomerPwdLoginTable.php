<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\Mailer\Email;

class OldCustomerPwdLoginTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_address_pwd');
        $this->primaryKey('FRbkhADRES_NRINT');
    }

}

?>