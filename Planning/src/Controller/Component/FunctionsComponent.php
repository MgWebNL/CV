<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 24-6-2016
 * Time: 09:40
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class FunctionsComponent extends Component
{

    public function arrayToTable($p_aArray){
        $r = "<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" width='100%'>";

        // CHECK FOR HEADER
        if(isset($p_aArray["header"])){
            $r .= '<thead><tr style="background-color: #D52824; color: #FFF;">';
            foreach($p_aArray["header"] as $k => $row) {
                $sAttr = "";
                if(is_array($row)){ $v = $k; $attr = $row; }else{ $v = $row; $attr = []; }
                foreach($attr as $a => $vv){ $sAttr .= $a.'="'.$vv.'" '; }
                    $r .= '<th '.trim($sAttr).'>'.$v.'</th>';
            }
            $r .= '</tr></thead>';
        }
        unset($p_aArray["header"]);

        $r .= '<tbody>';

        foreach($p_aArray as $line){
            $r .= '<tr>';
            foreach($line as $k => $row) {
                $sAttr = "";
                if(is_array($row)){ $v = $k; $attr = $row; }else{ $v = $row; $attr = []; }
                foreach($attr as $a => $vv){ $sAttr .= $a.'="'.$vv.'" '; }
                $r .= '<td '.trim($sAttr).'>'.$v.'</td>';
            }
            $r .= '</tr>';
        }
        $r .= "</tbody></table>";

        return $r;
    }



    /**
     * functions::replaceString()
     *
     * @param mixed $p_sString
     * @return string
     */
    public function replaceString($p_sString){
        $aSearch =  array("'");
        $aReplace = array("\'");

        return str_replace($aSearch, $aReplace, $p_sString);
    }

    /**
     * functions::stringToArray()
     *
     * @param mixed $p_sValue
     * @return array
     */
    public function stringToArray($p_sValue){
        $b = array();
        $a = explode(",", $p_sValue);
        $i = 0;
        foreach($a as $v){
            if(!empty($v)){
                $b[$i] = $v;
                $i++;
            }
        }
        return $b;
    }

    /**
     * functions::arrayToString()
     *
     * @param mixed $p_aValue
     * @return String
     */
    public function arrayToString($p_aValue){
        $s = "";
        foreach($p_aValue as $v){
            $s .= $v.",";
        }
        return $s;
    }

    /**
     * Functions::switchStrings()
     *
     * @param mixed $p_iValue
     * @param mixed $p_aValue
     * @return String
     */
    public function switchStrings($p_sValue, $p_aValue){
        $s = "";

        foreach($p_aValue as $k => $v){
            switch ($p_sValue){
                case $k:
                    $s = $v;
                    break;
            }
        }
        return $s;
    }

    /**
     * Functions::convertNbreakToBreak()
     *
     * @param mixed $p_aValue
     * @param mixed $p_sColumn
     * @return multi array   Converteer \n en \r naar <br />
     */
    public function convertNbreakToBreak($p_aValue, $p_sColumn){
        $a = array();
        $i = 0;
        foreach($p_aValue as $c){
            $a[$i] = $c;
            $a[$i][$p_sColumn] = str_replace(array("\r", "\n"), '<br />', $c[$p_sColumn]);
            $i++;
        }
        return $a;
    }

    public function array_sort_by_column($arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);

        //return $sort_col;
    }

    /**
     * @param $array
     * @param $key
     * @param string $sort
     */
    public function aasort (&$array, $key, $sort = 'asc') {
        $sorter=array();
        $ret=array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }

        if($sort == 'asc'){
            asort($sorter);
        }else{
            arsort($sorter);
        }

        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        $array=$ret;
    }

    /**
     * Functions::in_array_r()
     *
     * Zoeken in een multidimensionel array
     *
     * @param mixed $needle
     * @param mixed $haystack
     * @return bool
     */
    public function in_array_r($needle, $haystack) {
        $found = false;
        foreach ($haystack as $item) {
            if ($item === $needle) {
                $found = true;
                break;
            } elseif (is_array($item)) {
                $found = $this->in_array_r($needle, $item);
                if($found) {
                    break;
                }
            }
        }
        return $found;
    }

    /**
     * Functions::calculatePercentage()
     *
     * @param mixed $p_iValue1
     * @param mixed $p_iValue2
     * @return
     */
    public function calculatePercentage($p_iValue1, $p_iValue2){
        return ($p_iValue1 / $p_iValue2) * 100;
    }

    public function compareValues($p_iValue1, $p_iValue2, $p_sCompareType = 'max', $p_iNotNull = 0){

        if($p_iNotNull == 1){
            if($p_iValue1 == ""){
                return $p_iValue2;
            }elseif($p_iValue2 == ""){
                return $p_iValue1;
            }
        }

        $sRet = "";

        switch($p_sCompareType){
            case "max":
                $sRet = $p_iValue1 > $p_iValue2 ? $p_iValue1 : $p_iValue2;
                break;

            case "min":
                $sRet = $p_iValue1 > $p_iValue2 ? $p_iValue2 : $p_iValue1;
                break;
        }
        return $sRet;
    }

    public function filter_array(&$array, $key, $value, $operator = "=") {
        $ret=array();
        reset($array);
        foreach ($array as $va) {
            if($operator == "="){
                if(isset($va[$key]) && $va[$key] == $value){

                    $ret[]=$va;
                }
            }else{

                if(isset($va[$key]) && $this->filter_array_advanced($va[$key],$operator,$value)){
                    $ret[]=$va;
                }
            }

        }
        $array=$ret;
    }

    public function filter_array_sub(&$array, $subkey, $key, $value, $operator = "=") {
        $ret=array();
        reset($array);
        foreach ($array as $va) {
            if($operator == "="){
                if(isset($va[$subkey][$key]) && $va[$subkey][$key] == $value){

                    $ret[]=$va;
                }
            }else{

                if(isset($va[$subkey][$key]) && $this->filter_array_advanced($va[$subkey][$key],$operator,$value)){
                    $ret[]=$va;
                }
            }

        }
        $array=$ret;
    }

    public function filter_array_advanced($var1, $op, $var2) {

        switch ($op) {
            case "=":
                return $var1 == $var2;
            case "!=":
                return $var1 != $var2;
            case ">=":
                return $var1 >= $var2;
            case "<=":
                return $var1 <= $var2;
            case ">":
                return $var1 > $var2;
            case "<":
                return $var1 < $var2;
            case "in":
                return strpos($var1, $var2);
            default:
                return true;
        }

    }

    public function groupObjectByKey($p_oObject, $p_sKey, $p_aSubKeys = []){
        $oReturn = [];
        foreach($p_oObject as $item){
            $key = $item;
            foreach($p_aSubKeys as $subkey){
                $key = $key->$subkey;
            }
            $key = $key->$p_sKey;
            $oReturn[$key][] = $item;
        }
        ksort($oReturn);
        return $oReturn;
    }

    public function rebuildObjectToKey($p_oObject, $p_sKey, $p_aSubKeys = []){
        $oReturn = [];
        foreach($p_oObject as $item){
            $key = $item;
            foreach($p_aSubKeys as $subkey){
                $key = $key->$subkey;
            }
            $key = $key->$p_sKey;
            $oReturn[$key] = $item;
        }
        ksort($oReturn);
        return $oReturn;
    }

    public function groupByKey($p_aArray, $p_sKey, $p_iMulti = 0){
        $aReturn = [];
        foreach($p_aArray as $row){
            if($p_iMulti == 0) {
                $aReturn[$row->$p_sKey] = $row;
            }else{
                $aReturn[$row->$p_sKey][] = $row;
            }
        }
        return $aReturn;
    }
}
?>