<?php

namespace PenD\Docker\Console\Command;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PenD\Profit\ProfitManager;
use PenD\Profit\ProfitManagerInterface;
use Symfony\Component\Console\Command\Command AS BaseCommand;

/**
 * Class ExampleCommand
 *
 * @package Lafiel\Docker\Console\Command
 * @author Mike Gerritsen <mike.van.bezooijen@gmail.com>
 * @since 15/03/2017 19:41
 */
abstract class ProfitManagerBaseCommand extends BaseCommand
{
    /**
     * @var ProfitManager
     */
    private $profitManager;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        ProfitManagerInterface $profitManager,
        EntityManagerInterface $entityManager,
        string $name = null
    ) {
        parent::__construct($name);

        $this->profitManager = $profitManager;
        $this->entityManager = $entityManager;
    }

    protected function getProfitManager(): ProfitManagerInterface
    {
        return $this->profitManager;
    }

    protected function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}