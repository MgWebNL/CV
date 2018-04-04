<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use DateTime;

/**
 * Class ArticleHelperComponent
 * @package App\Controller\Component
 */
class ArticleHelperComponent extends Component
{

    public $m_aStatus = [
        0 => ["text" => "Frequent", "color" => "green"],
        1 => ["text" => "Occasional", "color" => "orange"],
        2 => ["text" => "History", "color" => "red"],
    ];

    public $m_aArticleUnits = [
        0 => 'mm',
        1 => 'cm',
        2 => 'm'
    ];

    public $components = ['Functions', 'Media'];

    /**
     * @param $p_sModelname
     * START ELK COMPONENT MET DEZE FUNCTIE !!
     */
    public function loadModel($p_sModelname){
        $this->$p_sModelname = TableRegistry::get($p_sModelname);
    }

    /**
     * @param $p_sCustomerNrint
     * @return mixed
     */
    public function getArticleListCustomer($p_sCustomerNrint){
        $oStartDate = new DateTime('-1 years');
        $this->loadModel('OrderLine');
        $query = $this->OrderLine->find('all');

        $countThisYear = $query->newExpr()
            ->addCase(
                $query->newExpr()->add(["Order.ORDORDATUM >=" => $oStartDate->format('Y-m-d')]),
                1,
                'integer'
            );

        return $query->select([
                "BKHARNRINT" => "Article.BKHARNRINT",
                "BKHARCODE" => "Article.BKHARCODE",
                "BKHAROMS" => "Article.BKHAROMS",
                "BKHAR_BKHGBNRINT_VF" => "Article.BKHAR_BKHGBNRINT_VF",
                "Article.BKHARLEVERTIJD_IKS",
                "Article.BKHARINHOUD",
                "countOrders" => "COUNT(ORDRRNRINT)",
                "countOrdersLastYear" => $query->func()->count($countThisYear),
                "customer_artNumber" => "HdArticle.customer_artNumber",
                "latest_order" => "MAX(ORDORDATUM)"
            ])
            ->contain(["Order", "Article.HdArticle" => function($q) use ($p_sCustomerNrint){
                return $q->where(["address_nrint" => $p_sCustomerNrint]);
            }])
            ->where([
                "Order.ORDOR_BKHADNRINT" => $p_sCustomerNrint,
                "Article.BKHARNRINT <>" => ''
            ])
            ->group(["Article.BKHARNRINT"]);
    }


    public function getArticleListCustomerCompact($p_sCustomerNrint){
        $this->loadModel('OrderLine');
        $query = $this->OrderLine->find('all');

        $a = $query->select([
            "BKHARNRINT" => "Article.BKHARNRINT",
            "countOrders" => "COUNT(ORDRRNRINT)"
        ])
            ->contain(["Order", "Article"])
            ->where([
                "Order.ORDOR_BKHADNRINT" => $p_sCustomerNrint,
                "Article.BKHARNRINT <>" => ''
            ])
            ->group(["Article.BKHARNRINT"]);

        return $this->Functions->mergeToObjectKey($a, 'BKHARNRINT');
    }

    /**
     * @param $p_sArticleNrint
     * @param $p_sCustomerNrint
     * @return mixed
     */
    public function getArticleCustomer($p_sArticleNrint, $p_sCustomerNrint)
    {
        $this->loadModel("Article");

        // BASISGEGEVENS
        $oStartDate = new DateTime('-1 years');
        $this->loadModel('OrderLine');
        $query = $this->OrderLine->find('all');

        $countThisYear = $query->newExpr()
            ->addCase(
                $query->newExpr()->add(["Order.ORDORDATUM >=" => $oStartDate->format('Y-m-d')]),
                1,
                'integer'
            );

        return $query->select([
            "BKHARNRINT" => "Article.BKHARNRINT",
            "BKHARCODE" => "Article.BKHARCODE",
            "BKHAROMS" => "Article.BKHAROMS",

            "Article.BKHARNRINT",
            "Article.BKHARCODE",
            "Article.BKHAROMS",
            "Article.BKHARLEVERTIJD_IKS",
            "ArticleUnit.BKHEHCODE",
            "Article.BKHARPALLETFACTOR",
            "Article.BKHAR_LENGTE",
            "Article.BKHAR_LENGTE_EENHEID",
            "Article.BKHAR_BREEDTE",
            "Article.BKHAR_BREEDTE_EENHEID",
            "Article.BKHAR_HOOGTE",
            "Article.BKHAR_HOOGTE_EENHEID",
            "Article.BKHAR_HOOGTE_NVT",
            "Article.BKHAR_FSC_NUMMER",
            "Article.BKHARVOORRAAD",
            "Article.BKHAREANCODE",
            "Article.BKHARPALLETFACTOR",
            "Article.BKHARINHOUD",
            "Article.BKHARAANTAL",

            "StatisticsCode.BKHSCCODE",

            "ArticleQuality.BKHQUCODE",

            "ArticleGroup.BKHAGCODE",

            "ArticleColor.ORDKLOMS",

            "ArticleConstruction.ORDCNSOMS",

            "countOrders" => "COUNT(ORDRRNRINT)",
            "countOrdersLastYear" => $query->func()->count($countThisYear),
        ])
            ->contain(["Order", "Article" => function($q){
                return $q->contain([
                    "StatisticsCode",
                    "ArticleUnit",
                    "ArticleQuality",
                    "ArticleGroup",
                    "ArticleConstruction",
                    "ArticleColor"
                ]);
            }])
            ->where([
                "Order.ORDOR_BKHADNRINT" => $p_sCustomerNrint,
                "Article.BKHARNRINT" => $p_sArticleNrint
            ])
            ->group(["Article.BKHARNRINT"]);
    }

