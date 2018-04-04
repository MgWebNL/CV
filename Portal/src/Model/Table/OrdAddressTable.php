<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class OrdAddressTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRordADRES');
        $this->primaryKey('ORDADNRINT');

        $this->hasOne('Address', [
            'propertyName' => 'Address',
            'foreignKey' => 'BKHADNRINT',
            'bindingKey' => 'ORDADNRINT',
            'joinType' => 'INNER',
        ]);

    }

}

?>