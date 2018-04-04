<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FRbkhADRESAFLEVERTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhADRES_AFLEVER');
        $this->primaryKey('BKHAAFNRINT');

        $this->hasOne('HdIntPrplCompanies', [
            'propertyName' => 'HdIntPrplCompanies',
            'bindingKey' => 'BKHADNRINT', // VELD IN EXTERNE TABEL
            'foreignKey' => 'adres_nrint', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);

        $this->hasOne('FRbkhLAND', [
            'propertyName' => 'FRbkhLAND',
            'bindingKey' => 'BKHAAF_BKHLANRINT', // VELD IN EXTERNE TABEL
            'foreignKey' => 'BKHLANRINT', // VELD INTERNE TABEL
            'joinType' => 'INNER',
        ]);
    }

    public function getCompanyAddressList($p_sType = null){
        $query = $this->find('all', [
            'contain' => ['HdIntPrplCompanies'],
        ]);

        if(!is_null($p_sType)){
            $query ->where(['company_type' => $p_sType]);
        }

        return $query;
    }
}

?>