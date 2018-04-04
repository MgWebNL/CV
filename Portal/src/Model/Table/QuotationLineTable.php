<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class QuotationLineTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRordOFFERTEREGEL');
        $this->primaryKey('ORDFRNRINT');

        $this->hasOne('Quotation', [
            'propertyName' => 'Quotation',
            'foreignKey' => 'ORDOFNRINT',
            'bindingKey' => 'ORDFR_ORDOFNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('Article', [
            'propertyName' => 'Article',
            'foreignKey' => 'BKHARNRINT',
            'bindingKey' => 'ORDFR_BKHARNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('QuotationLinePrices', [
            'propertyName' => 'QuotationLinePrices',
            'foreignKey' => 'ORDOST_ORDFRNRINT',
            'bindingKey' => 'ORDFRNRINT',
            'joinType' => 'LEFT',
        ]);

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