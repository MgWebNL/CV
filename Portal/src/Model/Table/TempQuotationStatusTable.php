<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class TempQuotationStatusTable extends Table
{

    public $m_oList;
    public $m_aConditions = [];
    public $m_aStatus = [
        0 => ["text" => "Pending", "color" => "blue"],
        1 => ["text" => "Ordered", "color" => "green"],
        2 => ["text" => "Canceled", "color" => "red"],
        3 => ["text" => "Partial ordered", "color" => "green"],
    ];

    public function initialize(array $config)
    {
        $this->table('hd_temp_change_offerte_status');
        $this->primaryKey('id');
    }

    public function checkTempQuote($p_sQuoteNrint){
        $quotes = $this->find('all')->where(["offerte_id" => $p_sQuoteNrint]);
        if($quotes->count() > 0){
            return $quotes->first()->id;
        }
        return 0;
    }


}

?>