<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplLogTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_log');
        $this->primaryKey('id');
    }

    public function getOrderLog($p_sOrderNrint, $p_aTypes = []){
        $query = $this->find('all')
            ->where(['order_nrint' => $p_sOrderNrint])
            ->order(['timestamp' => 'DESC', 'id' => 'DESC']);

        if(!empty($p_aTypes)){
            $query->where(["log_type IN" => $p_aTypes]);
        }

        return $query;
    }



}

?>