<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dennis
 * Date: 2-3-2016
 * Time: 11:26
 */

namespace App\Controller;

class AuthorizationController extends AppController {
    /**
     * initialize method
     */
    public function initialize() {
        parent::initialize();
    }

    /**
     * login method
     *
     * Call the function in the external module.
     */
    public function login() {
        // If is logged in, redirect.
        if ($this->request->session()->read('adminlogin')){ 
          $this->redirect(['controller' => 'Dashboard', 'action' => 'index']); 
        }

        // If a post is done, handele login.
        if ($this->request->is('post')){ 
          $this->authorizationHandler->handleLogin(); 
        }
    }

    /**
     * logout method
     *
     * Javascript for cross domain logout.
     * Method used for rendering the template that contains the Javascript.
     */
    public function logout() {}
}
