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
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Shell;

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\Log\Log;
use Psy\Shell as PsyShell;

/**
 * Simple console wrapper around Psy\Shell.
 */
class ImportOrdersShell extends Shell
{

    /**
     * Start the shell and interactive console.
     *
     * @return int|null
     */
    public function main()
    {
        $this->loadModel("HdIntPrplViewItem");
        $this->loadModel("HdIntPrplGeneral");

        $maxTime = 60;
        $runTime = 0;
        $startTime = time();

        while($runTime < $maxTime) {

            $aView = $this->HdIntPrplViewItem->find()->all();
            $aGeneral = $this->HdIntPrplGeneral->find()->all();

            $aGenNrints = [];
            foreach ($aGeneral as $general) {
                $aGenNrints[$general->order_nrint] = $general;
            }

            foreach ($aView as $view) {
                if (!isset($aGenNrints[$view->orderrule_id]) && !is_null($view->order_date) && $view->order_date->format('Ymd') > '20171101') {
                    $a = $this->HdIntPrplGeneral->newEntity();
                    $a->order_nrint = $view->orderrule_id;
                    $a->order_start_quantity = $view->orderrule_quantity;
                    $a->order_quantity_new = $view->orderrule_quantity;
                    $a->general_status = 1;
                    $this->HdIntPrplGeneral->save($a);
                }
            }

            $runTime = time() - $startTime;

        }
    }

    /**
     * Display help for this console.
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = new ConsoleOptionParser('console');
        $parser->description(
            'This shell provides a REPL that you can use to interact ' .
            'with your application in an interactive fashion. You can use ' .
            'it to run adhoc queries with your models, or experiment ' .
            'and explore the features of CakePHP and your application.' .
            "\n\n" .
            'You will need to have psysh installed for this Shell to work.'
        );

        return $parser;
    }
}
