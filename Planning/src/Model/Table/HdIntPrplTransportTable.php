<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplTransportTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_transport');
        $this->primaryKey('id');

        $this->hasOne('HdIntPrplPartialDelivery', [
            'propertyName' => 'HdIntPrplPartialDelivery',
            'bindingKey' => 'partial_delivery_id', // VELD IN EXTERNE TABEL
            'foreignKey' => 'id', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

        $this->hasOne('HdIntPrplPackaging', [
            'propertyName' => 'HdIntPrplPackaging',
            'bindingKey' => 'order_nrint', // VELD IN EXTERNE TABEL
            'foreignKey' => 'order_nrint', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

        $this->hasOne('HdIntPrplViewItem', [
            'propertyName' => 'HdIntPrplViewItem',
            'bindingKey' => 'order_nrint', // VELD IN EXTERNE TABEL
            'foreignKey' => 'orderrule_id', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);
    }





}

?>