<?php
namespace App\View\Helper;

use Cake\View\Helper;

class SubcountHelper extends Helper
{
    public function makeSubCount($aArray, $sKey, $sValue, $iAll = 0, $sSubkey = "")
    {
        // RETURN TOTAL
        if($iAll != 0){
            return count($aArray);
        }

        // RETURN SUBSET OF ARRAY
        else{
            $i = 0; // Define counter, value is 0

            foreach($aArray as $a){
                $subKey = $sSubkey == "" ? $a : $a[$sSubkey];

                //var_dump($subKey); die();

                if(isset($subKey[$sKey]) && $subKey[$sKey] == $sValue){
                    $i++; // If criteria match, add 1
                }
            }

            return $i;
        }

    }

    public function makeSubSum($aArray, $sKey, $sValue, $sSumKey, $iAll = 0, $sSubkeySearch = "", $sSubkeySum = "")
    {
        // RETURN TOTAL
        if($iAll != 0){

            $i = 0; // Define counter, value is 0
            foreach($aArray as $a){

                $subKeySearch = $sSubkeySearch == "" ? $a : $a[$sSubkeySearch];
                $subKeySum = $sSubkeySum == "" ? $a : $a[$sSubkeySum];

                if(isset($subKeySearch[$sKey])){
                    $i+=$subKeySum[$sSumKey]; // If criteria match, add 1
                }
            }

            return $i;
        }

        // RETURN SUBSET OF ARRAY
        else{
            $i = 0; // Define counter, value is 0

            foreach($aArray as $a){

                $subKeySearch = $sSubkeySearch == "" ? $a : $a[$sSubkeySearch];
                $subKeySum = $sSubkeySum == "" ? $a : $a[$sSubkeySum];

                if(isset($subKeySearch[$sKey]) && $subKeySearch[$sKey] == $sValue){
                    $i+=$subKeySum[$sSumKey]; // If criteria match, add 1
                }
            }

            return $i;
        }

    }

    public function makeSubSet($aArray, $sKey, $sValue, $iAll = 0, $sSubkey = "")
    {
        // RETURN TOTAL
        if($iAll != 0){
            return $aArray;
        }

        // RETURN SUBSET OF ARRAY
        else{
            $aRet = array(); // Define counter, value is empty

            foreach($aArray as $a){

                $subKey = $sSubkey == "" ? $a : $a[$sSubkey];

                if(isset($subKey[$sKey]) && $subKey[$sKey] == $sValue){
                    $aRet[] = $a; // If criteria match, add row
                }
            }

            return $aRet;
        }

    }
}
?>