    public function setReadableUnits($p_aRow){
        @$p_aRow->Article->BKHAR_LENGTE_EENHEID = $this->m_aArticleUnits[$p_aRow->Article->BKHAR_LENGTE_EENHEID];
        @$p_aRow->Article->BKHAR_BREEDTE_EENHEID = $this->m_aArticleUnits[$p_aRow->Article->BKHAR_BREEDTE_EENHEID];
        @$p_aRow->Article->BKHAR_HOOGTE_EENHEID = $this->m_aArticleUnits[$p_aRow->Article->BKHAR_HOOGTE_EENHEID];
    }


    public function setAdditionalArticleInfoCustomer($p_aList, $p_sCustomerNrint){

        $this->loadModel("ArticlePrice");
        $this->loadModel("HdCustomerArticle");

        foreach($p_aList as $row){
            $this->setReadableUnits($row);
            //$row->ArticlePrice = $this->ArticlePrice->getArticleBulkPricesCustomer($row->BKHARNRINT, $p_sCustomerNrint);
            $row->ArticlePrice = $this->getArticleBulkPricesCustomer($row->BKHARNRINT, $p_sCustomerNrint);
            $row->ArticlePrice = $this->getArticleBulkPricesCustomer($row->BKHARNRINT, $p_sCustomerNrint);
            $row->HdCustomerArticle = $this->HdCustomerArticle->getArticle($row->BKHARNRINT, $p_sCustomerNrint);

            $row->History = $this->getArticleHistoryCustomer($row->BKHARNRINT, $p_sCustomerNrint);

            $row->Latest = $this->getLatestOrderLine($row->BKHARNRINT, $p_sCustomerNrint);

            $row->Image = $this->getProductImage($row);

        }

        return $p_aList;

    }

    public function getProductImage($p_aRow){
        $oImage = new \stdClass();
        @$oImage->article_img = $this->Media->getProductImage($p_aRow->BKHARCODE, $p_aRow->Article->ArticleGroup->BKHAGCODE);
        return $oImage;
    }

    public function calcSavings($p_sCustomerNrint, $p_oLatest, $p_iNewQuantity){

        $oSaving = new \stdClass();

        $this->loadModel("ArticlePrice");

        $oSaving->oldPrice = $p_oLatest->ORDRRPRIJS;
        $oSaving->oldQuantity = $p_oLatest->ORDRRAANTAL;

//        $oSaving->newPrice = $this->ArticlePrice->getArticlePriceByQuantity($p_oLatest->ORDRR_BKHARNRINT, $p_sCustomerNrint, $p_iNewQuantity);
        $oSaving->newPrice = $this->getArticlePriceByQuantity($p_oLatest->ORDRR_BKHARNRINT, $p_sCustomerNrint, $p_iNewQuantity);
        $oSaving->newQuantity = $p_iNewQuantity;

//        $saving = ( $oSaving->oldPrice * $oSaving->oldQuantity) - ($p_iNewQuantity * $oSaving->newPrice);
        $saving = ( $oSaving->oldPrice - $oSaving->newPrice) * $p_iNewQuantity;
        $oSaving->saving = $saving > 0 ? $saving : 0;

        return $oSaving;
    }

    public function getLatestOrderLine($p_sArticleNrint, $p_sCustomerNrint){
        $this->loadModel("OrderLine");
        $latest = $this->OrderLine->find('all')
            ->contain(["Order"])
            ->where(["Order.ORDOR_BKHADNRINT" => $p_sCustomerNrint, "ORDRR_BKHARNRINT" => $p_sArticleNrint])
            ->last();

        if(is_null($latest)){
            return false;
        }else{
            return $latest;
        }
    }

    public function getLatestQuotationLine($p_sArticleNrint, $p_sCustomerNrint){
        $this->loadModel("QuotationLine");
        $latest = $this->QuotationLine->find('all')
            ->contain(["Quotation"])
            ->where(["Quotation.ORDOF_BKHADNRINT" => $p_sCustomerNrint, "ORDFR_BKHARNRINT" => $p_sArticleNrint])
            ->first();

        if(is_null($latest)){
            return false;
        }else{
            return $latest;
        }
    }

    /**
     * @param $p_aList
     */
    public function determineArticleType(&$p_aList){
        foreach($p_aList as $art){
            if($art->countOrdersLastYear > 2){
                $art->BKHARCUSTOMERSTATUS = 0;
            }elseif($art->countOrdersLastYear > 0){
                $art->BKHARCUSTOMERSTATUS = 1;
            }else{
                $art->BKHARCUSTOMERSTATUS = 2;
            }
        }
    }

    public function truncateArticleDescription(&$p_aList){
        foreach($p_aList as $art){
            $art->BKHAROMS_BASIC = $art->BKHAROMS;
            $oms = explode('<br />', nl2br($art->BKHAROMS));
            $art->BKHAROMS = isset($oms[1]) ? $oms[0]." ".$oms[1] : $oms[0];
        }
    }

