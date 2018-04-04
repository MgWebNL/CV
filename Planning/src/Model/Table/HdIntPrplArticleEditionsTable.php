<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class HdIntPrplArticleEditionsTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_int_prpl_article_editions');
        $this->primaryKey('id');
    }


    public function getEditions(){
        $edit = [];
        $aEdition = $this->find('all')->toArray();
        foreach($aEdition as $k => $v){
            $edit[$v->id] = $v;
        }
        return $edit;
    }
}

?>