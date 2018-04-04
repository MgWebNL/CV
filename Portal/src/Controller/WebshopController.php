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
class WebshopController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index($p_sLink = '/'){

        header ("Expires: ".gmdate("D, d M Y H:i:s", time())." GMT");
        header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");

        if(HD_WEBSHOP_LOGIN) {

            $this->loadModel("Address");
            $this->loadModel("CrossUser");
            $this->loadModel("AanlogOnline");

            $oAddress = $this->Address->get($this->m_iPartner, ['contain' => ["Country"]]);
            $oCrossUser = $this->CrossUser->checkUser($oAddress->BKHADCODE);

            if ($oCrossUser === false) {

                $aOnlineUser = $this->CrossUser->find()->where(["emailaddress" => $oAddress->BKHADGEBRUIKERSNAAM])->first();

                $aValue = $this->CrossUser->newEntity();

                $aValue->id = $aOnlineUser ? $aOnlineUser->id : null;

                $aValue->debiteurcode = $oAddress->BKHADCODE;
                $aValue->company = $oAddress->BKHADNAAM;
                $aValue->address = $oAddress->BKHADADRES_W;
                $aValue->zipcode = $oAddress->BKHADPOSTCODE;
                $aValue->town = $oAddress->BKHADPLAATS;

                // Haal het land op uit de online DB
                $this->loadModel('CrossCountry');
                $aCountryOnline = $this->CrossCountry->getCountry($oAddress->Country->BKHLAOMS);
                $aValue->country_id = $aCountryOnline->id;
                $aValue->telefonnumber = $oAddress->BKHADTELEFOON;
                $aValue->emailaddress = $oAddress->BKHADGEBRUIKERSNAAM;

                $oDate = new Time();
                $aValue->created = $oDate->format('Y-m-d H:i:s');

                // Maak een pepper aan
                $aValue->pepper = $this->CrossUser->generatePassword();
                $aPassWord = $this->CrossUser->generatePassword();
                $aPas = $aValue->password = sha1($aValue->created . $aPassWord . $aValue->pepper);

                $r = $this->CrossUser->generateString();

                $iID = $this->CrossUser->save($aValue);

                $aValue = "";

                // SLA PASSWORD OP
                $this->loadModel("CrossPassword");
                $a = $this->CrossPassword->newEntity();
                $a->customer_id = $iID->id;
                $a->customer_pwd = $aPassWord;
                $this->CrossPassword->save($a);

                // MAAK AANLOG AAN
                $aValue["id"] = 0;
                $aValue["customer_id"] = $iID->id;
                $aValue["sleutel"] = $this->CrossUser->generatePassword();
                $aValue["encryptie"] = $r["front"] . $aPas . $r["end"];
                $aValue["durability"] = 0;
                $aValue["page"] = $p_sLink;        // de link heeft een base64_encode wordt in de login decrypted
                $aValue["firsttimer"] = 'n';
                $oDate = new \DateTime();
                $aValue["date"] = $oDate->format('Y-m-d H:i:s');

                $this->AanlogOnline->saveArray($aValue);
                return $this->redirect(HD_WEBSHOP_URL."/login/" . $aValue["sleutel"] . "/");

            } else {

                $Value["password"] = $oCrossUser->password;
                $r = $this->CrossUser->generateString();

                $aValue["id"] = 0;
                $aValue["customer_id"] = $oCrossUser->id;
                $aValue["sleutel"] = $this->CrossUser->generatePassword();
                $aValue["encryptie"] = $r["front"] . $Value["password"] . $r["end"];
                $aValue["durability"] = 0;
                $aValue["page"] = $p_sLink;        // de link heeft een base64_encode wordt in de login decrypted
                $aValue["firsttimer"] = 'n';
                $oDate = new \DateTime();
                $aValue["date"] = $oDate->format('Y-m-d H:i:s');

                $this->AanlogOnline->saveArray($aValue);
                return $this->redirect(HD_WEBSHOP_URL."/login/" . $aValue["sleutel"] . "/");

            }

        }else{
            return $this->redirect(HD_WEBSHOP_URL);
        }

    }

}