    public function getArticleListCustomerAdvice($p_sCustomerNrint, $p_iStatus = null){
        $this->loadModel("Ledger");

        $aStatus = $this->getStatusArray();
        $aList = $this->getArticleListCustomer($p_sCustomerNrint);
        $aList->order(["BKHARCODE"]);
        $this->truncateArticleDescription($aList);




        //$this->setAdditionalArticleInfoCustomer($aList,$p_sCustomerNrint);
        $this->setArticleListUsage($aList,$p_sCustomerNrint, 1);


        $this->determineArticleType($aList);
        $this->setStatusTextList($aList);



//
//        $this->setArticleListUsage($aList, $p_sCustomerNrint, 1);
//        $this->determineArticleType($aList);
//        $this->setStatusTextList($aList);
        //$this->setAdditionalArticleInfoCustomer($aList, $p_sCustomerNrint);

        //debug($aList); die();

        if($p_iStatus != null){
            $this->Functions->filter_array($aList, "BKHARCUSTOMERSTATUS", $p_iStatus);
            $this->_registry->getController()->set("iStatus".$p_iStatus, "active");
            $this->_registry->getController()->set("sStatus", $aStatus[$p_iStatus]["text"]);
        }else{
            $this->_registry->getController()->set("iStatus", "active");
            $this->_registry->getController()->set("sStatus", 'All');
        }

        $aGBs = unserialize(HD_ARRAY_EXCLUDE_GB);

        $ledger = $this->Ledger->find()->where(["BKHGBNR LIKE" => '8%', "BKHGBNR NOT IN" => $aGBs], ["BKHGBNR" => "string"])->order(["BKHGBNR"])->all();
        $oLedger = $this->Functions->mergeToObjectKey($ledger, "BKHGBNRINT");
        $aList = $this->Functions->groupByObjectKey($aList, "BKHAR_BKHGBNRINT_VF");
        $a = new \stdClass();

        foreach($oLedger as $ledger){
            if(property_exists($aList,$ledger->BKHGBNRINT)){
                $a->{$ledger->BKHGBNRINT} = $aList->{$ledger->BKHGBNRINT};
            }
        }

        $this->_registry->getController()->set("aLedger", $oLedger);

        return $a;
    }

    public function setAdvicePeriod($aArticleObject, $p_sStartDate, $p_sEndDate){
        $aRet =[];
        $startDate = date('Ymd', strtotime($p_sStartDate));
        $endDate = date('Ymd', strtotime($p_sEndDate));
        foreach($aArticleObject as $gb){
            foreach($gb as $v){
                $date = isset($v["ArticleUsage"]["besteldatum"]) && $v["ArticleUsage"]["besteldatum"] != "" ? $v["ArticleUsage"]["besteldatum"]->format('Ymd') : null;
                if(!is_null($date) && $date >= $startDate && $date <= $endDate && $v["ArticleUsage"]["opt_bst"] > 0) {
                    $v["besteldatumSort"] = $v["ArticleUsage"]["besteldatum"]->format('Ymd');
                    $v["besteldatum"] = $v["ArticleUsage"]["besteldatum"]->format('d-m-Y');
                    $aRet[] = $v;
                }
            }
        }

        $aRet = $this->Functions->array_sort_by_column($aRet, "BKHARCODE", 'desc');
        $aRet = $this->Functions->array_sort_by_column($aRet, "besteldatumSort", 'desc');

        return $aRet;
    }



    /****************************************************/
    /****************** EXTRA FUNCTIES ******************/
    /****************************************************/

    /**
     * @return array
     */
    public function getStatusArray(){
        return $this->m_aStatus;
    }

    /**
     * @param $p_aList
     * @return mixed
     */
    public function setStatusTextList($p_aList){
        if($p_aList->count() > 0){
            foreach($p_aList as $row){
                $this->setStatusText($row);
            }
        }
        return $p_aList;
    }

    /**
     * @param $p_aItem
     * @return mixed
     */
    public function setStatusText($p_aItem){
        if($p_aItem){
            $p_aItem->BKHARCUSTOMERSTATUSTEXT = $this->m_aStatus[$p_aItem->BKHARCUSTOMERSTATUS];
        }
        return $p_aItem;
    }

    public function getArticleHistoryCustomer($p_sArticleNrint, $p_sCustomerNrint){
        $object = (object)[];

        $this->loadModel("OrderLine");
        $object->Order = $this->OrderLine->find('all')
            ->contain(["Order"])
            ->where([
                "ORDRR_BKHARNRINT" => $p_sArticleNrint,
                "ORDOR_BKHADNRINT" => $p_sCustomerNrint
            ])
            ->order(["Order.ORDORDATUM" => "DESC"])
            ->all();

        $this->loadModel("QuotationLine");
        $object->Quote = $this->QuotationLine->find('all')
            ->contain(["Quotation"])
            ->where([
                "ORDFR_BKHARNRINT" => $p_sArticleNrint,
                "ORDOF_BKHADNRINT" => $p_sCustomerNrint
            ])
            ->order(["Quotation.ORDOFDATUM" => "DESC"])
            ->all();

        $this->loadModel("InvoiceLine");
        $object->Invoice = $this->InvoiceLine->find('all')
            ->contain(["Invoice"])
            ->where([
                "BKHVR_BKHARNRINT" => $p_sArticleNrint,
                "BKHVF_BKHADNRINT" => $p_sCustomerNrint
            ])
            ->order(["Invoice.BKHVFDATUM" => "DESC"])
            ->all();

        return $object;
    }


