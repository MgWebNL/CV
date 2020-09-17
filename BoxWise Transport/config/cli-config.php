<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__."/../vendor/autoload.php";


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$rootDir = dirname(__DIR__);

$paths = [
//    $rootDir.'/tmp/doctrine/entity-files',
    $rootDir.'/tmp/doctrine/generated/entity-files',
];
$proxyDir = $rootDir.'/tmp/doctrine/generated/proxies';
$isDevMode = true;

// the connection configuration
$dbParams = [
    'driver'   => 'pdo_sqlsrv',
//    'host'     => 'h2772775.stratoserver.net\SQLEXPRESS',
    'host'     => 'h2799000.stratoserver.net\SQLEXPRESS',
    'port'     => 1433,
    'charset'  => 'utf8',
    'user'     => 'mg_sdk',
    'dbname'   => 'BOXwisePro',
];

//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config = Setup::createYAMLMetadataConfiguration(
    $paths,
    $isDevMode,
    $proxyDir,
    new \Doctrine\Common\Cache\ArrayCache()
);
$entityManager = EntityManager::create($dbParams, $config);

return ConsoleRunner::createHelperSet($entityManager);

