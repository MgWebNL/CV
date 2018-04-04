<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class SearchController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function processSearchRequest(){

        if($this->request->is('post')){
            $this->loadModel('Search');
            $token = $this->setSearchResult($this->m_iPartner, $this->m_sUser, $this->request->data["keywords"]);
            return $this->redirect('/Search/results/'.$token);
        }
    }


    private function setSearchResult($p_sCustomerNrint, $p_sUserNrint, $p_sKeywords){
        $this->loadComponent('DatabaseHelper');
        $a["id"] = 0;
        $a["customer_nrint"] = $p_sCustomerNrint;
        $a["user_nrint"] = $p_sUserNrint;
        $a["keywords"] = $p_sKeywords;
        $a["url_token"] = md5($p_sCustomerNrint.$p_sUserNrint.$p_sKeywords.time());
        $this->DatabaseHelper->save('Search', $a);
        return $a["url_token"];
    }


    public function results($p_sToken){
        $this->loadModel("Search");
        $aResults = $this->Search->getSearchResult($p_sToken, $this->m_iPartner);
        if($aResults['count'] > 0){
            // SAVE RESULT == TRUE
            $this->Search->markResultTrue($aResults["basics"]["url_token"]);

            if(isset($aResults['results']['article'])){
                $this->loadComponent("ArticleHelper");
                $this->ArticleHelper->truncateArticleDescription($aResults['results']['article']);
            }
        }
        $this->set("aResults", $aResults);
        $this->set("sToken", $aResults["basics"]["url_token"]);
    }

    public function gotoResult($p_sType, $p_sNrint, $p_sToken){
        $this->loadModel("Search");
        // SAVE CLICK !!
        $this->Search->markResultUsed($p_sToken);
        return $this->redirect("/$p_sType/view/$p_sNrint");
    }

}
