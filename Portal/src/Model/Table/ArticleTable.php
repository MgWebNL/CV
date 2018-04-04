<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class ArticleTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhARTIKEL');
        $this->primaryKey('BKHARNRINT');

        $this->hasOne('ArticleUnit', [
            'propertyName' => 'ArticleUnit',
            'foreignKey' => 'BKHEHNRINT',
            'bindingKey' => 'BKHAR_BKHEHNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('ArticleGroup', [
            'propertyName' => 'ArticleGroup',
            'foreignKey' => 'BKHAGNRINT',
            'bindingKey' => 'BKHAR_BKHAGNRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('ArticleColor', [
            'propertyName' => 'ArticleColor',
            'foreignKey' => 'ORDKLNRINT',
            'bindingKey' => 'BKHAR_ORDKLNRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('ArticleConstruction', [
            'propertyName' => 'ArticleConstruction',
            'foreignKey' => 'ORDCNSNRINT',
            'bindingKey' => 'BKHAR_ORDCNSNRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('ArticleQuality', [
            'propertyName' => 'ArticleQuality',
            'foreignKey' => 'BKHQUNRINT',
            'bindingKey' => 'BKHAR_BKHQUNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('HdArticle', [
            'propertyName' => 'HdArticle',
            'foreignKey' => 'article_nrint',
            'bindingKey' => 'BKHARNRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('OrdArtikel', [
            'propertyName' => 'FRordARTIKEL',
            'foreignKey' => 'ORDARNRINT',
            'bindingKey' => 'BKHARNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('StatisticsCode', [
            'propertyName' => 'StatisticsCode',
            'foreignKey' => 'BKHSCNRINT',
            'bindingKey' => 'BKHAR_BKHSCNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('OrderLine', [
            'propertyName' => 'OrderLine',
            'foreignKey' => 'BKHARNRINT',
            'bindingKey' => 'ORDRR_BKHARNRINT',
            'joinType' => 'INNER',
        ]);

    }


    public function getArticleByCode($p_sCode){
        $a = $this->find('all')->contain(["ArticleUnit"])->where(["BKHARCODE" => $p_sCode])->first();
        if(is_null($a)){
            return [];
        }
        return $a;
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