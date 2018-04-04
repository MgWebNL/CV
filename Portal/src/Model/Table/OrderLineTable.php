<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class OrderLineTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRordORDERREGEL');
        $this->primaryKey('ORDRRNRINT');

        $this->hasOne('Order', [
            'propertyName' => 'Order',
            'foreignKey' => 'ORDORNRINT',
            'bindingKey' => 'ORDRR_ORDORNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('Article', [
            'propertyName' => 'Article',
            'foreignKey' => 'BKHARNRINT',
            'bindingKey' => 'ORDRR_BKHARNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('TussenRrVr', [
            'propertyName' => 'TussenRrVr',
            'foreignKey' => 'ORDTOF_ORDRRNRINT',
            'bindingKey' => 'ORDRRNRINT',
            'joinType' => 'LEFT',
        ]);

    }

    public function orderCountArticle($p_aQuotationLine){
        $r = [];
        foreach($p_aQuotationLine as $line){
            $r[$line->ORDFR_BKHARNRINT] = $this->find()->where(["ORDRR_BKHARNRINT" => $line->ORDFR_BKHADNRINT])->count();
        }
        return $r;
    }



    public function getDemandLines($p_sCustomerNrint){
        $a = $this->find()
            ->select([
                "customer_artNumber" =>"HdArticle.customer_artNumber",
                "ORDORNRINT" =>"Order.ORDORNRINT",
                "ORDORNR" =>"Order.ORDORNR",
                "ORDORREFERENTIE" => "Order.ORDORREFERENTIE",
                "ORDOROMS" => "Order.ORDOROMS",

                "BKHARNRINT" => "Article.BKHARNRINT",
                "BKHARCODE" => "Article.BKHARCODE",
                "BKHAROMS" => "Article.BKHAROMS",
                "ORDRR_INAFROEP" => "SUM(ORDRR_INAFROEP)",
                "ORDRR_AANTAL_AFGEROEPEN" => "SUM(ORDRR_AANTAL_AFGEROEPEN)"
            ])
            ->contain(["Order", "Article.HdArticle" => function($q) use ($p_sCustomerNrint){
                return $q->where(["address_nrint" => $p_sCustomerNrint]);
            }])
            ->where(["Order.ORDOR_BKHADNRINT" => $p_sCustomerNrint, "ORDRR_AFROEP" => 1, "ORDRR_INAFROEP <> ORDRR_AANTAL_AFGEROEPEN"])
            ->group(["ORDRR_BKHARNRINT"])
            ->having(["SUM(ORDRR_INAFROEP) <> SUM(ORDRR_AANTAL_AFGEROEPEN)"])
            ->order(["ORDRRNRINT" => "DESC"])
            ->all();
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