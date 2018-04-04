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
use Cake\Log\Log;

class LogHodiComponent extends Component
{

    public $components = ["DatabaseHelper"];

    public function log($p_iAction = 0){

        $browser = get_browser(null, true);
        $msg = "\r\n\t\tCustomerNrint: ".$this->request->session()->read('customerlogin')["customer_nrint"]."\r\n\t\tURL: ".$this->request->here()."\r\n\t\tIP: ".$this->request->ClientIp()."\r\n\t\tBrowser: ".$browser['browser']." ~".$browser['version']." (".$browser["browser"].")\r\n\t\tOS: ".$browser["platform"];

        Log::info($msg, ["scope" => ["browserInfo"]]);
        if($_SERVER['REMOTE_ADDR'] != '92.71.254.146') {
            Log::info($msg, ["scope" => ["customerInfo"]]);
        }else{
            Log::info($msg, ["scope" => ["hodiInfo"]]);
        }

        $a["id"] = 0;
        $a["datetime"] = date('Y-m-d H:i:s');
        $a["FRbkhADRES_NRINT"] = $this->request->session()->read('customerlogin')["customer_nrint"];
        $a["emailaddress"] = $this->request->session()->read('customerlogin')["customer_user_email"];
        $a["ipaddress"] = $this->request->ClientIp();
        $a["url"] = "https://www.hodi-portal.nl".$this->request->here();
        $a["action"] = $p_iAction;

        $this->DatabaseHelper->save("hdLog", $a);



    }

}
?>