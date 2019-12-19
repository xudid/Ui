<?php
namespace Brick\Db;

/**
 * Maintains a list of object affected by a business transaction
 * and coordinates the writing out of changes and the resolution
 * of concurrency problems
 */
class UnitOfWork
{
  private $identyMap = null;
  private $newObjects = [];
  private $dirtyObjects = [];
  private $cleanObjects = [];
  private $removedObjects = [];
  private $mappers = [];


/*
*
*
*/

  function __construct()
  {
    $this->identyMap = new \Brick\Db\IdentityMap();

  }

  public function load(){

  }

  public function commit(){

  }

  public function registerNew($object){
    $id = $object->getId();
    $rc = new \ReflectionClass($object);
    $classname =  $rc->getName();
    if(!\in_array($classname,$this->mappers))
    {
      $this->mappers[$classname]= new Mapper($classname);
    }

    if(!\is_null($id)){
      if(!\in_array($id,$this->dirtyObjects[$class])&&
         !\in_array($id,$this->removedObjects[$class])&&
         !\in_array($id,$this->newObjects[$class])){
           $this->newObjects[$class]=$id;
         }
    }


  }

  public function registerClean(){

  }


/*
* to use after an object modification
*/
  public function registerDirty(){
    $id = $object->getId();
    if(!\is_null($id)){
      if(!\in_array($id,$this->removedObjects[$class])&&
         !\in_array($id,$this->dirtyObjects[$class])&&
         !\in_array($id,$this->newObjects[$class])){
           $this->dirtyObjects[$class]=$id;
         }
    }
  }

  public function registerDeleted(){

  }

  public function commit(){
    $this->insertNew();
    $this->updateDirty();
    $this->deleteRemoved();
  }

  private function insertNew(){
    foreach ($this->newObjects as $key => $value)
    {
      foreach ($this->newObjects[$key] as $id )
      {
        $obj = $this->newObjects[$key][$id];
      }
    }
  }

  private function updateDirty(){

  }

  private function deleteRemoved(){

  }
}

 ?>
