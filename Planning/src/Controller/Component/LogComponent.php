<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use App\Controller;

class LogComponent extends Component
{
    public $components = ['DatabaseHelper'];

    public function createLogEntry($p_sOrderNrint, $p_sType, $p_sTitle, $sMessage, $sEmployee, $iOrderTable = 0, $sEndDate = ""){

        $a["id"] = 0;
        $a["order_nrint"] = $p_sOrderNrint;
        $a["order_type"] = 0;
        $a["log_type"] = $p_sType;
        $a["log_title"] = $p_sTitle;
        $a["log_remark"] = $sMessage;
        $a["log_order_table"] = $iOrderTable;
        $a["log_enddate"] = $sEndDate;
        $a["medewerker"] = $sEmployee;

        //$this->loadComponent('DatabaseHelper');
        $this->DatabaseHelper->save('HdIntPrplLog', $a);

    }
}
?>