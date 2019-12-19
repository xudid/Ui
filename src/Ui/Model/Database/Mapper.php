<?php
namespace Brick\Db;
/**
 *
 */

 use Brick\Db\Relations\Reader;

class Mapper
{

  private $rels=[];
  private $classname;
  private $SQLHolder;

  function __construct(string $class)
  {
    $this->classname = $class;
		$reader = new Reader($class);
    $rels = $reader->read();
    $sqlhname = $this->classname."SQL";

    $this->SQLHolder = $sqlhname;

    // \print_r($this->SQLHolder::getAll());
    foreach ($rels as $key => $rel)
    {
      $owned = $rel->getOwned();
      // \print_r("<br>mapper :".$owned."<br>");
      $this->rels[$owned] = $rel;
    }

  }

  public function getRelationwith(string $class)
  {
    return ($this->rels[$class])->getType();
  }

  public function create()
  {
    return new $this->classname();
  }

  public function load($id)
  {

  }

  public function save($object)
  {

  }

  public function insert()
  {

  }
}
 ?>
