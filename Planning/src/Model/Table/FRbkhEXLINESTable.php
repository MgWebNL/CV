<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FRbkhEXLINESTable extends Table
{

    public $m_sFCS = 'PGZIAATL';
    public $m_sWEBSTICK = 'PVGA1RN1';

    public function initialize(array $config)
    {
        $this->table('FRbkhEXLINES');
        $this->primaryKey('BKHXLNRINT');
    }

    public function checkStickerWebsite($p_sNrint){
        $a = $this->find()
            ->where([
                "BKHXL_BKHADNRINT" => $p_sNrint,
                "BKHXL_BKHXVNRINT" => $this->m_sWEBSTICK
            ])
            ->first();

        return isset($a->BKHXL_BOOLEAN) &&$a->BKHXL_BOOLEAN  == 1 ? 1 : 0;
    }

}

?>