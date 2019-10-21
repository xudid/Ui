<?php
namespace Ui\Widgets\Table;
use Ui\HTML\Elements\Nested\Div;

/**
 *
 */
class TableLegend
{
  /**
   * [private description]
   * @var string $position
   */
  private $position;

  /**
   * [private description]
   * @var mixed $content
   */
  private $content;

/**
 * [public description]
 * @var  string $TOP_LEFT
 */
  const TOP_LEFT ="TOP_LEFT";

  /**
   * [public description]
   * @var  string $TOP_RIGHT
   */
  const TOP_RIGHT ="TOP_RIGHT";



  /**
   * [__construct description]
   * @param mixed $content  [description]
   * @param string $position [description]
   */
  function __construct($content,string $position)
  {
    $this->content = $content;
    $this->position = $position;
  }
/**
 * [getContent description]
 * @return mixed [description]
 */
  public function getContent()
  {
    return $this->content;
  }

  public function getPosition():string
  {
    return $this->position;
  }
}


?>
