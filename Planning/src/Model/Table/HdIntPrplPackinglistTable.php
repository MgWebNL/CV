<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class HdIntPrplPackinglistTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_packinglist');
        $this->primaryKey('id');

    }

    public function getPackingLists($p_sOrderNrint){
        return $this->find("all")->where(["order_nrint" => $p_sOrderNrint]);
    }

}

?>