<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\Mailer\Email;

class CustomerLoginTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_address_login');
        $this->primaryKey('id');

        $this->hasOne('Address', [
            'propertyName' => 'Address',
            'foreignKey' => 'BKHADNRINT',
            'bindingKey' => 'FRbkhADRES_nrint',
            'joinType' => 'INNER',
        ]);
    }

    public function createNewUser($p_aData){
        if(!$this->checkUser($p_aData["username"])) {
            $a["id"] = 0;

            $a["username"] = $p_aData["username"];
            $a["salt"] = self::generateSalt();
            $a["pepper"] = self::generatePepper();
            $a["password"] = self::hashPassword($p_aData["password"], $a["salt"], $a["pepper"]);

            $a["rights"] = 1;
            $a["password_timestamp"] = time();

            $a["FRbkhADRES_nrint"] = (isset($p_aData["nrint"])) ? $p_aData["nrint"] : "";
            $a["full_name"] = (isset($p_aData["contact"])) ? $p_aData["contact"] : "";
            $a["telephone"] = (isset($p_aData["telephone"])) ? $p_aData["telephone"] : "";
            $a["oldPassword"] = (isset($p_aData["oldPassword"])) ? $p_aData["oldPassword"] : "";
            $a["oldUserName"] = (isset($p_aData["oldUserName"])) ? $p_aData["oldUserName"] : "";
            $a["emailaddress"] = $p_aData["username"];



            $a = $this->newEntity($a);
            $this->save($a);
            return true;
        }else{
            return false;
        }
    }

    /**
     * login method
     */
    public function login($p_aData) {
        //$this->createNewUser($p_aData);

        $a = $this->checkLogin($p_aData["username"], $p_aData["password"]);
        if($a){
            $this->setSession($a, 'customerlogin');
            return true;
        }else{
            return false;
        }
    }


    public function forceSetSession($p_oUser){
        $this->setSession($p_oUser, 'customerlogin');
    }


    public function checkNewPassword($p_sPassword){
        /** MINIMUM ::
         *  1x HOOFDLETTER
         *  1x kleine letter
         *  1x cijfer
         *  6 tekens lang
         */
        if(strlen($p_sPassword) < 6){
            return false;
        }
        if(preg_match('/[a-z]/', $p_sPassword) == 0){
            return false;
        }
        if(preg_match('/[A-Z]/', $p_sPassword) == 0){
            return false;
        }
        if(preg_match('/[0-9]/', $p_sPassword) == 0){
            return false;
        }
        return true;
    }


    public function makeNewPassword($p_iUserId, $p_sPassword, $p_bForce = 0){
        $a["id"] = $p_iUserId;
        $a["salt"] = self::generateSalt();
        $a["pepper"] = self::generatePepper();
        $a["password"] = self::hashPassword($p_sPassword, $a["salt"], $a["pepper"]);
        $a["password_timestamp"] = time();
        $a["force_new_password"] = $p_bForce;

        $a = $this->newEntity($a);
        $this->save($a);
    }

    private function checkUser($p_sUserName){
        $query = $this->find('all')
            ->where(["LOWER(username)" => strtolower(trim($p_sUserName))])
            ->first();

        if(!is_null($query)){
            return true;
        }
        return false;
    }

    public function getUserById($p_iId){
        return $this->get($p_iId, ["contain" => ["Address.Country"]]);

    }

    public function findUser($p_sMixed){
        $aUser = $this->find('all')
            ->where(["LOWER(username)" => strtolower($p_sMixed)])
            ->orWhere(["LOWER(emailaddress)" => strtolower($p_sMixed)])
            ->contain(["Address.Country"])
            ->first();

        if(!is_null($aUser)){
            return $aUser;
        }
        return false;
    }

    public function generateNewPassword(){
        return self::generateSalt(8);
    }

    public function mailNewPassword($p_oUser, $p_sPassword, $p_sEmailaddress = ''){
        $aSubject = [
            'nl' => 'Uw nieuwe wachtwoord',
            'en' => 'Your new password',
            'de' => 'Ihr neues Passwort',
            'fr' => 'Votre nouveau mot de passe'
        ];

        //$p_sEmailaddress = 'mike@hd-it.nl';

        $to = ($p_sEmailaddress == '') ? $p_oUser->username : $p_sEmailaddress;
        $lang = 'nl';//strtolower($p_oUser->Address->Country->BKHLACODE);

        $base64 = base64_encode(HD_SECURITY_STRING.$p_oUser->username.HD_SECURITY_STRING.$p_sPassword.HD_SECURITY_STRING);

        $sLink = HD_DOMAIN."Authorization/login/".$base64;

        $email = new Email();
        $email
            ->emailFormat('html')
            ->from([HD_EMAIL_NOREPLY => HD_COMPANYNAME])
            ->template($lang.'/passwordReset')
            ->to($to)
            ->subject($aSubject[$lang])
            ->viewVars([
                'username' => $p_oUser->username,
                'password' => $p_sPassword,
                'link' => $sLink
            ])
            ->send();

    }

    private function setSession($p_oUserdata, $p_sSessionName, $p_sSessionPrefix = 'customer'){
        $this->session = new Session();
        $land = strtolower($p_oUserdata->Address->Language->BKHTACODE);
        $this->session->write($p_sSessionName, [
            $p_sSessionPrefix.'_user_name' => $p_oUserdata->username,
            $p_sSessionPrefix.'_user_email' => $p_oUserdata->emailaddress,
            $p_sSessionPrefix.'_rights' => $p_oUserdata->rights,
            $p_sSessionPrefix.'_user_id' => $p_oUserdata->id,
            $p_sSessionPrefix.'_user_name' => $p_oUserdata->full_name,
            $p_sSessionPrefix.'_nrint' => $p_oUserdata->FRbkhADRES_nrint,
            $p_sSessionPrefix.'_language' => $land == '' ? HD_DEFAULT_LANGUAGE : $land,
            $p_sSessionPrefix.'_force_language' => $p_oUserdata->force_language,
            $p_sSessionPrefix.'_force_password' => $p_oUserdata->force_new_password,
            $p_sSessionPrefix.'_invoice_to' => $p_oUserdata->Address->OrdAddress->ORDAD_BKHADNRINT_VF,
        ]);
    }

    private function checkLogin($p_sUsername, $p_sPassword){
        // CHECK FOR USER
        if($user = $this->getUser($p_sUsername)){
            if($this->comparePassword($user, $p_sPassword)){
                return $user;
            }
        }
        return false;
    }

    public function getUser($p_sUsername){
        $query = $this->find('all')
            ->where(["LOWER(username)" => strtolower(trim($p_sUsername))])
            ->contain(["Address.Language", "Address.OrdAddress"])
            ->first();

        if(is_null($query)){
            return false;
        }
        return $query;
    }

    private function comparePassword($p_oUser, $p_sPassword){
        $salt = $p_oUser->salt;
        $pepper = $p_oUser->pepper;
        $password = self::hashPassword($p_sPassword, $salt, $pepper);
        //var_dump($password); die();
        return $p_oUser->password == $password;
    }

    private static function hashPassword($p_sPassword, $p_sSalt, $p_iPepper){
        // SALT :: DB - VARCHAR(22)
        // PEPPER :: DB - INT(5)
        // SECURITY STRING :: FUNCTION - RANDOM
        // PASSWORD = bcrypt(SALT . SECURITY STRING . PWD . PEPPER)

        $salt = $p_sSalt;
        $pepper = $p_iPepper;
        $string = HD_SECURITY_STRING;
        $options = [
            'salt' => $salt
        ];
        return @password_hash($salt.$string.$p_sPassword.$pepper, PASSWORD_BCRYPT, $options);
    }

    private static function generateSalt($length = 22) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    private static function generatePepper($length = 5) {
        $str = "";
        $characters = array_merge(range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

}

?>