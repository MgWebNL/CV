<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplMachineTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_machine');
        $this->primaryKey('id');

    }

    public function getMachineDataByOrder($p_aBasisData = ""){
        $query = $this->find('all')->toArray();

        $aData = false;

        if($p_aBasisData == ""){
            foreach($query as $item){
                $aData[$item["order_nrint"]] = $item;
            }
        }else{
            foreach($query as $item){
                if(isset($p_aBasisData[$item["order_nrint"]])){
                    $aData[$item["order_nrint"]] = $item;
                }
            }
        }



        return $aData;
    }



}

?>