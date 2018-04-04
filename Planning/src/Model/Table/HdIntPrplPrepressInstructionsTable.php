<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class HdIntPrplPrepressInstructionsTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_prepress_instructions');
        $this->primaryKey('id');

        $this->belongsTo('HdIntPrplPrepress', [
            'foreignKey' => 'prepress_form_id',
            'joinType' => 'LEFT',
        ]);

    }

}

?>