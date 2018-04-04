<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class HdIntPrplViewDeliveryTimeTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_view_delivery_time');
        $this->primaryKey('orderrule_id');
    }

}

?>