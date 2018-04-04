<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class CrossCartTable extends Table
{

    public static function defaultConnectionName() {
        return "HodiOnline";
    }

    public function initialize(array $config)
    {
        $this->table('cart');
        $this->primaryKey('id');

        $this->hasOne('Article', [
            'propertyName' => 'Article',
            'foreignKey' => 'BKHARNRINT',
            'bindingKey' => 'article_code',
            'joinType' => 'LEFT',
        ]);
    }


    public function getCartBySessionId($p_sSessionId){

        $this->Article = TableRegistry::get('Article');

        $cart = $this->find('all')
            ->where(["session_id" => $p_sSessionId])
            ->all();

        foreach($cart as $item){
            $article = $this->Article->find('all')
                        ->where(["BKHARCODE" => $item->article_code])
                        ->first();
            $item->Article = $article;
        }

        return $cart;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
    }

}

?>