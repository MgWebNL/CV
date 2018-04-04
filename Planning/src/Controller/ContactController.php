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
use Cake\ORM\TableRegistry;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class ContactController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index()
{
    $aStatus = [1, 3, 4, 6, 7];

    $this->loadModel("HdIntPrplViewItem");
    $this->loadModel("HdIntPrplStatus");
    $this->loadModel("HdIntPrplExceptionrules");
    $this->loadModel("HdIntPrplArticleEditions");

    $this->loadComponent("Functions");

    $aStatusList = $this->HdIntPrplStatus->getStatus($aStatus);

    $aOrders = $this->HdIntPrplViewItem->getOrdersByStatus($aStatus);
    $aGrouped = $this->Functions->groupObjectByKey($aOrders, "general_status", ["HdIntPrplGeneral"]);

    $aExceptions = $this->HdIntPrplExceptionrules->getNotesGrouped();

    $aEditie = $this->HdIntPrplArticleEditions->getEditions();

    $this->set('aOrders', $aOrders);
    $this->set('aGrouped', $aGrouped);
    $this->set('aStatusList', $aStatusList);
    $this->set('aExceptions', $aExceptions);
    $this->set('aEditie', $aEditie);
}
}
