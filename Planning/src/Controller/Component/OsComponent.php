<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use App\Controller;

class OsComponent extends Component
{
    function getOS() {
        $user_agent     =   $_SERVER['HTTP_USER_AGENT'];
        $os_platform    =   "xxx";

        $os_array       =   array(
            '/windows/i'     =>  'win',
            '/macintosh|mac os x/i' =>  'mac',
            '/mac_powerpc/i'        =>  'mac',
        );
        //die($_SERVER["REMOTE_ADDR"]);
        if($_SERVER["REMOTE_ADDR"] == "92.71.254.146" || strpos($_SERVER["REMOTE_ADDR"],"192.168.16.") !== false){
            foreach ($os_array as $regex => $value) {
                if (preg_match($regex, $user_agent)) {
                    $os_platform    =   $value;
                }
            }
        }

        return $os_platform;

    }
}
?>