<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class AddressDeliveryTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhADRES_AFLEVER');
        $this->primaryKey('BKHAAFNRINT');

        $this->hasOne('Country', [
            'propertyName' => 'Country',
            'foreignKey' => 'BKHLANRINT',
            'bindingKey' => 'BKHAAF_BKHLANRINT',
            'joinType' => 'INNER',
        ]);

    }


    public function getAddressesByNrint($p_sCustomerNrint){
        return $this->find()
            ->select(["BKHAAFNRINT", "BKHAAFNAAM", "BKHAAFSTRAAT", "BKHAAFHUISNR", "BKHAAFHUISNRTOE", "BKHAAFPOSTCODE", "BKHAAFPLAATS", "BKHLAOMS" => "Country.BKHLAOMS"])
            ->contain("Country")
            ->where(["BKHAAF_BKHADNRINT" => $p_sCustomerNrint, "BKHAAFNAAM !=" => '<in use>'])
            ->order(["BKHAAFNRINT"])
            ->all();
    }

    public function getAddressInMarkup($p_sDelAddrNrint){
        $adres = $this->get($p_sDelAddrNrint, ['contain' => ["Country"]]);
        $sAdres =
            $adres->BKHAAFNAAM . "<br />" .
            $adres->BKHAAFSTRAAT .' '. $adres->BKHAAFHUISNR . $adres->BKHAAFHUISNR_TOE . "<br />" .
            $adres->BKHAAFPOSTCODE .' '. $adres->BKHAAFPLAATS . "<br />" .
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