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
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class CalendarController extends AppController
{

    public $m_aHelperText = [];

    public function initialize()
    {
        parent::initialize();
        $this->m_aHelperText[__FUNCTION__] = [
            'nl' => 'In de agenda ziet u overzichtelijk wanneer artikelen besteld moeten worden. Wanneer u op een artikel klikt, krijgt u een uitgebreide weergave van het artikel en het bestelaantal.',
        ];

    }

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index(){

    }

    public function newAppointment(){
        if($this->request->is('post')){

            $aPost = $this->request->data();
            $aSession = $this->request->session()->read('customerlogin');

            $this->loadModel("Calendar");
            $aNewAppointment = $this->Calendar->saveAppointment($aPost, $aSession);

            debug($aNewAppointment);

            $p_sEmailaddress = $aSession["Accountmanager"]["HdEmployee"]["emailaddress"];
            $to = ($p_sEmailaddress == '') ? HD_EMAIL : $p_sEmailaddress;
//            $to = 'mike@hd-it.nl';

            $email = new Email();
            $email
                ->emailFormat('html')
                ->from([HD_EMAIL_NOREPLY => HD_COMPANYNAME])
                ->template('nl/newVisitRequest')
                ->to([$to => HD_COMPANYNAME])
                ->subject('Portal - Nieuw bezoekverzoek')
                ->viewVars([
                    'customerCode' => $aNewAppointment->createdby,
                    'customerName' => $aNewAppointment->cal_name,
                    'request' => $aNewAppointment->cal_description,
                    'userName' => $aSession["customer_user_name"],
                    'userEmail' => $aSession["customer_user_email"],
                    'type' => $aPost["visit_type"],
                    'date' => date('d-m-Y', strtotime($aNewAppointment["date_start"])),
                    'time' => date('H:i', strtotime($aNewAppointment["time_start"])),
                    'id' => $aNewAppointment->id,
                ])
                ->send();

            $this->Flash->success(__('Your request has been submitted.'));
            return $this->redirect('/Calendar/');

        }
    }

    public function loadAppointmentsAjax(){
        $this->loadComponent("ArticleHelper");
        $this->loadModel("Calendar");
        $aAdvice = $this->ArticleHelper->getArticleListCustomerAdvice2($this->m_iPartner);
        $aVisits = $this->Calendar->getVisits($this->m_iPartner);
        $sJsonArticle   = $this->ArticleHelper->makeAdviceCalendarProof2($aAdvice);

        $sJsonVisit     = $this->Calendar->makeVisitsCalendarProof($aVisits);

        $sJSON = json_encode(array_merge($sJsonArticle,$sJsonVisit));
        echo $sJSON;

        $this->viewBuilder()->layout(false);
        $this->render(false);
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->set("aPageHelper", $this->m_aHelperText);
    }


}
