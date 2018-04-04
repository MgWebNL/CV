<?php

/**
 * @property HdGeneral $HdGeneral
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplGeneralTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_general');
        $this->primaryKey('id');

        $this->hasOne('HdIntPrplStatus', [
            'propertyName' => 'HdIntPrplStatus',
            'bindingKey' => 'general_status', // VELD IN EXTERNE TABEL
            'foreignKey' => 'id', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

        $this->hasOne('HdIntPrplNapkins', [
            'propertyName' => 'HdIntPrplNapkins',
            'bindingKey' => 'napkin_nrint', // VELD IN EXTERNE TABEL
            'foreignKey' => 'napkin_article_nrint', // VELD INTERNE TABEL
            'joinType' => 'LEFT',
        ]);
    }


    public function getByOrderLineId($p_iOrderNrint){
        return $this->find()->where(["order_nrint" => $p_iOrderNrint])->firstOrFail();
    }



}

?>