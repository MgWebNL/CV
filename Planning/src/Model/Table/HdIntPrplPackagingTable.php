<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class HdIntPrplPackagingTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_packaging');
        $this->primaryKey('id');

        $this->hasOne('FRbkhADRES', [
            'foreignKey' => 'BKHADNRINT', // VELD IN EXTERNE TABEL
            'bindingKey' => 'adres_nrint', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

    }

}

?>