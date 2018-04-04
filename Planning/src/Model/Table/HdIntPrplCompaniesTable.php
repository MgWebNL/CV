<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplCompaniesTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_companies');
        $this->primaryKey('id');

        $this->hasOne('FRbkhADRES', [
            'foreignKey' => 'BKHADNRINT', // VELD IN EXTERNE TABEL
            'bindingKey' => 'adres_nrint', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);
    }


}

?>