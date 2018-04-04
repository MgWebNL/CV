<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplStatusTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_status');
        $this->primaryKey('id');
    }

    /**
     * @param null $p_sSupplierNrint
     * @return array
     */
    public function getStatusTypes(){
        $a = [];
        
        $aStatus = $this->query()
                    ->select(
                        [
                            "id",
                            "status_type"
                        ]
                    )
                    ->all();

        foreach($aStatus as $row){
            $a[$row->id] = $row->status_type;
        }

        return $a;
    }


    public function getStatus($p_aArray = []){
        $a = [];

        $aStatus = $this->query();
        if(!empty($p_aArray)){
            $aStatus->where(["id IN" => $p_aArray]);
        }

        foreach($aStatus->all() as $row){
            $a[$row->id] = $row;
        }

        return $a;
    }



}

?>