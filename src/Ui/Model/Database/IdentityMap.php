<?php
namespace Brick\Db;

/**
 *
 */
class IdentityMap
{
  /*
  *
  */

  private $map=[];

/*
*
*
*
*/
  function __construct()
  {

  }

  public function get($class,$id):object{
    if(\array_key_exists($class,$this->map)
    && \array_key_exists($id,$this->map[$class]))
    {
      return $this->map[$class][$id];
    }
  }

  public function put($class,$id,$object){

     $this->map[$class][$id]=$object;
  }
}

 ?>
