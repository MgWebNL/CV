<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dennis
 * Date: 2-3-2016
 * Time: 11:26
 */

namespace App\Controller;

use Cake\Validation\Validator;
use Cake\Event\Event;

class AuthorizationController extends AppController {
    /**
     * initialize method
     */
    public function initialize() {
        parent::initialize();
        $this->loadModel("CustomerLogin");
    }
    
    public function index(){
      return $this->redirect(['controller' => 'Authorization', 'action' => 'login']);
    }

    public function createNewUser(){
        if ($this->request->is('post')) {
            $aPost = $this->request->data;
            $this->CustomerLogin->createNewUser($aPost);
            return $this->redirect('/');
        }
        die();
    }

    /**
     * login method
     */
    public function login($p_sKey = "") {
        // If is logged in, redirect.
        if ($this->request->session()->read('customerlogin')){
          return $this->redirect('/');
        }

        // If a post is done, handele login.
        if ($this->request->is('post')) {
            $aPost = $this->request->data;
            if(empty($errors = $this->checkForm($aPost))) {
                if(!$this->CustomerLogin->login($aPost)) {
                   $this->Flash->errorLogin('Username does not exist or password is wrong');
                }else{
                    $this->loadComponent("LogHodi");
                    $this->LogHodi->log(1);
                }
            }else{
                foreach($errors as $k => $error){
                    foreach($error as $err) {
                        $this->Flash->errorLogin($err);
                    }
                }
            }
            return $this->redirect('/');
        }

        if($p_sKey != ""){
            $aExplode = explode(HD_SECURITY_STRING, base64_decode($p_sKey));
            $aPost["username"] = $aExplode[1];
            $aPost["password"] = $aExplode[2];
            if(empty($errors = $this->checkForm($aPost))) {
                if(!$this->CustomerLogin->login($aPost)) {
                    $this->Flash->errorLogin('Username does not exist or password is wrong');
                }else{
                    $this->loadComponent("LogHodi");
                    $this->LogHodi->log(2);
                }
            }else{
                foreach($errors as $k => $error){
                    foreach($error as $err) {
                        $this->Flash->errorLogin($err);
                    }
                }
            }
            return $this->redirect('/');
        }
    }

    public function loginHashedPassword($p_sNrint, $p_sPassword){
        $this->loadModel("CustomerLogin");
        $aUser = $this->CustomerLogin->find()->where(["FRbkhADRES_nrint" => $p_sNrint])->first();

        if(is_null($aUser) || md5($aUser->password) != $p_sPassword){
            $this->Flash->errorLogin('Username does not exist or password is wrong');
            return $this->redirect('/');
        }
        else{
            $oUser = $this->CustomerLogin->getUser($aUser->username);
            $this->CustomerLogin->forceSetSession($oUser);

            $this->redirect('/');
        }

    }

    public function loginCreditLinkOld($p_sNrint, $p_sPassword, $p_sLink){
        $this->loadModel("CustomerLogin");
        $aUser = $this->CustomerLogin->find()->where(["FRbkhADRES_nrint" => $p_sNrint])->first();

        if(is_null($aUser) || $aUser->oldPassword.md5($aUser->oldUserName) != $p_sPassword){
            $this->Flash->errorLogin('Username does not exist or password is wrong');
            return $this->redirect('/');
        }
        else{
            $oUser = $this->CustomerLogin->getUser($aUser->username);
            $this->CustomerLogin->forceSetSession($oUser);

            $this->loadComponent("LogHodi");
            $this->LogHodi->log(2);

            $this->redirect('/Invoice/Overview/');
        }

    }

    public function resetPassword($p_sReferrer = null){

        $sLink = is_null($p_sReferrer) ? '/' : base64_decode($p_sReferrer);

        if($this->request->is('post')){
            $aPost = $this->request->data();

            // USER LOOKUP
            $this->loadModel('CustomerLogin');
            $aUser = $this->CustomerLogin->findUser($aPost["inputMixed"]);
            if($aUser !== false){
                $sPassword = $this->CustomerLogin->generateNewPassword();
                $this->CustomerLogin->makeNewPassword($aUser->id, $sPassword, 1);
                $this->CustomerLogin->mailNewPassword($aUser, $sPassword, $aUser->emailaddress);
                $this->Flash->successLogin('A new password has been sent to your emailaddress.');
                return $this->redirect($sLink);
            }else{
                $this->Flash->errorLogin('No user found with this username/emailaddress');
                return $this->redirect($sLink);
            }
        }else{
            return $this->redirect($sLink);
        }
    }

    /**
     * logout method
     */
    public function logout() {
        $this->request->session()->delete("customerlogin");
        return $this->redirect('/');
    }


    private function checkForm($p_aData){
        $validator = new Validator();
        $validator
            ->add('username', [
                'minLength' => [
                    'rule' => ['minLength', 10],
                    'message' => 'Username must have a substantial body.'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Username cannot be too long.'
                ]
            ]);

        return []; //$validator->errors($p_aData);
    }
}