    public function setArticleUsageCustomer($p_sCustomerNrint, $p_sArticleNrint = null){
        $this->loadModel("ArticleUsage");
        $aData = $this->ArticleUsage->find("all")->where(["BKHADNRINT" => $p_sCustomerNrint]);
        if(!is_null($p_sArticleNrint)) {
            $aData->andWhere(["BKHARNRINT" => $p_sArticleNrint]);
        }

        $aPeriodRows = $this->fillPeriods($aData);

        return $aPeriodRows;

    }

    public function setArticleListUsageOld($p_aList, $p_sCustomerNrint,  $p_iLevertijd = 0){
        $this->loadModel("ArticleUsage");
        $a = [];
        foreach($p_aList as $aArt){
            $a[] = $aArt->BKHARNRINT;
        }

        if(!empty($a)) {

            $aData = $this->ArticleUsage->find("all")->where(["BKHARNRINT IN" => $a, "BKHADNRINT" => $p_sCustomerNrint]);
            $aData->all();

            $aPeriodRows = $this->fillPeriods($aData, $p_iLevertijd);
            $this->calcOrderDate($aPeriodRows);
            foreach ($aPeriodRows as $row) {
                $aa[$row["BKHARNRINT"]] = $row;
            }

            foreach ($p_aList as $row) {
                if (isset($aa[$row->BKHARNRINT])) {
                    $row->ArticleUsage = $aa[$row->BKHARNRINT];
                    $row->ArticleUsage["opt_bst"] = $this->roundOptBstQuantity($row);
                }
            }
        }


        return $p_aList;
    }

    public function setArticleListUsage($p_aList, $p_sCustomerNrint,  $p_iLevertijd = 0){
//        $this->loadModel("ArticleUsage");
//        $a = [];
//        foreach($p_aList as $aArt){
//            $a[] = $aArt->BKHARNRINT;
//        }
//
//        if(!empty($a)) {
//
//            $aData = $this->ArticleUsage->find("all")->where(["BKHARNRINT IN" => $a, "BKHADNRINT" => $p_sCustomerNrint]);
//            $aData->all();
//
//            $aPeriodRows = $this->fillPeriods($aData, $p_iLevertijd);
//            //$this->calcOrderDate($aPeriodRows);
//            foreach ($aPeriodRows as $row) {
//                $aa[$row["BKHARNRINT"]] = $row;
//            }
//
//            foreach ($p_aList as $row) {
//                if (isset($aa[$row->BKHARNRINT])) {
//                    $row->ArticleUsage = $aa[$row->BKHARNRINT];
//                    $row->ArticleUsage["opt_bst"] = $this->roundOptBstQuantity($row);
//                }
//            }
//        }




        foreach($p_aList as $aArt) {
            $total = 0;
            $diff = 0;
            $last = null;
            $lastRule = null;
            if (!empty($aArt->Article) && !empty($aArt->History->Order)) {
                foreach ($aArt->History->Order as $his) {
                    $aArt->ArticleUsage = [];
                    if (is_null($lastRule)) {
                        $lastRule = $his;
                    }
                    if ($his->Order->ORDORDATUM->wasWithinLast('1 years') && $his->ORDRRAANTAL != 0) {
                        $total += $his->ORDRRAANTAL;
                        if (!is_null($last)) {
                            $diff += ($his->ORDRRAANTAL - $last);
                        }
                        $last = $his->ORDRRAANTAL;
                    }

                    $date = $his->Order->ORDORDATUM->diff(new Time());
                    $date = $date->format('%a') / 30.4375;
                }

                $date = $date > 12 ? 12 : $date;
                $date = $date >= 1 ? $date : 1;
                $usageplain = ($total - $diff) / $date;
                $deliveryusage = $usageplain == 0 ? 0 : ($aArt->Article->BKHARLEVERTIJD_IKS / 30.4375) * $usageplain;

                $usage = $usageplain * 2 + $deliveryusage;

                $aPrices = $this->getArticleBulkPricesCustomer($aArt->BKHARNRINT, $p_sCustomerNrint, 0);

                $aArt->ArticleUsage["verbruik"] = $usageplain;
                $aArt->ArticleUsage["opt_bst"] = $usage;
                $aArt->ArticleUsage["opt_bst"] = $this->roundOptBstQuantity2($aArt, $aPrices);

//            $aArt->ArticleUsage["opt_bst"] = $aArt->Latest->ORDRRAANTAL > $aArt->ArticleUsage["opt_bst"] ? $aArt->Latest->ORDRRAANTAL : $aArt->ArticleUsage["opt_bst"];

                // BEREKEN BESTELDATUM
                if ($aArt->ArticleUsage["verbruik"] > 0 && $aArt->countOrders > 1) {
                    $iDaysAgo = $lastRule->Order->ORDORDATUM->diff(new Time())->format('%a');
                    $iDaysStock = $lastRule->ORDRRAANTAL / $aArt->ArticleUsage["verbruik"] * 30.4375;
                    $iStockFor = ceil($iDaysStock - $iDaysAgo);
                    $date = $iStockFor > 0 ? new Time("+ " . $iStockFor . " days") : new Time($iStockFor . " days");
                    $aArt->ArticleUsage["besteldatum"] = $date;
                }else{
                    $aArt->ArticleUsage["besteldatum"] = "";
                }

                $aArt->Savings = $this->calcSavings($p_sCustomerNrint, $aArt->Latest, $aArt->ArticleUsage["opt_bst"]);
            }
        }





        return $p_aList;
    }

