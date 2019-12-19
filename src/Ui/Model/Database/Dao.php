<?php

namespace Ui\Model\Database;
use \Psr\Container\ContainerInterface;
/**
 *
 */
class Dao implements DaoInterface
{
  /**
   * [protected description]
   * @var  ContainerInterface $container
   */
  protected $container=null;

  /**
   * [protected description]
   * @var string $classnamespace
   */
  protected $classnamespace="";
  private $databaseConfig;
  /**
   * @var string
   */
  private $entitiesDirectory;

  /**
   * [__construct description]
   * @param \Psr\Container\ContainerInterface $container
   * @param string $classnamespace [description]
   */
  function __construct($databaseConfig ,string $classnamespace, $entitiesDirectory = '/entities/')
  {
    $this->classnamespace = $classnamespace;
    $this->databaseConfig = $databaseConfig;
    $this->entitiesDirectory = $this->entitiesDirectory;
  }

  public function save($object)
  {

    try
    {
      $dbal = new DBAL($this->databaseConfig, $this->entitiesDirectory,true);
      $entityManager = $dbal->getEntityManager();
      $entityManager->persist($object);
      $entityManager->flush();
      
      return $object;
    }
    catch(\Doctrine\DBAL\DBALException $ex)
    {
      return $ex->getPrevious()->getCode();
    }
  }

  public function update($object)
  {
    try
    {
      $dbal = new DBAL($this->databaseConfig, $this->entitiesDirectory,true);
      $entityManager = $dbal->getEntityManager();
      $entityManager->merge($object);
      $entityManager->flush();
      return $object;
    }
    catch(\Doctrine\DBAL\DBALException $ex)
    {
      return $ex->getPrevious()->getCode();
    }

  }

  public function delete(int $id)
  {
    try
    {
      $dbal = new DBAL($this->databaseConfig, $this->entitiesDirectory);
      $entityManager = $dbal->getEntityManager();
      $repository = $entityManager->getRepository($this->classnamespace);
      $object = $repository->find($id);
      $entityManager->remove($object);
      $entityManager->flush();
      return $object;
    }
    catch(\Doctrine\DBAL\DBALException $ex)
    {
      return $ex->getPrevious()->getCode();
    }
  }

  public function findAll()
  {
    try
    {
      $dbal = new DBAL($this->databaseConfig, $this->entitiesDirectory);
      $entityManager = $dbal->getEntityManager();
      $result =  ($entityManager->getRepository($this->classnamespace))->findAll();
      return $result;
    }
    catch (\Doctrine\DBAL\DBALException $ex)
    {
      return $ex->getPrevious()->getCode();
    }

  }

  public function findById(int $id)
  {
    try
    {
      $dbal = new DBAL($this->databaseConfig, $this->entitiesDirectory);
      $entityManager = $dbal->getEntityManager();
      $result =  $entityManager->find($this->classnamespace, $id);
      return $result;
    }
    catch (\Doctrine\DBAL\DBALException $ex)
    {

      return $ex->getPrevious()->getCode();
    }

  }

  public function findBy(array $params)
  {
    try
    {
      $dbal = new DBAL($this->databaseConfig, $this->entitiesDirectory);
      $entityManager = $dbal->getEntityManager();
      $result =  $entityManager->getRepository($this->classnamespace)->findBy($params);
      return $result;
    }
    catch (\Doctrine\DBAL\DBALException $ex)
    {
      $code = $ex->getPrevious()->getCode();

      return $code;
    }

  }
}
