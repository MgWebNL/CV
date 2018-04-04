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

use Cake\Controller\Controller;
use Cake\Event\Event;
use AuthorizationHandler;
use LockedPageHandler;
use Includes;
use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    protected $path_to_usermodule;
    protected $authorizationHandler;
    public $m_aNoOrderNL = [
        "BPMFEJK1",
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        $this->path_to_usermodule = ROOT;

        require_once $this->path_to_usermodule . '/vendor/external_usermodule/includes.php';
        new Includes($this->path_to_usermodule);

        parent::initialize();

        $this->authorizationHandler = new AuthorizationHandler('adminlogin', 'emailadres', 'name_user', 'password', 'supplier_nrint', 'rights', 'id', 'section_action_rights', 'sites');

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
//        $this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);

        $this->handleLogout();

        if($this->request->session()->check("adminlogin") !== false){
            // TELLERS VULLEN
            $this->loadModel("HdIntPrplViewItem");
            $aCount = $this->HdIntPrplViewItem->getStatusCount($this->request->session()->read("adminlogin")["supplier_nrint"]);
            $aQuantity = $this->HdIntPrplViewItem->getStatusCountQuantity();
            @$aQuantity['totaal'] = $aQuantity['prepress'] + $aQuantity['studio'] + $aQuantity['printing'] + $aQuantity['packaging'] + $aQuantity['transport'];
            $this->set("aCount", $aCount);
            $this->set('aQuantity', $aQuantity);
        }

    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        // SET LANGUAGE
        if ($this->request->session()->read("adminlogin")["supplier_nrint"] && $this->request->session()->read("language") == "") {
            $this->loadModel("FRbkhADRES");
            $this->loadModel("FRbkhLAND");
            $aCustomer = $this->FRbkhADRES->get($this->request->session()->read("adminlogin")["supplier_nrint"]);
            if ($aCustomer["BKHAD_BKHLANRINT"] != "") {
                $sLangCode = strtolower($this->FRbkhLAND->get($aCustomer["BKHAD_BKHLANRINT"])["BKHLACODE"]);
                $sLangCode = ('pl' || 'nl') ? $sLangCode : 'en';
                return $this->redirect('/Dashboard/language/' . $sLangCode);
            }
        }

        // SET SYNC-WARNING
        $iSyncAlert = 0;
        if (date("N") >= 6 || date("Hi") < 800 || date('Hi') >= 1800) {
            $iSyncAlert = 1;
        }
        $this->set('iSyncAlert', $iSyncAlert);

    }

    public function beforeFilter(Event $event)
    {
        $rubrics_actions = array(
            ['Authorization' => 'login'],
            ['Authorization' => 'logout'],
            ['Users' => 'changePw'],
            ['Users' => 'forgotPw']
        );
        $this->authorizationHandler->allowRubricAction($rubrics_actions);

        $allowed_without_login = $this->isAllowedWithoutLogin($rubrics_actions, $this->request->params['controller'], $this->request->params['action']);
        if ($this->request->session()->read('adminlogin') === null && !$allowed_without_login)
            return $this->redirect(['controller' => 'Authorization', 'action' => 'login']);

        // Usermodule en lockingmodule
        $session_var_name = $this->auth();
        $this->handlePageLock();
        $this->set('session_var_name', $session_var_name);
        $this->set('adminlogin', $this->request->session()->read('adminlogin'));

        return parent::beforeFilter($event);
    }


    /**
     * auth method
     *
     * If the session does not exist, redirect the user to the login page.
     * Check if the user is allowed to do a certain action.
     * If not, the user will be redirected.
     *
     * @return array
     */
    private function auth()
    {
        $session_var_name = array(
            'name' => 'adminlogin',
            'email' => 'emailadres',
            'pw' => 'password',
            'supplier_nrint' => 'supplier_nrint',
            'rights' => 'rights',
            'id' => 'id'
        );

        $this->authorizationHandler->handleAuthorization($this->request->params['controller'], $this->request->params['action']);
        return $session_var_name;
    }

    /**
     * isAllowedWithoutLogin method
     *
     * Check if an user is always allowed to do a certain action.
     *
     * @param $rubrics_actions
     * @param $section
     * @param $action
     * @return bool
     */
    private function isAllowedWithoutLogin($rubrics_actions, $section, $action)
    {
        foreach ($rubrics_actions as $row) {
            foreach ($row as $ra => $ra_value) {
                $ra = strtolower($ra);
                $ra_value = strtolower($ra_value);
                $section = strtolower($section);
                $action = strtolower($action);
                if ($ra === $section && $ra_value === $action) return true;
            }
        }
        return false;
    }

    /**
     * handlePageLock method
     *
     * Call the method from the external module.
     * Optional give the action and the parameters.
     *
     * Examples given:
     *  'Action' => array('edit', 'delete')
     *  'Groups' => array('edit', 'view'), 'Rubrics' => array('edit')
     *  'Section' => array('Rubrics', 'Sites')
     *  'Section' => array('all')
     */
    private function handlePageLock()
    {
        $when = array(//'Prepackaging' => array('confirmPackagingOrder')
        );

        if ((new LockedPageHandler($this->request->session()->read('adminlogin.id'), $this->request->params['controller']))
            ->handleLockedPage($when, $this->request->params['action'], $this->request->params['pass'])
        ) {
            $this->Flash->error(__('Deze pagina is nu vergrendeld voor andere gebruikers'));
        }
    }

    /**
     * handleLogout method
     *
     * If the request contains 'session', give the session variable for cross domain logout.
     * If the request contains 'logout', only logout. This means that the request came from another domain.
     */
    private function handleLogout()
    {
        $this->authorizationHandler->handleLogout(true, $this->request);
    }
}