    private function roundOptBstQuantity($p_oRow){
        $val = $p_oRow->ArticleUsage["opt_bst"];
        $iRound = isset($p_oRow->Article["BKHARINHOUD"]) ? $p_oRow->Article["BKHARINHOUD"] : "";

        if($iRound == "") {
            if ($val >= 0 && $val < 10) {
                // AFRONDEN OP GEHELEN NAAR BOVEN
                $round = ceil($val);
            } elseif ($val >= 10 && $val < 100) {
                // AFRONDEN OP 5-tallen
                $round = ceil($val / 5) * 5;
            } elseif ($val >= 100 && $val < 1000) {
                // AFORNDEN OP 10-tallen
                $round = ceil($val / 10) * 10;
            } elseif ($val >= 1000 && $val < 10000) {
                $round = ceil($val / 100) * 100;
            } elseif ($val >= 10000) {
                $round = ceil($val / 1000) * 1000;
            } else {
                $round = 0;
            }
        }else{
            $round = ceil($val / $iRound) * $iRound;
        }
        return $round;
    }

    private function fillPeriods($aData = array(), $p_iLevertijd = 0){
        // NORMALISEER DATA
        $aRawData = array();

        foreach($aData as $row){
            //var_dump($row["regels"]); die();
            $aRawData[$row["BKHARNRINT"]]["BKHARNRINT"] = $row["BKHARNRINT"];
            @$aRawData[$row["BKHARNRINT"]]["regels"] += $row["regels"];
            $aRawData[$row["BKHARNRINT"]]["BKHARLEVERTIJD_IKS"] = $p_iLevertijd != 0 ? $p_iLevertijd : $row["BKHARLEVERTIJD_IKS"];
            $aRawData[$row["BKHARNRINT"]]["BKHARPALLETFACTOR"] = $row["BKHARPALLETFACTOR"];
            $aRawData[$row["BKHARNRINT"]]["laatste_levering_datum"] = $row["laatste_levering_datum"];
            $aRawData[$row["BKHARNRINT"]]["laatste_levering_aantal"] = $row["laatste_levering_aantal"];
            $aRawData[$row["BKHARNRINT"]][$row["jaar"].str_pad($row["maand"],2,0,STR_PAD_LEFT)] = $row["totaal_aantal"];
            @$aRawData[$row["BKHARNRINT"]]["periodes"] = $row["periodes"] > $aRawData[$row["BKHARNRINT"]]["periodes"] ? $row["periodes"] : $aRawData[$row["BKHARNRINT"]]["periodes"];
            @$aRawData[$row["BKHARNRINT"]]["leverdatum"] = !isset($aRawData[$row["BKHARNRINT"]]["leverdatum"]) || $row["eerste_levering"] < $aRawData[$row["BKHARNRINT"]]["leverdatum"] ? $row["eerste_levering"] : $aRawData[$row["BKHARNRINT"]]["leverdatum"];
        }

        $aNorm = array();
        $endDate = date('Ym');

        foreach($aRawData as $k => $periode){
            $aNorm[$k] = $periode;
            $startDate = strtotime("-2 years");
            while(date('Ym',$startDate) <= $endDate){
                $add["periode"][date('Ym',$startDate)] = isset($aRawData[$k][date('Ym',$startDate)]) ? $aRawData[$k][date('Ym',$startDate)] : 0;
                $startDate = strtotime("+ 1 month",$startDate);
            }
            $aNorm[$k]["periode"] = $add["periode"];
            $aNorm[$k]["regels"] = $aRawData[$k]["regels"];
            $aNorm[$k]["levertijd"] = $aRawData[$k]["BKHARLEVERTIJD_IKS"];
            $aNorm[$k]["periodes_total"] = $aRawData[$k]["periodes"];
            $aNorm[$k]["leverdatum"] = $aRawData[$k]["leverdatum"];
        }

        //var_dump($aNorm); die();

        $aRes = array();
        foreach($aNorm as $k => $row){
            $aRev = array_reverse($row["periode"]);
            $aSlice = array_slice($aRev, 1, $row["periodes_total"]-1);
            if(count($aSlice) > 0){
                $aSliceThisMonth = array_slice($aRev,0,$row["periodes_total"]);
                $row["stdev"] =  number_format($this->stats_standard_deviation($aSlice), 4, ",", "");
                $row["stdevThisMonth"] =  number_format($this->stats_standard_deviation($aSliceThisMonth), 4, ",", "");
                $row["kfactor"] = 2.58;
                $row["veil_vrrd"] = number_format($row["stdev"]*$row["kfactor"]*sqrt($row["levertijd"]/7), 4, ",", "");
                $row["opt_bst"] = number_format(($row["levertijd"]/7/52*12) * array_sum($aRev)/$row["periodes_total"] + $row["veil_vrrd"], 4, ",", "");
                $aRes[$k] = $row;
            }

            //var_dump($row); die();

        }
        //die();
        //var_dump($aRes); die();
        return $aRes;
    }

