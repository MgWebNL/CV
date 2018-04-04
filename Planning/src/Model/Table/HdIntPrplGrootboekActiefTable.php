<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplGrootboekActiefTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_grootboek_actief');
        $this->primaryKey('id');
    }


}

?>