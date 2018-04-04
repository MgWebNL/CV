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

class CSVComponent extends Component
{
    public $m_aDataList = array();
    public $m_aColumns = array();
    public $m_sFileName = "Export";

    public $components = ['Functions'];


    public function initialize(array $config){
        $p_aDataList = json_decode(json_encode($config["data"]), true);
        reset($p_aDataList);
        $this->m_aDataList = $p_aDataList;
        //var_dump($this->m_aDataList);
    }

    public function addFilter($p_ColumnName, $sOperator, $sValue){
        $sOperator = ($sOperator == '=') ? "==" : $sOperator;

        foreach($this->m_aDataList as $row){
            if(isset($row[$p_ColumnName]) && eval("return $row[$p_ColumnName] $sOperator $sValue;")){
                //echo $row[$p_ColumnName] . $sOperator . $sValue."<br />";
                $this->m_aFilterList[] = $row;
            }
        }
    }

    public function orderBy($p_ColumnName, $sSort){
        $this->m_aOrderBy = array("column" => $p_ColumnName, "sort" => $sSort);
    }

    public function addColumn($p_ColumnNameTable, $p_ColumnNameCSV, $p_sType = ""){
        $iFirst = key(array_slice( $this->m_aDataList, 0, 1, TRUE ));

        foreach($this->m_aDataList[$iFirst] as $k => $v){
            if($k == $p_ColumnNameTable){
                $this->m_aColumns[] = array("table" => $p_ColumnNameTable,"csv" => $p_ColumnNameCSV, "type" => $p_sType);
                break;
            }

        }
    }

    public function setFileName($p_sFileName){
        $this->m_sFileName = $p_sFileName;
    }

    private function gettype_fromstring($string){
        //  (c) José Moreira - Microdual (www.microdual.com)
        return gettype($this->getcorrectvariable($string));
    }

    private function getcorrectvariable($string){
        //  (c) José Moreira - Microdual (www.microdual.com)
        //      With the help of Svisstack (http://stackoverflow.com/users/283564/svisstack)

        /* FUNCTION FLOW */
        // *1. Remove unused spaces
        // *2. Check if it is empty, if yes, return blank string
        // *3. Check if it is numeric
        // *4. If numeric, this may be a integer or double, must compare this values.
        // *5. If string, try parse to bool.
        // *6. If not, this is string.

        $string=trim($string);
        if(empty($string)) return "";
        if(!preg_match("/[^0-9.,]+/",$string)){
            if(preg_match("/[.,]+/",$string)){
                return (double)$string;
            }else{
                return (int)$string;
            }
        }
        if($string=="true") return true;
        if($string=="false") return false;
        return (string)$string;
    }

    private function autodetectFormat($p_sValue, $p_sType = ""){
        // echo $this->gettype_fromstring($p_sValue).": $p_sValue<br />";
        $sCheckVal = $p_sType == "" ? $this->gettype_fromstring($p_sValue) : $p_sType;

        switch($sCheckVal){
            case "double":
                return number_format(doubleval($p_sValue),4,",","");
                break;

            case "string":
                return preg_replace(array('/[^a-zA-Z0-9.,-]/'),array(' '), $p_sValue);
                break;

            case "string_exact":
                return str_replace(".", "_", preg_replace(array('/[^a-zA-Z0-9.,-]/', '/[ -]+/', '/^-|-$/'),array('', '-', ''), $p_sValue));
                break;

            default:
                return $p_sValue;
                break;
        }
    }

    public function makeCSV(){


        $csv = "";
        //var_dump($this->m_aFilterList);
        // PRINT HEADERS
        foreach($this->m_aColumns as $col){
            $csv .= $col['csv'].";";
        }
        $csv .= "\r\n";

        // PRINT DATA
        if(isset($this->m_aFilterList)){
            $this->m_aDataList = $this->m_aFilterList;
        }

        if(isset($this->m_aOrderBy)){
            $oFunctions = $this->Functions();
            $oFunctions->aasort($this->m_aDataList, $this->m_aOrderBy['column'], $this->m_aOrderBy['sort']);
        }

        foreach($this->m_aDataList as $row){
            foreach($this->m_aColumns as $col){
                //$csv .= $row[$col['table']].";";
                $csv .= $this->autodetectFormat($row[$col['table']], $col["type"]).";";
            }
            //echo "<hr />";
            $csv .= "\r\n";
        }

        header('Content-Type: application/csv;charset=iso-8851-2');
        header('Content-Disposition: attachement; filename="'.$this->m_sFileName.'_'.date("YmdHis").'.csv"');
        echo $csv;
        //header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>