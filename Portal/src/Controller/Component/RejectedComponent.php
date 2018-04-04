<?php
/**
 * Created by PhpStorm.
 * User: Ruud
 * Date: 13-7-2017
 * Time: 09:40
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class RejectedComponent extends Component
{

    /**
     * @param $p_sModelname
     * START ELK COMPONENT MET DEZE FUNCTIE !!
     */
    public function loadModel($p_sModelname){
        $this->$p_sModelname = TableRegistry::get($p_sModelname);
    }

    /**
     * @param $p_iOrderID
     * @param $p_sNrInt
     * @param int $p_iAfterDays
     */
    public function rejectOrder($p_iOrderID, $p_sNrInt, $p_iAfterDays = 0){

        $this->loadModel('Invoice');
        $aInvoice = $this->Invoice->getDueInvoices($p_sNrInt, $p_iAfterDays);

        if(count((array)$aInvoice) > 0 && $p_iOrderID > 0){
            $a = new \stdClass();
            $oDate = new Time();

            $a->downloaded = 2;
            $a->rejected = 1;
            $a->rejected_date = $oDate->format('Y-m-d H:i:s');

            $this->loadModel('TempOrders');
            $id = $this->TempOrders->updateTempOrder($p_iOrderID, $a);
        }
    }
    
}
?>