<?php

/**
 * @property HdViewItem $HdViewItem
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplNapkinsTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_napkins');
        $this->primaryKey('id');
    }

    public function getNapkinByNrint($p_sNrint){
        return $this->find()
            ->where(["napkin_article_nrint" => $p_sNrint])
            ->firstOrFail();
    }



}

?>