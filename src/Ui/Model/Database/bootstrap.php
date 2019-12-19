<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Logging\EchoSQLLogger;
require_once "../vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$cache = new \Doctrine\Common\Cache\ArrayCache;
$logger = new Doctrine\DBAL\Logging\EchoSQLLogger;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/entities/"), $isDevMode);
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);
//$config->setSQLLogger($logger);
// or if you prefer XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config"), $isDevMode);

// database configuration parameters
$conn = array(
  'driver'   => 'pdo_mysql',
  'user'     => 'projectfollower',
  'password' => 'pfollower',
  'dbname'   => 'projectfollower',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
