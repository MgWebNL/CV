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

class IPComponent extends Component
{

    /***************************************************************************************
    This is a simple PHP script to lookup for blacklisted IP against multiple DNSBLs at once.

    You are free to use the script, modify it, and/or redistribute the files as you wish.

    Homepage: http://dnsbllookup.com
     ****************************************************************************************/
    public function flush_buffers(){
        ob_end_flush();
        flush();
        ob_start();
    }

    public function dnsbllookup($host, $ip)
    {
        ini_set('max_execution_time', 1);
        set_time_limit(1);
        if($ip)
        {
            $reverse_ip = implode(".", array_reverse(explode(".", $ip)));
            if (checkdnsrr($reverse_ip . "." . $host . ".", "A")) {
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    public function lookup($ip)
    {
        $start = time();
        if (preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/", $ip) == true) {
            $this->dnsbllookup($ip);
        }
        echo time() - $start;
    }


    public function ping ($host, $timeout = 1) {
        /* ICMP ping packet with a pre-calculated checksum */
        $result = 0;
        $package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
        $socket = @socket_create(AF_INET, SOCK_RAW, 1);
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout, 'usec' => 0));
        @socket_connect($socket, $host, null);
        $ts = microtime(true);
        @socket_send($socket, $package, strLen($package), 0);
        if (@socket_read($socket, 255)) {
            $result = microtime(true) - $ts;
        } else {
            $result = false;
        }
        @socket_close($socket);

        if($result == 0 || $result >= $timeout){
            return false;
        }else{
            return true;
        }

    }
}
?>