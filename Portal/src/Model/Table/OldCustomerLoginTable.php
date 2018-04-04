<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\Mailer\Email;

class OldCustomerLoginTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_address');
        $this->primaryKey('FRbkhADRES_NRINT');

        $this->hasOne('OldCustomerPwdLogin', [
            'propertyName' => 'OldCustomerPwdLogin',
            'foreignKey' => 'FRbkhADRES_NRINT',
            'bindingKey' => 'FRbkhADRES_NRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('Address', [
            'propertyName' => 'Address',
            'foreignKey' => 'BKHADNRINT',
            'bindingKey' => 'FRbkhADRES_NRINT',
            'joinType' => 'INNER',
        ]);
    }

}

?>