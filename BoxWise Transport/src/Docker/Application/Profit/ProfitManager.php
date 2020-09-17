<?php

namespace PenD\Docker\Application\Profit;

use PenD\Profit\ConfigurationInterface;
use PenD\Profit\ConnectionInterface;
use PenD\Profit\ProfitManager as BaseProfitManager;
use PenD\Profit\ProfitManagerInterface;

/**
 * Class ProfitManager
 *
 * @package PenD\Docker\Application\Profit
 * @author Mike Gerritsen <mike@pend-group.com>
 * @since 08/04/2020 21:51
 */
class ProfitManager extends BaseProfitManager implements ProfitManagerInterface
{
    /**
     * Creates a new EntityManager that operates on the given database connection
     * and uses the given Configuration and EventManager implementations.
     *
     * @param ConnectionInterface     $connection
     * @param ConfigurationInterface  $configuration
     */
    public function __construct(ConnectionInterface $connection, ConfigurationInterface $configuration)
    {
        parent::__construct($connection, $configuration);
    }
}