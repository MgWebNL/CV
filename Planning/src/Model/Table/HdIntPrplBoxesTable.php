<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplBoxesTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_boxes');
        $this->primaryKey('id');
    }


}

?>