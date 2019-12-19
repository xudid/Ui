<?php
namespace Brick\Db\Relations;
use Brick\Utils\BString;
/**
 *
 */
class Reader
{
  /**
   * @var object $entity
   */
  private $entity;

  /**
   * @param $object $entity
   */
  function __construct($entity)
  {
    $this->entity = $entity;
  }

/**
 *
 */
  public function read()
  {
    $rc = new \ReflectionClass($this->entity);
    $cb = ($rc->getDocComment());
    $pattern = "#@[a-zA-Z0-9, ()_].*#";
    preg_match_all($pattern, $cb, $matches, PREG_PATTERN_ORDER);
    //echo "<pre>";
    //\print_r($matches);
    //echo "</pre>";
    $relations = [];
    foreach ($matches[0] as $rel => $value)
    {
      //\print_r($value."<br>");
      if(BString::startsWith($value,"@relation"))
      {

        $relation = \str_replace("@relation::",'',$value);
        $relation_parts = explode('::', $relation );
        $parts1 = explode(':',$relation_parts[0]);
        $parts2 = explode(':',$relation_parts[1]);
        // \print_r("<br>".$parts1[1]);
        $action1 = $parts1[0];
        $action2 = $parts2[0];
        $r = (new Relation($this->entity))->$action1($parts1[1])->$action2($parts2[1]);
        $relations[]=$r;
      }
    }
    return $relations;
  }
}

 ?>
