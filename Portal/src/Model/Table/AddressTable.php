<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class AddressTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhADRES');
        $this->primaryKey('BKHADNRINT');

        $this->hasOne('HdAddress', [
            'propertyName' => 'HdAddress',
            'foreignKey' => 'FRbkhADRES_NRINT',
            'bindingKey' => 'BKHADNRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('OrdAddress', [
            'propertyName' => 'OrdAddress',
            'foreignKey' => 'ORDADNRINT',
            'bindingKey' => 'BKHADNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('Country', [
            'propertyName' => 'Country',
            'foreignKey' => 'BKHLANRINT',
            'bindingKey' => 'BKHAD_BKHLANRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('PriceGroup', [
            'propertyName' => 'PriceGroup',
            'foreignKey' => 'BKHPGNRINT',
            'bindingKey' => 'BKHAD_BKHPGNRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('Language', [
            'propertyName' => 'Language',
            'foreignKey' => 'BKHTANRINT',
            'bindingKey' => 'BKHAD_BKHTANRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('PaymentCondition', [
            'propertyName' => 'PaymentCondition',
            'foreignKey' => 'BKHBTNRINT',
            'bindingKey' => 'BKHAD_BKHBTNRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('PaymentMethod', [
            'propertyName' => 'PaymentMethod',
            'foreignKey' => 'BKHBWNRINT',
            'bindingKey' => 'BKHAD_BKHBWNRINT',
            'joinType' => 'LEFT',
        ]);

    }


    public function getAddressInMarkup($p_sAddrNrint){
        $adres = $this->get($p_sAddrNrint, ['contain' => ["Country"]]);
        $sAdres =
            $adres->BKHADNAAM . "<br />" .
            $adres->BKHADADRES_W .' '. $adres->BKHADADRES_HNR . $adres->BKHADADRES_HRN_TOE . "<br />" .
            $adres->BKHADPOSTCODE .' '. $adres->BKHADPLAATS . "<br />" .
            $adres->Country->BKHLAOMS;
        return $sAdres;
    }




    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
    }

}

?>