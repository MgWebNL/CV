<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use App\Controller;

class AnnouncementComponent extends Component
{
    public $components = ['DatabaseHelper'];

    public function makeOrderAnnouncement($p_sOrderNrint, $p_sTitle, $p_sMessage,  $p_sCurrentUser, $p_bEmployeeOnly = 0){

        $oOrders = TableRegistry::get('Orders');
        $aOrder = $oOrders->query();
        $aOrder->find("all")->where(["order_nrint" => $p_sOrderNrint])->first();

        // GET DATA FOR ANNOUNCEMENT
        $a["id"] = 0;
        $a["order_nrint"] = $p_sOrderNrint;
        $a["ann_title"] = $p_sTitle;
        $a["ann_msg"] = $p_sMessage;
        $a["ann_from"] = $p_sCurrentUser;
        if(!isset($aOrder->ADVMWNRINT) || $aOrder->ADVMWNRINT == "" || $p_bEmployeeOnly == 0){
            $a["ann_to"] = "Hodi International";
            $a["ann_to_nrint"] = "";
        }else{
            $a["ann_to"] = $aOrder->ADVMWNAAM;
            $a["ann_to_nrint"] = $aOrder->ADVMWNRINT;
        }

        $this->DatabaseHelper->save("HdAnnouncement", $a);


    }

    public function getAnnouncementList($p_sUnreadOnly = 0, $p_sEmpNrint = null){

        $array = array("");

        if(!is_null($p_sEmpNrint)){
            $array[] = $p_sEmpNrint;
        }

        $this->TableName = TableRegistry::get("HdAnnouncement");

        $query = $this->TableName->query();

        $a = $query->find("all")->contain(["Orders"])->where(["ann_to_nrint IN" => $array])->order(["HdAnnouncement.id" => "desc"]);
        if($p_sUnreadOnly == 1){
            $a->andWhere(["ann_read" => 0]);
        }

        return $a;


    }
}
?>