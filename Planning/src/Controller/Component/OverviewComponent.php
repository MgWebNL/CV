<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use App\Controller;
use DateTime;

class OverviewComponent extends Component
{
    public function loadModel($p_sTableName){
        $this->$p_sTableName = TableRegistry::get($p_sTableName);
    }

    public function getOrdersSend(){

        $aPost = $this->request->data();

        if(isset($_POST['from'])) {

            $oDate = new DateTime();

            // BEPAAL DATUMINTERVAL
            if (isset($aPost['today'])) {
                $sStartDate = $oDate->format('Y-m-d');
                $sEndDate = $oDate->format('Y-m-d');
                $sPeriode = "Vandaag";
                unset($aPost['from']);
                unset($aPost['to']);
            } elseif (isset($aPost['yesterday'])) {
                $sStartDate = $oDate->modify("-1 day")->format('Y-m-d');
                $sEndDate = $oDate->format('Y-m-d');
                $sPeriode = "Gisteren";
                unset($aPost['from']);
                unset($aPost['to']);
            } elseif (isset($aPost['week'])) {
                $sStartDate = $oDate->modify("monday this week")->format('Y-m-d');
                $sEndDate = $oDate->modify("friday this week")->format('Y-m-d');
                $sPeriode = "Deze week";
                unset($aPost['from']);
                unset($aPost['to']);
            } elseif (isset($aPost['month'])) {
                $sStartDate = $oDate->modify("first day of this month")->format('Y-m-d');
                $sEndDate = $oDate->modify("last day of this month")->format('Y-m-d');
                $sPeriode = "Deze maand";
                unset($aPost['from']);
                unset($aPost['to']);
            } elseif (isset($aPost['thisyear'])) {
                $sStartDate = date('Y-01-01');
                $sEndDate = date('Y-12-01');
                $sPeriode = "Dit jaar";
                unset($aPost['from']);
                unset($aPost['to']);
            } else {
                $oDate1 = new DateTime(date('Y-m-d', strtotime($aPost['from'])));
                $oDate2 = new DateTime(date('Y-m-d', strtotime($aPost['to'])));
                $sStartDate = $oDate1->format('Y-m-d');
                $sEndDate = $oDate2->format('Y-m-d');
                $sPeriode = "Van " . $oDate1->format('d-m-Y') . " t/m " . $oDate2->format('d-m-Y');
            }
        }else {
            $oDate = new DateTime();
            $sStartDate = $oDate->format('Y-m-d');
            $sEndDate = $oDate->format('Y-m-d');
            $sPeriode = "Vandaag";
        }


        $this->loadModel("HdIntPrplPartialDelivery");
        $a = $this->HdIntPrplPartialDelivery->find('all')
            ->select([
                "BKHORNR" => "HdIntPrplViewItem.order_nr",
                "BKHADNAAM" => "HdIntPrplViewItem.adres_name",
                "id" => "HdIntPrplPackaging.id",
                "BKHADCODE" => "HdIntPrplViewItem.adres_code",
                "BKHGBNR" => "HdIntPrplViewItem.ledger_code",
                "BKHGBOMS" => "HdIntPrplViewItem.ledger_name",
                "quantity_send",
                "send_date",
                "order_nrint"
            ])
            ->contain(["HdIntPrplPackaging.FRbkhADRES", "HdIntPrplViewItem"])
            ->where(["send_date >=" => $sStartDate, "send_date <=" => $sEndDate])
            ->where(["quantity_send > 1"])
            ->where(["HdIntPrplViewItem.order_nr >" => 0]);

        if(isset($aPost['product']) && $aPost['product'] != "0"){
            $a->where(["HdIntPrplViewItem.ledger_code" => $aPost['product']]);
        }
        if(isset($aPost['company']) && $aPost['company'] != "0"){
            $a->where(["FRbkhADRES.BKHADNRINT" => $aPost['company']]);
        }

//        $oDB = DB::getInstance();
//        $a = $oDB->selectListSQL($sQuery);

        $aRes = array('total' => 0);

        foreach($a as $aa){
            $aRes[] = $aa;
            $aRes["total"] += $aa["quantity_send"];
        }

        return $aRes;

    }

