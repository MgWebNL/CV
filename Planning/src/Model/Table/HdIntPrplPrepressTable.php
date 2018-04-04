<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class HdIntPrplPrepressTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_prepress');
        $this->primaryKey('order_nrint');

        $this->hasOne('HdIntPrplPrepressInstructions', [
            'propertyName' => 'HdIntPrplPrepressInstructions',
            'bindingKey' => 'prepress_form_id', // VELD IN EXTERNE TABEL
            'foreignKey' => 'id', // VELD INTERNE TABEL
            'joinType' => 'LEFT',
        ]);

    }

    public function getPrepress($p_sOrderNrint)
    {
        $query = $this->find('all', [
            'conditions' => ['order_nrint' => $p_sOrderNrint],
        ])->contain(['HdIntPrplPrepressInstructions']);

        return $query->count() == 0 ? false : $query->first();
    }

}

?>