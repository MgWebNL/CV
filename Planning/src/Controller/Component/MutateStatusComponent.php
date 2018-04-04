<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use App\Controller;

class MutateStatusComponent extends Component
{
    public $components = ['DatabaseHelper', 'Log'];

    public function mutateOrderStatus($p_sOrderNrint, $sEmployee, $p_bMutateBack = 0, $p_iSteps = 1, $p_iForceStatus){

        $oOrders = TableRegistry::get('HdIntPrplGeneral');

        $aOrder = $oOrders->getByOrderLineId($p_sOrderNrint);

        $iNextStatusID = $p_iForceStatus;

        // BUILD SAVE ARRAY
        $a["id"] = $aOrder["id"];
        $a["general_status"] = $iNextStatusID;
        $a["general_status_date"] = date('Y-m-d');
        $this->DatabaseHelper->save('HdIntPrplGeneral', $a);
        unset($a);

        // CREATE LOG

        /** BIJ WIJZE VAN TEST UITGESCAKELD:: MG 2016-08-17 */
        //$this->Log->createLogEntry($p_sOrderNrint, 'general', 'Statuswijziging', 'Order verplaatst naar '.$aStatus["naam"], key($_SESSION['adminlogin']['name_user']));

    }
}
?>