    public function getPerformance(){

        $aRes = array();

        $sLastYear = new DateTime('-1 year');

        // NIEUWE DATA -- MIKE (2016-01-15)
        //$sQuery = "SELECT ORDER_NRINT, certification_date FROM prepress WHERE prepress_finished = '1' AND certification_date >= '".$sLastYear."'";
        $this->loadModel('HdIntPrplPackaging');
        $this->loadModel('HdIntPrplPrepress');
        $this->loadModel('HdIntPrplViewItem');

        $aPrePress = $this->HdIntPrplPackaging->find('all')->where(["done_date >=" => $sLastYear, "done_date <>" => "0000-00-00"])->all();

        $allPrepress = $this->HdIntPrplPrepress->find('all')->all();
        foreach($allPrepress as $a){
            $aPackagingKey[$a->order_nrint] = $a;
        }

        $allOrders =  $this->HdIntPrplViewItem->find('all')->select(["orderrule_id"])->all();
        foreach($allOrders as $a){
            $aOrderKey[$a->orderrule_id] = $a;
        }

        foreach($aPrePress as $aOrder){
            $aPackaging = @$aPackagingKey[$aOrder->order_nrint];
//            //$sQuery = "SELECT orderreturn_date FROM packaging WHERE packaging_finished = '1' AND ORDER_NRINT = '".$aOrder['ORDER_NRINT']."'";
//            $sQuery = "SELECT certification_date FROM prepress WHERE prepress_finished = '1' AND ORDER_NRINT = '".$aOrder['ORDER_NRINT']."'";
//            $aPackaging = $oDB->selectSQL($sQuery);

            if($aPackaging && $aPackaging->prepress_done_date > "0000-00-00" && $aOrder["done_date"] > "0000-00-00"){
                $oDateTime1 = new Time($aOrder->done_date);
                $oDateTime2 = new Time($aPackaging['prepress_done_date']);

                $iDays = $oDateTime1->diff($oDateTime2);

                $aData = @$aOrderKey[$aOrder->order_nrint];
                if($aData != null) {
                    $res["totaal"][] = $iDays->format('%a');
                    $res[$oDateTime1->format("Y-m")][] = $iDays->format('%a');
                }

            }
        }

        if($res){
            ksort($res);
            foreach($res as $k=>$r){
                $aRes[$k]['sum'] = array_sum($r);
                $aRes[$k]['count'] = count($r);
                $aRes[$k]['avg'] = round(array_sum($r)/count($r));
                foreach($r as $a) {
                    if ($a > 49) {
                        @$aRes[$k][3]++;
                    } elseif ($a <= 42) {
                        @$aRes[$k][2]++;
                    } else {
                        @$aRes[$k][1]++;
                    }
                }
            }
        }

        return $aRes;

    }


    public function getPerformanceByPeriod($p_sPeriod){
        $aRes = array();
        $this->loadModel("HdIntPrplPrepress");
        $this->loadModel("HdIntPrplPackaging");
        $this->loadModel("HdIntPrplViewItem");

        if($p_sPeriod == "totaal"){
            $sLastYear = new Time('-1 year');
            //$aPrePress = $this->Prepress->find('all')->where(["prepress_done_date >= " => $sLastYear])->order(["prepress_done_date"])->all();
            $aPrePress = $this->HdIntPrplPackaging->find('all')->where(["done_date >= " => $sLastYear])->order(["done_date"])->all();
        }else{
            //$aPrePress = $this->Prepress->find('all')->where(["prepress_done_date LIKE " => $p_sPeriod."%"])->order(["prepress_done_date"])->all();
            $aPrePress = $this->HdIntPrplPackaging->find('all')->where(["done_date LIKE " => $p_sPeriod."%"])->order(["done_date"])->all();
        }

        //$allPackaging = $this->HdPackaging->find('all')->all();
        $allPackaging = $this->HdIntPrplPrepress->find('all')->all();
        foreach($allPackaging as $a){
            $aPackagingKey[$a->order_nrint] = $a;
        }

        $allOrders =  $this->HdIntPrplViewItem->find('all')->select(["order_nrint" => "orderrule_id", "BKHORNR" => "order_nr", "BKHADNAAM" => "adres_name", "BKHMOAANTAL" => "orderrule_quantity"])->all();
        foreach($allOrders as $a){
            $aOrderKey[$a->order_nrint] = $a;
        }

        foreach($aPrePress as $aOrder){
//            $sQuery = "SELECT orderreturn_date FROM packaging WHERE packaging_finished = '1' AND ORDER_NRINT = '".$aOrder['ORDER_NRINT']."'";
//            $aPackaging = $oDB->selectSQL($sQuery);
            $aPackaging = @$aPackagingKey[$aOrder->order_nrint];

            if($aPackaging != null && $aPackaging->prepress_done_date > "0000-00-00"){
                $oDateTime1 = new Time($aOrder['prepress_done_date']);
                $oDateTime2 = new Time($aPackaging['done_date']);
                $oDateTime1 = new Time($aOrder['done_date']);
                $oDateTime2 = new Time($aPackaging['prepress_done_date']);
                $iDays = $oDateTime1->diff($oDateTime2);

                $aData = @$aOrderKey[$aOrder->order_nrint];

                if($aData != null) {
                    $order['id'] = $aOrder['order_nrint'];
                    $order['ordernumber'] = $aData['BKHORNR'];
                    $order['customer'] = $aData['BKHADNAAM'];
                    $order['quantity'] = $aData['BKHMOAANTAL'];
                    $order['certification_date'] = $aPackaging['prepress_done_date'];
                    $order['orderreturn_date'] = $aOrder['done_date'];
                    $order['avg'] = $iDays->format('%a');

                    $aRes[] = $order;
                }

            }
        }

        return $aRes;
    }
}
?>