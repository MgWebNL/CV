<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FRbkhARTIKELTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('FRbkhARTIKEL');
        $this->primaryKey('BKHARNRINT');
    }
}

?>