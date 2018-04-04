<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class ArticlePriceTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhARTIKELPRIJS');
        $this->primaryKey('BKHARNRINT');

        $this->hasMany('ArticlePriceLine', [
            'propertyName' => 'ArticlePriceLine',
            'foreignKey' => 'BKHARS_BKHAPNRINT',
            'bindingKey' => 'BKHAPNRINT',
            'joinType' => 'INNER',
        ]);

    }

    public function loadModel($p_sTableName){
        $this->$p_sTableName = TableRegistry::get($p_sTableName);
    }


    public function getArticleBulkPricesCustomer($p_sArticleNrint, $p_sCustomerNrint, $p_iType = 0){
        // HAAL KLANTSPECIFIEK OP
        // TYPE 0 = VERKOOP
        // TYPE 1 = INKOOP

        // STAP 1 :: KIJK OF ER KLANTSTAFFELS ZIJN !!
        $aPrices = $this->find('all')
            ->contain(["ArticlePriceLine" => function($q){ return $q->order(["BKHARSAANTAL_LAAG" => "ASC"]); }])
            ->where([
                "BKHAP_BKHADNRINT" => $p_sCustomerNrint,
                "BKHAP_BKHARNRINT" => $p_sArticleNrint,
                "BKHAPSOORT" => $p_iType
            ])->first();

        if(!is_null($aPrices)){
//            echo 1;
            return $aPrices;
        }

        // STAP 2 :: HAAL PRIJSGROEP OP !!
        $iPercentageFactor = 1;
        $sPriceGroupNrint = $this->m_aPriceGroup->BKHPGNRINT;
        if($this->m_aPriceGroup->BKHPG_BKHPGNRINT != ""){
            $iPercentageFactor = $this->m_aPriceGroup->BKHPGPERCENTAGE / 100;
            $sPriceGroupNrint = $this->m_aPriceGroup->BKHPG_BKHPGNRINT;
        }

        $this->loadModel("PriceGroupRule");
        $aPrices = $this->PriceGroupRule->find()
            ->where([
                "BKHPGR_BKHPGNRINT" => $sPriceGroupNrint,
                "BKHPGR_BKHARNRINT" => $p_sArticleNrint
            ])
            ->contain(["PriceGroupRuleList" => function($q){
                return $q->order(["BKHGRLLAAG" => "ASC"]);
            }])
            ->first();

        if($iPercentageFactor != 1){
            foreach($aPrices->PriceGroupRuleList as $k => $a){
                $a->BKHGRLPRIJS = $a->BKHGRLPRIJS * $iPercentageFactor;
            }
        }

        if(!is_null($aPrices)){
            echo 2;
            return $aPrices;
        }

        // STAP 2 :: STANDAARD STAFFEL !!
        $aPrices = $this->find('all')
            ->contain(["ArticlePriceLine" => function($q){ return $q->order(["BKHARSAANTAL_LAAG" => "ASC"]); }])
            ->where([
                "BKHAP_BKHADNRINT" => HD_DEFAULT_CUSTOMER,
                "BKHAP_BKHARNRINT" => $p_sArticleNrint,
                "BKHAPSOORT" => $p_iType
            ])->first();

        if(!is_null($aPrices)){
//            echo 4;
            return $aPrices;
        }
        /**
        // STAP 3 :: HAAL LAATSTE ORDERREGEL OP + HAAL OFFERTEREGEL OP EN VERGELIJK
        $this->loadModel("OrderLine");
        $aPricesOR = $this->OrderLine->find('all')
            ->select(["BKHARSAANTAL_LAAG" => 1, "BKHARSAANTAL_HOOG" => 9999999, "BKHARSPRIJS" => "ORDRRPRIJS"])
            ->contain(["Order"])
            ->where(["Order.ORDOR_BKHADNRINT" => $p_sCustomerNrint, "ORDRR_BKHARNRINT" => $p_sArticleNrint])
            ->order(["Order.ORDORDATUM" => "DESC"])
            ->first();


        $this->loadModel("QuotationLine");
        $aPricesOF = $this->QuotationLine->find('all')
            ->select(["BKHARSAANTAL_LAAG" => 1, "BKHARSAANTAL_HOOG" => 9999999, "BKHARSPRIJS" => "ORDFRPRIJS"])
            ->contain(["Quotation"])
            ->where(["Quotation.ORDOF_BKHADNRINT" => $p_sCustomerNrint, "ORDFR_BKHARNRINT" => $p_sArticleNrint])
            ->order(["Order.ORDORDATUM" => "DESC"])
            ->first();

        if($aPricesOF->Quotation->ORDOFDATUM > $aPricesOR->Order->ORDORDATUM){
            $aPrices = $aPricesOF;
        }else{
            $aPrices = $aPricesOR;
        }

        if(!is_null($aPrices)){
//            echo 3;
            $aPrice["ArticlePriceLine"][0] = $aPrices;
            return (object)$aPrice;
        }
         **/

        // STAP 3 :: HAAL LAATSTE ORDERREGEL OP
        $this->loadModel("OrderLine");
        $aPrices = $this->OrderLine->find('all')
            ->select(["BKHARSAANTAL_LAAG" => 1, "BKHARSAANTAL_HOOG" => 9999999, "BKHARSPRIJS" => "ORDRRPRIJS"])
            ->contain(["Order"])
            ->where(["Order.ORDOR_BKHADNRINT" => $p_sCustomerNrint, "ORDRR_BKHARNRINT" => $p_sArticleNrint])
            ->order(["Order.ORDORDATUM" => "DESC"])
            ->first();

        if(!is_null($aPrices)){
//            echo 2;
            $aPrice["ArticlePriceLine"][0] = $aPrices;
            return (object)$aPrice;
        }

        // STAP 4 :: HAAL LAATSTE OFFERTEREGEL OP
        $this->loadModel("QuotationLine");
        $aPrices = $this->QuotationLine->find('all')
            ->select(["BKHARSAANTAL_LAAG" => 1, "BKHARSAANTAL_HOOG" => 9999999, "BKHARSPRIJS" => "ORDFRPRIJS"])
            ->contain(["Quotation"])
            ->where(["Quotation.ORDOF_BKHADNRINT" => $p_sCustomerNrint, "ORDFR_BKHARNRINT" => $p_sArticleNrint])
            ->order(["Order.ORDORDATUM" => "DESC"])
            ->first();

        if(!is_null($aPrices)){
//            echo 3;
            $aPrice["ArticlePriceLine"][0] = $aPrices;
            return (object)$aPrice;
        }


        // STAP 5 :: 0 euro
//        echo 5;
        $aPrices["ArticlePriceLine"][] = ["BKHARSAANTAL_LAAG" => 1, "BKHARSAANTAL_HOOG" => 9999999, "BKHARSPRIJS" => 0];
        return $aPrices = (object)$aPrices;
    }





    public function getArticlePriceByQuantity($p_sArticleNrint, $p_sCustomerNrint, $p_iQuantity, $p_iType = 0){
        $price = 0;
        $aPrices = $this->getArticleBulkPricesCustomer($p_sArticleNrint, $p_sCustomerNrint, $p_iType);
        if(!is_null($aPrices)) {
            foreach ($aPrices->ArticlePriceLine as $line) {
                if ($p_iQuantity >= $line->BKHARSAANTAL_LAAG) {
                    $price = $line->BKHARSPRIJS;
                }
            }
            if($price == 0){
                $price = $aPrices->ArticlePriceLine[0]->BKHARSPRIJS;
            }
        }else{
            // GEEN STAFFELPRIJZEN BESCHIKBAAR
            $price = 0;
        }
        return $price;
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