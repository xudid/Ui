<?php
namespace Brick\Db\Relations;

/**
 *
 */
class Relation
{
  /**
   * @var string $owner
   */
  private  $owner;

  /**
   * @var string $owned
   */
private $owned;

/**
 * @param string $owner
 */
  function __construct($owner)
  {
    $this->owner = $owner;
  }

/**
 * @param string $owned
 */
  public function with($owned)
  {
    $this->owned= $owned;
    // \print_r("relation :". $this->owned);
    return $this;
  }

/**
 * @param string $type
 */
  public function type($type){
    $this->type = $type;
    return $this;
  }

  public function getOwned(){
    return $this->owned;
  }

  public function getType(){
    return $this->type;
  }
}

 ?>
