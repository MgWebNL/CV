<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class SearchTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_log_search');
        $this->primaryKey('id');

    }

    public function getSearchResult($p_sToken, $p_sPartnerNrint){
        $aReturn = ["basics" => [], "results" => [], 'count' => 0];
        $aSearch = $this->find('all')
                    ->where(["url_token" => $p_sToken, "customer_nrint" => $p_sPartnerNrint])
                    ->first();

        // FUNCTIE:: ZOEK ARTIKELEN
        $aResult["article"] = $this->searchArticle($aSearch->keywords, $p_sPartnerNrint);
        $aReturn["count"] += $aResult["article"]->count();

        // FUNCTIE:: ZOEK OFFERTES
        $aResult["quote"] = $this->searchQuote($aSearch->keywords, $p_sPartnerNrint);
        $aReturn["count"] += $aResult["quote"]->count();

        // FUNCTIE:: ZOEK ORDER
        $aResult["order"] = $this->searchOrder($aSearch->keywords, $p_sPartnerNrint);
        $aReturn["count"] += $aResult["order"]->count();

        // FUNCTIE:: ZOEK FACTUUR
        $aResult["invoice"] = $this->searchInvoice($aSearch->keywords, $p_sPartnerNrint);
        $aReturn["count"] += $aResult["invoice"]->count();

        $aReturn["basics"] = $aSearch;
        $aReturn["results"] = $aResult;
        return $aReturn;
    }

    public function markResultUsed($p_sToken){
        $query = $this->query();
        $query->update()
            ->set(['used_result'=>'1'])
            ->where(['url_token' => $p_sToken])
            ->execute();
    }

    public function markResultTrue($p_sToken){
        $query = $this->query();
        $query->update()
            ->set(['has_result'=>'1'])
            ->where(['url_token' => $p_sToken])
            ->execute();
    }

    private function searchArticle($p_sKeywords, $p_sCustomerNrint){
        $this->OrderLine = TableRegistry::get('OrderLine');
        return $this->OrderLine->find('all')
            ->select([
                "BKHARCODE" =>"Article.BKHARCODE",
                "BKHAROMS" => "Article.BKHAROMS",
                "BKHARNRINT" => "Article.BKHARNRINT"
            ])
            ->contain(['Order', 'Article.HdArticle'])
            ->where(["Order.ORDOR_BKHADNRINT" => $p_sCustomerNrint, "ORDRRTYPE" => 0])
            ->andWhere(function ($exp) use ($p_sKeywords) {
                return $exp->or_([
                    "Article.BKHARCODE LIKE" => '%'.$p_sKeywords.'%', // ARTIKELNUMMER
                    "Article.BKHAROMS LIKE" => '%'.$p_sKeywords.'%', // ARTIKELOMSCHRIJVING
                    "HdArticle.customer_artNumber LIKE" => '%'.$p_sKeywords.'%' // KLANTOMSCHRIJVING
                ]);
            })
            ->group(["BKHARNRINT"])
            ->order(["BKHARCODE"])
            ->all();
    }


    private function searchQuote($p_sKeywords, $p_sCustomerNrint){
        $this->QuotationLine = TableRegistry::get('QuotationLine');
        return $this->QuotationLine->find('all')
            ->select([
                "ORDOFNR" => "Quotation.ORDOFNR",
                "ORDOFOMS" => "Quotation.ORDOFOMS",
                "ORDOFNRINT" => "Quotation.ORDOFNRINT",
                "ORDOFDATUM" => "Quotation.ORDOFDATUM",
                "ORDOFREFERENTIE" => 'Quotation.ORDOFREFERENTIE'
            ])
            ->contain(['Quotation', 'Article.HdArticle'])
            ->where(["Quotation.ORDOF_BKHADNRINT" => $p_sCustomerNrint, "ORDFRTYPE" => 0])
            ->andWhere(function ($exp) use ($p_sKeywords) {
                return $exp->or_([
                    "Quotation.ORDOFNR LIKE" => '%'.$p_sKeywords.'%', // OFFERTENUMMER
                    "Quotation.ORDOFOMS LIKE" => '%'.$p_sKeywords.'%', // OFFERTEOMSCHRIJVING
                    "Quotation.ORDOFREFERENTIE LIKE" => '%'.$p_sKeywords.'%', // OFFERTEREFERENTIE

                    "QuotationLine.ORDFROMS LIKE" => '%'.$p_sKeywords.'%', // OFFERTEREGELOMSCHRIJVING

                    "Article.BKHARCODE LIKE" => '%'.$p_sKeywords.'%', // ARTIKELCODE
                    "Article.BKHAROMS LIKE" => '%'.$p_sKeywords.'%', // ARTIKELOMSCHRIJVING
                    "HdArticle.customer_artNumber LIKE" => '%'.$p_sKeywords.'%' // KLANTOMSCHRIJVING
                ], ["Quotation.ORDOFNR" => 'string']);
            })
            ->group(["ORDOFNRINT"])
            ->order(["ORDOFNR"])
            ->all();
    }


    private function searchOrder($p_sKeywords, $p_sCustomerNrint){
        $this->OrderLine = TableRegistry::get('OrderLine');
        return $this->OrderLine->find('all')
            ->select([
                "ORDORNR" =>"Order.ORDORNR",
                "ORDOROMS" => "Order.ORDOROMS",
                "ORDORNRINT" => "Order.ORDORNRINT",
                "ORDORDATUM" => "Order.ORDORDATUM",
                "ORDORREFERENTIE" => 'Order.ORDORREFERENTIE'
            ])
            ->contain(['Order', 'Article.HdArticle'])
            ->where(["Order.ORDOR_BKHADNRINT" => $p_sCustomerNrint, "ORDRRTYPE" => 0])
            ->andWhere(function ($exp) use ($p_sKeywords) {
                return $exp->or_([
                    "Order.ORDORNR LIKE" => '%'.$p_sKeywords.'%', // ORDERNUMMER
                    "Order.ORDOROMS LIKE" => '%'.$p_sKeywords.'%', // ORDEROMSCHRIJVING
                    "Order.ORDORREFERENTIE LIKE" => '%'.$p_sKeywords.'%', // ORDERREFERENTIE

                    "OrderLine.ORDRROMS LIKE" => '%'.$p_sKeywords.'%', // ORDERREGELOMSCHRIJVING

                    "Article.BKHARCODE LIKE" => '%'.$p_sKeywords.'%', // ARTIKELCODE
                    "Article.BKHAROMS LIKE" => '%'.$p_sKeywords.'%', // ARTIKELOMSCHRIJVING
                    "HdArticle.customer_artNumber LIKE" => '%'.$p_sKeywords.'%' // KLANTOMSCHRIJVING
                ], ["Order.ORDORNR" => 'string']);
            })
            ->group(["ORDORNRINT"])
            ->order(["ORDORNR"])
            ->all();
    }

    private function searchInvoice($p_sKeywords, $p_sCustomerNrint){
        $this->InvoiceLine = TableRegistry::get('InvoiceLine');
        return $this->InvoiceLine->find('all')
            ->select([
                "BKHVFNR" =>"Invoice.BKHVFNR",
                "BKHVFOMS" => "Invoice.BKHVFTEKST1",
                "BKHVFNRINT" => "Invoice.BKHVFNRINT",
                "BKHVFDATUM" => "Invoice.BKHVFDATUM",
                "ORDORREFERENTIE" => 'Invoice.BKHVFNR'
            ])
            ->contain(['Invoice', 'Article.HdArticle'])
            ->where(["Invoice.BKHVF_BKHADNRINT" => $p_sCustomerNrint, "BKHVRTYPE" => 0])
            ->andWhere(function ($exp) use ($p_sKeywords) {
                return $exp->or_([
                    "Invoice.BKHVFNR LIKE" => '%'.$p_sKeywords.'%', // FACTUURNUMMER
                    "Invoice.BKHVFTEKST1 LIKE" => '%'.$p_sKeywords.'%', // FACTUUROMSCHRIJVING

                    "InvoiceLine.BKHVROMS LIKE" => '%'.$p_sKeywords.'%', // FACTUURREGELOMSCHRIJVING

                    "Article.BKHARCODE LIKE" => '%'.$p_sKeywords.'%', // ARTIKELCODE
                    "Article.BKHAROMS LIKE" => '%'.$p_sKeywords.'%', // ARTIKELOMSCHRIJVING
                    "HdArticle.customer_artNumber LIKE" => '%'.$p_sKeywords.'%' // KLANTOMSCHRIJVING
                ], ["Invoice.BKHVFNR" => 'string']);
            })
            ->group(["BKHVFNRINT"])
            ->order(["BKHVFNR"])
            ->all();
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