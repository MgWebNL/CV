<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class DatabaseHelperComponent extends Component
{
    public function save($p_sModelName, $p_aData)
    {
        $a = array();

        // EGALISEREN !!
        foreach($p_aData as $k => $aValue){
            if(is_array($aValue)){
                $value = implode(",", $aValue);
            }else{
                $value = $aValue;
            }
            $a[$k] = $value;
        }

        // SUBMIT UNSET
        unset($a["submit"]);

        // CHECK INSERT OF UPDATE
        if(!isset($a["id"]) || $a["id"] == 0){

            unset($a["id"]);

            // NIEUW RECORD !!
            foreach($a as $k => $v){
                $aKeys[] = $k;
                $aValues[$k] = addslashes($v);
            }

            $aKeys[] = "id";
            $aValues["id"] = 0;

            $this->TableName = TableRegistry::get($p_sModelName);

            $query = $this->TableName->query();
            //die($this->TableName->id);


            //debug($aKeys); die();

            $query->insert($aKeys)
                ->values($aValues)
                ->execute();

            $newID = $query->select(['id'])->order(["id" => "asc"])->last()->id;

            //debug($newID);

            return $newID;

        }else{

            $id = $a["id"];
            unset($a["id"]);

            // UPDATE RECORD !!
            $aSet = array();

            foreach($a as $k => $v){
                $aSet[] = "".$k." = '".addslashes($v)."'";
            }

            $sSet = implode(",", $aSet);

            $this->TableName = TableRegistry::get($p_sModelName);
            $query = $this->TableName->query();

            //debug($aKeys); die();

            $query->update()
                ->set([$sSet])
                ->where(['id' => $id])
                ->execute();

            return $id;
        }

    }

    public function delete($p_sModelName, $p_oConditions)
    {
        $this->TableName = TableRegistry::get($p_sModelName);

        $query = $this->TableName->query();
        //die($this->TableName->id);


        //debug($aKeys); die();

        $query->delete()
            ->where($p_oConditions)
            ->execute();

        return true;
    }

    public function checkRecord($p_sModelName, $p_sFieldName, $p_sFieldValue, $p_sReturnField = null)
    {
        $this->TableName = TableRegistry::get($p_sModelName);

        $query = $this->TableName->query();

        $a = $query->find("all")
            ->where([$p_sFieldName => $p_sFieldValue])
            ->first();

        if($query->count() > 0) {
            //var_dump($a->id); die();
            if($p_sReturnField !== null && !is_null($a->$p_sReturnField)){
                return $a->$p_sReturnField ;
            }else{
                return $a->$p_sFieldName ;
            }
        }else{
            return false;
        }

    }
}
?>