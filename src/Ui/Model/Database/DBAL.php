<?php

namespace Ui\Model\Database;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Logging\EchoSQLLogger;

/**
 * Class DBAL
 * @package Ui\Model\Database
 * @author Didier Moindreau <dmoindreau@gmail.com> on 01/12/2019.
 */
class DBAL
{
  private $entitiesPath='/';
  private $entityManager=null;
  private $driverconfig =null;
  private $cache = null;
  function __construct(array $driverConfig, $entitiesPath ,$enableLogger=false)
  {
    $isDevMode = true;
    $this->driverconfig = $driverConfig;
    $this->entitiesPath = $entitiesPath;
    $this->cache = $cache = new \Doctrine\Common\Cache\ArrayCache;
    $this->config = Setup::createAnnotationMetadataConfiguration(
      array(__DIR__.$this->entitiesPath), $isDevMode);

    $this->config->setMetadataCacheImpl($cache);
    $this->config->setQueryCacheImpl($cache);
    if($enableLogger)
    {
      $logger = new EchoSQLLogger;
      $this->config->setSQLLogger($logger);
    }
    $this->entityManager = EntityManager::create($this->driverconfig, $this->config);
  }


  public function getEntityManager()
  {
    return $this->entityManager;
  }
}
