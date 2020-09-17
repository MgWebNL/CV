<?php

namespace PenD\Docker\Application\Profit;

use Doctrine\Common\Cache\Cache;
use PenD\Profit\Classes\AutoGenerate;
use PenD\Profit\Configuration as BaseConfiguration;
use PenD\Profit\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package PenD\Docker\Application\Profit
 * @author Mike Gerritsen <mike@pend-group.com>
 * @since 08/04/2020 21:24
 */
class Configuration extends BaseConfiguration implements ConfigurationInterface
{
    /**
     * Configuration constructor.
     * @param Cache $metadataCacheImpl
     * @param string $classDir
     * @param string $classNamespace
     * @param int|AutoGenerate $autoGenerateConnectorClasses
     */
    public function __construct(
        Cache $metadataCacheImpl,
        string $classDir,
        string $classNamespace = 'ProfitClasses',
        int $autoGenerateConnectorClasses = AutoGenerate::FILE_NOT_EXISTS
    ) {
        $this->setMetadataCacheImpl($metadataCacheImpl);
        $this->setClassDir($classDir);
        $this->setClassNamespace('ProfitClasses');
        $this->setAutoGenerateConnectorClasses($autoGenerateConnectorClasses) ;
    }
}