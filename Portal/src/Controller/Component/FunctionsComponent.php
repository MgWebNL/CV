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

    public function array_sort_by_column($arr, $col, $dir = 'asc') {
        $aSort = [];
        $temp = [];
        foreach($arr as $v){
            $temp[$v[$col]][] = $v;
        }
        ksort($temp);
        foreach($temp as $a){
            foreach($a as $v){
                $aSort[] = $v;
            }
        }
        return $aSort;
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
            case "in_array":
                return in_array($var1, $var2);

            default:
                return true;
        }

    }

    public function array_to_object($array) {
        $resultObj = new \stdClass;
        $resultArr = array();
        $hasIntKeys = false;
        $hasStrKeys = false;
        foreach ( $array as $k => $v ) {
            if ( !$hasIntKeys ) {
                $hasIntKeys = is_int( $k );
            }
            if ( !$hasStrKeys ) {
                $hasStrKeys = is_string( $k );
            }
            if ( $hasIntKeys && $hasStrKeys ) {
                $e = new \Exception( 'Current level has both integer and string keys, thus it is impossible to keep array or convert to object' );
                $e->vars = array( 'level' => $array );
                throw $e;
            }
            if ( $hasStrKeys ) {
                $resultObj->{$k} = is_array( $v ) ? $this->array_to_object( $v ) : $v;
            } else {
                $resultArr[$k] = is_array( $v ) ? $this->array_to_object( $v ) : $v;
            }
        }
        return ($hasStrKeys) ? $resultObj : $resultArr;
    }

    public function groupByObjectKey($p_oData, $p_sKey){
        $oReturn = new \stdClass();
        foreach($p_oData as $k => $row){
            $key = $row->$p_sKey;
            if($key != '') {
                $oReturn->$key = new \stdClass();
            }
        }

        foreach($p_oData as $k => $row){
            $key = $row->$p_sKey;
            if($key != '') {
                $oReturn->$key->$k = $row;
            }
        }

        return $oReturn;
    }

    public function mergeToObjectKey($p_oData, $p_sKey){
        $oReturn = new \stdClass();
        foreach($p_oData as $k => $row){
            $key = $row->$p_sKey;
            $oReturn->$key = $row;
        }
        return $oReturn;
    }

    public function getKey($p_aArrayObject, $p_iKeyNumber){
        $i = 1;
        foreach($p_aArrayObject as $k => $v){
            if($i == $p_iKeyNumber){
                return $k;
            }
            $i++;
        }
    }
}
?>