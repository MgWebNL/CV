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
class StudioController extends AppController
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

        $aStatus = [2, 5, 8];

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

    public function instructions($p_sOrderNrint)
    {
        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplNapkins");
        $this->loadModel("HdIntPrplBoxes");
        $this->loadModel("HdIntPrplArticleEditions");
        $this->loadModel('HdIntPrplLog');
        $this->loadModel('HdIntPrplStatus');
        $this->loadModel('HdIntPrplPrepress');

        $aOrder = $this->HdIntPrplViewItem->getOrder($p_sOrderNrint);
        $aNapkin = $this->HdIntPrplNapkins->find();
        $aBox = $this->HdIntPrplBoxes->find();
        $aEdition = $this->HdIntPrplArticleEditions->find();
        $aLog = $this->HdIntPrplLog->getOrderLog($p_sOrderNrint, ["prepress"]);
        $aStatus = $this->HdIntPrplStatus->getStatus();
        $aPrepress = $this->HdIntPrplPrepress->getPrepress($p_sOrderNrint);

        $this->set("aOrder", $aOrder);
        $this->set("aNapkin", $aNapkin);
        $this->set("aBox", $aBox);
        $this->set("aEdition", $aEdition);
        $this->set("aLog", $aLog);
        $this->set("aStatus", $aStatus);
        $this->set("aPrepress", $aPrepress);
    }
}
