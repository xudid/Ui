<?php
namespace Ui\Model;

/**
 *
 */
class Association
{
  /**
   * [private description]
   * @var string
   */
  private $type;
  /**
   * [private description]
   * @var string
   */
  private $classname;

  private $shortclassname;

  private $fieldname;

  /**
   * [__construct description]
   * @param string $type      [description]
   * @param string $classname [description]
   */
  function __construct(string $type,string $classname,string $fieldname)
  {
    $this->type = $type;
    $this->classname = $classname;
    $s = \str_replace('\\','/',$classname);
    //var_dump($s);
    $c = \explode("/",$s);
    $this->shortclassname = \end($c);
    $this->fieldname = $fieldname;
  }
/**
 * [getType description]
 * @return string [description]
 */
  public function getType():string
  {
    return $this->type;
  }

/**
 * [setType description]
 * @param [type] $type [description]
 */
  public function setType($type):void
  {
    $this->type=$type;
  }

/**
 * [getClassname description]
 * @return string [description]
 */
  public function getClassname():string
  {
    return $this->classname;
  }

  public function getShortClassname():string
  {
    return $this->shortclassname;
  }

/**
 * [setClassname description]
 * @param string $class [description]
 */
  public function setClassname(string $class):void
  {
    $this->classname=$class;
  }

  public function getFieldName():string
  {
    return $this->fieldname;
  }

  public function setFieldName(string $fieldname):void
  {
    $this->fieldname = $fieldname;
  }
}
 ?>
