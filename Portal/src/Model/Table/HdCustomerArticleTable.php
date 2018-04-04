<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class HdCustomerArticleTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_articlecustomernumber');
        $this->primaryKey('FRbkhADRES_ADNRINT');

    }




    public function getArticle($p_sArticleNrint, $p_sCustomerNrint){
        return $this->find('all')
            ->where([
                "article_nrint" => $p_sArticleNrint,
                "address_nrint" => $p_sCustomerNrint
            ])
            ->first();
    }

    public function getArticles($p_sCustomerNrint){
        $a = $this->find('all')
            ->where([
                "address_nrint" => $p_sCustomerNrint
            ])
            ->all();

        $aReturn = [];
        foreach($a as $aa){
            $aReturn[$aa->article_nrint] = $aa;
        }

        return $aReturn;
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