    public function calcOrderDate(&$p_aData){
        $a = array();
        foreach($p_aData as $row){
            $row["verbruik"] = array_sum($row["periode"])/$row["periodes"];
            if($row["verbruik"] != 0) {
                $iTotalDays = $row["laatste_levering_aantal"] / $row["verbruik"] * 30.4375; // (365+365+365+366) / 48
                $iDaysPassed = date_diff(new DateTime(), $row["laatste_levering_datum"],true)->d;
                $iDaysLeft = round($iTotalDays - $iDaysPassed);
                $row["besteldatum"] = date('Y-m-d', strtotime("+".$iDaysLeft." days", strtotime(date('Y-m-d'))));
                $a[$row["BKHARNRINT"]] = $row;
            }
        }

        $p_aData = $a;
    }

    private function stats_standard_deviation(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        };
        if ($sample) {
            --$n;
        }
        return sqrt($carry / $n);
    }


    public function makeAdviceCalendarProof($p_aAdviceArray){

        $cal = [];
        foreach($p_aAdviceArray as $gb) {
            foreach ($gb as $art) {
                if(!is_null($art->ArticleUsage) && $art->ArticleUsage["opt_bst"] > 0 && $art->countOrders > 1) {
                    $row["type"] = 'art';
                    $row["id"] = $art->BKHARNRINT;
                    $row["title"] = $art->BKHARCODE;
                    $row["start"] = new Time($art->ArticleUsage["besteldatum"]);
                    $row["allDay"] = true;
                    $row["className"] = "bgm-secondair";
                    $row["description"] = $art->BKHAROMS_BASIC;
                    $row["quantity"] = ceil($art->ArticleUsage["opt_bst"]);
                    $cal[] = $row;
                }
            }
        }
        return $cal;
    }





























    /********************                             *********************/
    /********************                             *********************/
    /********************         TEST AREA           *********************/
    /********************                             *********************/
    /********************                             *********************/

    public function getArticleListCustomerAdvice2($p_iCustomerNrint){
        $this->loadModel("OrderLine");
        $aLines = $this->OrderLine
            ->find()
            ->contain(["Order", "Article"])
            ->where([
                "ORDRRTYPE" => "0",
                "ORDORDATUM >=" => "(CURDATE() - INTERVAL 1 YEAR)",
                "ORDORDATUM <=" => "CURDATE()",
                "ORDOR_BKHADNRINT" => $p_iCustomerNrint,
                "BKHARNRINT !=" => HD_CART_TRANS_ART_ID
            ])
            ->order(["ORDORDATUM" => "DESC"]);

        // MAAK ARTIKELEN AAN, MET ORDERREGELS
        $aArticles = [];
        $aReturn = [];
        foreach($aLines as $line){
            $k = $line["Article"]["BKHARNRINT"];
            $aArticles[$k] = $line->Article;
        }
        foreach($aLines as $line){
            $k = $line["Article"]["BKHARNRINT"];
            unset($line->Article);
            if(!isset($aArticles[$k]->OrderLines)){
                $aArticles[$k]->OrderLines = [];
            }
            $aArticles[$k]->OrderLines[] = $line;
        }
        foreach($aArticles as $aArt){
            $total = 0;
            $diff = 0;
            $last = null;
            $lastRule = null;
            $a = [];
            foreach ($aArt["OrderLines"] as $his) {
                $aArt->ArticleUsage = [];
                if (is_null($lastRule)) {
                    $lastRule = $his;
                }
                if ($his->Order->ORDORDATUM->wasWithinLast('1 years') && $his->ORDRRAANTAL != 0) {
                    $total += $his->ORDRRAANTAL;
                    if (!is_null($last)) {
                        $diff += ($his->ORDRRAANTAL - $last);
                    }
                    $last = $his->ORDRRAANTAL;
                }

                $date = $his->Order->ORDORDATUM->diff(new Time());
                $date = $date->format('%a') / 30.4375;
            }

            $date = $date > 12 ? 12 : $date;
            $date = $date >= 1 ? $date : 1;
            $usageplain = ($total - $diff) / $date;
            $deliveryusage = $usageplain == 0 ? 0 : ($aArt->BKHARLEVERTIJD_IKS / 30.4375) * $usageplain;

            $usage = $usageplain * 2 + $deliveryusage;


            $aArt["ArticleUsage"]["verbruik"] = $usageplain;
            $aArt["ArticleUsage"]["opt_bst"] = $usage;


//            $aArt->ArticleUsage["opt_bst"] = $aArt->Latest->ORDRRAANTAL > $aArt->ArticleUsage["opt_bst"] ? $aArt->Latest->ORDRRAANTAL : $aArt->ArticleUsage["opt_bst"];

            // BEREKEN BESTELDATUM
            if ($aArt["ArticleUsage"]["verbruik"] > 0 && count($aArt["OrderLines"]) > 1) {
                $iDaysAgo = $lastRule->Order->ORDORDATUM->diff(new Time())->format('%a');
                $iDaysStock = $lastRule->ORDRRAANTAL / $aArt["ArticleUsage"]["verbruik"] * 30.4375;
                $iStockFor = ceil($iDaysStock - $iDaysAgo);
                $date = $iStockFor > 0 ? new Time("+ " . $iStockFor . " days") : new Time($iStockFor . " days");
                $aArt["ArticleUsage"]["besteldatum"] = $date;

                $aReturn[] = $aArt;
            }

        }

        $this->loadModel("HdCustomerArticle");
        $aHdArticle = $this->HdCustomerArticle->getArticles($p_iCustomerNrint);
        foreach($aReturn as $a){
            $a->customer_artNumber = isset($aHdArticle[$a->BKHARNRINT]) ? $aHdArticle[$a->BKHARNRINT]->customer_artNumber : null;
        }

        return $aReturn;
    }

    public function roundOptBstQuantity2($p_oRow, $p_aStaffelQtys = []){
        $val = $p_oRow->ArticleUsage["opt_bst"];
        $iRound = isset($p_oRow["BKHARINHOUD"]) ? $p_oRow["BKHARINHOUD"] : "";
        if(!empty($p_aStaffelQtys)){
            $iRound = $p_aStaffelQtys->ArticlePriceLine{0}->BKHARSAANTAL_LAAG;
            foreach($p_aStaffelQtys as $qty){
                if($val >= $qty){
                    $iRound = $qty;
                }
            }
            $round = ceil($val / $iRound) * $iRound;
        }
        elseif($iRound == "") {
            if ($val >= 0 && $val < 10) {
                // AFRONDEN OP GEHELEN NAAR BOVEN
                $round = ceil($val);
            } elseif ($val >= 10 && $val < 100) {
                // AFRONDEN OP 5-tallen
                $round = ceil($val / 5) * 5;
            } elseif ($val >= 100 && $val < 1000) {
                // AFORNDEN OP 10-tallen
                $round = ceil($val / 10) * 10;
            } elseif ($val >= 1000 && $val < 10000) {
                $round = ceil($val / 100) * 100;
            } elseif ($val >= 10000) {
                $round = ceil($val / 1000) * 1000;
            } else {
                $round = 0;
            }
        }else{
            $round = ceil($val / $iRound) * $iRound;
        }
        return $round;
    }


    public function setAdvicePeriod2($aArticleObject, $p_sStartDate, $p_sEndDate){
        $aRet =[];
        $startDate = date('Ymd', strtotime($p_sStartDate));
        $endDate = date('Ymd', strtotime($p_sEndDate));
        foreach($aArticleObject as $v){
            $date = isset($v["ArticleUsage"]["besteldatum"]) && $v["ArticleUsage"]["besteldatum"] != "" ? $v["ArticleUsage"]["besteldatum"]->format('Ymd') : null;
            if(!is_null($date) && $date >= $startDate && $date <= $endDate && $v["ArticleUsage"]["opt_bst"] > 0) {
                $v["besteldatumSort"] = $v["ArticleUsage"]["besteldatum"]->format('Ymd');
                $v["besteldatum"] = $v["ArticleUsage"]["besteldatum"]->format('d-m-Y');
                $aRet[] = $v;
            }
        }

        $aRet = $this->Functions->array_sort_by_column($aRet, "BKHARCODE", 'desc');
        $aRet = $this->Functions->array_sort_by_column($aRet, "besteldatumSort", 'desc');

        return $aRet;
    }


    public function makeAdviceCalendarProof2($p_aAdviceArray){

        $cal = [];
        foreach($p_aAdviceArray as $art) {
            if(!is_null($art->ArticleUsage) && $art->ArticleUsage["opt_bst"] > 0 && $art->ArticleUsage["besteldatum"] != "") {
                $row["type"] = 'art';
                $row["id"] = $art->BKHARNRINT;
                $row["title"] = $art->BKHARCODE;
                $row["start"] = new Time($art->ArticleUsage["besteldatum"]);
                $row["allDay"] = true;
                $row["className"] = "bgm-secondair";
                $row["description"] = $art->BKHAROMS_BASIC;
                $row["quantity"] = ceil($art->ArticleUsage["opt_bst"]);
                $cal[] = $row;
            }
        }
        return $cal;
    }



    public function getArticleBulkPricesCustomer($p_sArticleNrint, $p_sCustomerNrint, $p_iType = 0){

        $this->loadModel("ArticlePrice");

        // HAAL KLANTSPECIFIEK OP
        // TYPE 0 = VERKOOP
        // TYPE 1 = INKOOP

        // STAP 1 :: KIJK OF ER KLANTSTAFFELS ZIJN !!
        $aPrices = $this->ArticlePrice->find('all')
            ->contain(["ArticlePriceLine" => function($q){ return $q->order(["BKHARSAANTAL_LAAG" => "ASC"]); }])
            ->where([
                "BKHAP_BKHADNRINT" => $p_sCustomerNrint,
                "BKHAP_BKHARNRINT" => $p_sArticleNrint,
                "BKHAPSOORT" => $p_iType
            ])->first();

        if(!is_null($aPrices)){
            return $aPrices;
        }

        // STAP 2 :: HAAL PRIJSGROEP OP !!
        $aPriceGroup = $this->request->session()->read('customerlogin.PriceGroup');
        $iPercentageFactor = 1;
        $sPriceGroupNrint = $aPriceGroup->BKHPGNRINT;
        if($aPriceGroup->BKHPG_BKHPGNRINT != ""){
            $iPercentageFactor = $aPriceGroup->BKHPGPERCENTAGE / 100;
            $sPriceGroupNrint = $aPriceGroup->BKHPG_BKHPGNRINT;
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

        if($iPercentageFactor != 1 && $aPrices !== null){
            foreach($aPrices->PriceGroupRuleList as $k => $a){
                $a->BKHGRLPRIJS = $a->BKHGRLPRIJS * $iPercentageFactor;
            }
        }

        if(!is_null($aPrices)){
            $aPrices = $this->renameFieldsPriceGroupToStaffel($aPrices);
            return $aPrices;
        }

        // STAP 2 :: HAAL STANDAARD PRIJSGROEP OP !!
        $this->loadModel("PriceGroupRule");
        $aPrices = $this->PriceGroupRule->find()
            ->where([
                "BKHPGR_BKHPGNRINT" => HD_DEFAULT_PRICEGROUP,
                "BKHPGR_BKHARNRINT" => $p_sArticleNrint
            ])
            ->contain(["PriceGroupRuleList" => function($q){
                return $q->order(["BKHGRLLAAG" => "ASC"]);
            }])
            ->first();

        if(!is_null($aPrices)){
            $aPrices = $this->renameFieldsPriceGroupToStaffel($aPrices);
            return $aPrices;
        }

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


    public function renameFieldsPriceGroupToStaffel($p_aPrices){
        $aPrices = new \stdClass();
        foreach($p_aPrices->PriceGroupRuleList as $rule){
            $row = new \stdClass();
            $row->BKHARSAANTAL_LAAG = $rule->BKHGRLLAAG;
            $row->BKHARSPRIJS = $rule->BKHGRLPRIJS;
            $aPrices->ArticlePriceLine[] = $row;
        }

        return $aPrices;
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

    public function getRecommendedLedgers(){
        $this->loadModel("Ledger");
        $this->loadModel("OrderLine");
        $aGBs = unserialize(HD_ARRAY_EXCLUDE_GB);

        // ALLEMAAL
        $ledger = $this->Ledger->find()->where(["BKHGBNR LIKE" => '8%', "BKHGBNR NOT IN" => $aGBs], ["BKHGBNR" => "string"])->order(["BKHGBNR"])->all();
        $oAll = $this->Functions->mergeToObjectKey($ledger, "BKHGBNRINT");

        // VERKOCHT LAATSTE JAAR
        $latest = $this->OrderLine->query();
        $latest
            ->select(["ORDRR_BKHGBNRINT"])
            ->contain(["Order"])
            ->where([
                "ORDRR_BKHGBNRINT <>" => "",
                "Order.ORDOR_BKHADNRINT" => $this->m_iPartner,
                "Order.ORDORDATUM >=" => date('Y-m-d', strtotime("-1 years"))
            ])
            ->group(["ORDRR_BKHGBNRINT"]);
        $aLatest = $latest->toList();

        $oLatest = $this->Functions->mergeToObjectKey($aLatest, "ORDRR_BKHGBNRINT");
        $aNoOrder = [];

        foreach($oAll as $k=>$v){
            if(!isset($oLatest->$k)){
                $aNoOrder[] = $v;
            }
        }

        foreach($aNoOrder as $k => $ledger){
            $aNoOrder[$k]->image = $this->Media->getCategoryImage($ledger->BKHGBNR);
        }

        return $aNoOrder;

    }

    public function getCrosssell(){
        $this->loadModel("Article");
        $this->loadModel("Ledger");
        $this->loadModel("OrderLine");
        $aGBs = unserialize(HD_ARRAY_EXCLUDE_GB);

        // ALLEMAAL
        $ledger = $this->Ledger->find()->where(["BKHGBNR LIKE" => '8%', "BKHGBNR NOT IN" => $aGBs], ["BKHGBNR" => "string"])->order(["BKHGBNR"])->all();
        $oAll = $this->Functions->mergeToObjectKey($ledger, "BKHGBNRINT");

        // VERKOCHT LAATSTE JAAR
        $latest = $this->OrderLine->query();
        $latest
            ->select(["ORDRR_BKHGBNRINT"])
            ->contain(["Order"])
            ->where([
                "ORDRR_BKHGBNRINT <>" => "",
                "Order.ORDOR_BKHADNRINT" => $this->m_iPartner,
                "Order.ORDORDATUM >=" => date('Y-m-d', strtotime("-1 years"))
            ])
            ->group(["ORDRR_BKHGBNRINT"]);
        $aLatest = $latest->toList();

        $oLatest = $this->Functions->mergeToObjectKey($aLatest, "ORDRR_BKHGBNRINT");
        $aNoOrder = [];

        foreach($oAll as $k=>$v){
            if(!isset($oLatest->$k)){
                $aNoOrder[] = $v;
            }
        }

        $aList = [];

        foreach($aNoOrder as $order){
            //if($order->BKHGBNR >= 8001 && $order->BKHGBNR <= 8007) {
                $a = $this->Article->find()->contain(["OrdArtikel"])->where(["BKHAR_BKHGBNRINT_VF" => $order->BKHGBNRINT, "BKHARVOORRAAD" => 1, "ORDARWEBSHOP" => 1]);
                $count = $a->count();
                $i = rand(0, $count - 1);
                $a = $a->skip($i)->first();
                @$a->BKHGBNR = $order->BKHGBNR;
                @$a->BKHGBOMS = $order->BKHGBOMS;
                @$a->image = $this->Media->getProductImage($a->BKHARCODE, $order->BKHGBNR);
                $aList[] = $a;
            //}
        }
        unset($a);

        $i = rand(0, count($aList)-1);
        $a[] = $aList[$i];

        return $a;

    }

}
?>