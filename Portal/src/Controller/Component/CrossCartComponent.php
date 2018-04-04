<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 24-6-2016
 * Time: 09:40
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class CrossCartComponent extends Component
{

    public $components = ["DatabaseHelper", "ArticleHelper"];

    /**
     * @param $p_sModelname
     * START ELK COMPONENT MET DEZE FUNCTIE !!
     */
    public function loadModel($p_sModelname){
        $this->$p_sModelname = TableRegistry::get($p_sModelname);
    }

    public function add($p_iId, $p_iQty, $p_iPrice = false){
        $session = $this->request->session()->read("crosscart_id");
        $customer_nrint = $this->request->session()->read('customerlogin')["customer_nrint"];
        $this->loadModel("Article");



        if(is_int($p_iId) !== false){
            $this->loadModel('CrossArticle');
            $aArticleOnline = $this->CrossArticle->get($p_iId);
            $aArticle = $this->Article->find()->where(["BKHARCODE" => $aArticleOnline->product_code])->first();
        }else{
            $aArticle = $this->Article->get($p_iId);
        }
        $this->loadModel("ArticlePrice");
        if(!$row = $this->checkDuplicate($session, $aArticle->BKHARNRINT)) {
            $a["id"] = 0;
            $a["session_id"] = $session;
            $a["article_code"] = $aArticle->BKHARCODE;
            $a["article_name"] = $aArticle->BKHAROMS;
            $a["article_id"] = $aArticle->BKHARNRINT;
            $a["quantity"] = $p_iQty;
        }else{
            $a["id"] = $row->id;
            $a["quantity"] = $row->quantity + $p_iQty;

            $p_iPrice = ($row->article_price_force == 1) ? $row->article_price : false;
        }
        if($p_iPrice === false) {
            $a["article_price"] = $this->ArticleHelper->getArticlePriceByQuantity($aArticle->BKHARNRINT, $customer_nrint, $a["quantity"]);
        }else{
            $a["article_price"] = $p_iPrice;
            $a["article_price_force"] = 1;
        }
        $this->DatabaseHelper->save("CrossCart", $a);

        $this->updateTimestamp($session);
    }

    public function remove($p_sArticleId){
        $session = $this->request->session()->read("crosscart_id");

        $this->DatabaseHelper->delete("CrossCart", ["session_id" => $session, "article_id" => $p_sArticleId]);
    }

    public function destroy(){
        $session = $this->request->session()->read("crosscart_id");

        $this->DatabaseHelper->delete("CrossCart", ["session_id" => $session]);
    }

    private function checkDuplicate($p_sSessionId, $p_sArticleId){
        $this->loadModel("CrossCart");
        $query = $this->CrossCart->find('all')->where(["session_id" => $p_sSessionId, "article_id" => $p_sArticleId]);
        if($query->count() > 0){
            return $query->first();
        }
        return false;
    }

    private function updateTimestamp($p_sSessionId){
        $this->DatabaseHelper->update("CrossCart", ["last_update" => new \DateTime()], ["session_id" => $p_sSessionId]);
    }

    public function getCart($p_sStartSessionId = "0"){

        $sUrl = $this->makeReturnUrl();
        $sHttps = $_SERVER['SERVER_PORT']  == 443 ? "&https=1" : "";

        if($this->request->session()->check('crosscart_id') === false && $p_sStartSessionId == "0"){
            return $this->_registry->getController()->redirect("http://www.hodi-online.nl/applications/checkCookie.php?sid=".session_id()."&ret=".$sUrl.$sHttps);
        }elseif($this->request->session()->check('crosscart_id') === false && $p_sStartSessionId != "0"){
            if($this->request->query['new'] == 'y'){
                $this->request->session()->write("crosscart_id", session_id());
            }else{
                $this->request->session()->write("crosscart_id", $p_sStartSessionId);
            }
            $oCart = TableRegistry::get('CrossCart');
            $cart = $oCart->getCartBySessionId($this->request->session()->read("crosscart_id"));
            $this->request->session()->write("Cart", $cart);

            return $this->makeInternalRedirect();
        }else{
            $oCart = TableRegistry::get('CrossCart');
            $cart = $oCart->getCartBySessionId($this->request->session()->read("crosscart_id"));
            $this->request->session()->write("Cart", $cart);
        }
    }

    private function makeInternalRedirect(){
        $sHttps = $_SERVER['SERVER_PORT']  == 443 ? "https" : "http";
        unset($this->request->query["startsession"]);
        unset($this->request->query["new"]);
        $params = implode('&', array_map(
            function ($v, $k) { return sprintf("%s=%s", $k, $v); },
            $this->request->query,
            array_keys($this->request->query)
        ));
        $sRetUrl = $params != '' ? $_SERVER['SERVER_NAME']."?".$params : $_SERVER["SERVER_NAME"];
        return $this->_registry->getController()->redirect($sHttps."://".$sRetUrl);
    }

    private function makeReturnUrl(){
        if(strpos($_SERVER["SERVER_NAME"],"www.")){
            $aUrl = explode("www.", $_SERVER["SERVER_NAME"]);
        }else{
            $aUrl[1] = $_SERVER["SERVER_NAME"]."&no_www=1";
        }

        $sUrl = str_replace(".", "_", $aUrl[1]);
        return $sUrl;
    }


}
?>