<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FRbkhLANDTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhLAND');
        $this->primaryKey('BKHLANRINT');
    }
}

?>