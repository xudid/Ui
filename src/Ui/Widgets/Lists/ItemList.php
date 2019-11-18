<?php
namespace Ui\Widgets\Lists;
use Ui\HTML\Elements\Nested\Ul;
use Ui\HTML\Elements\Nested\Li;

/**
 * Class ItemList
 * @package Ui\Widgets\Lists
 */
class ItemList extends Ul
{
  private $items=null;

  /**
   * ItemList constructor.
   * @param array $items
   */
  public function __construct(array $items=[])
  {
    parent::__construct();
    $this->items = $items;
    foreach($this->items as $item){
      $this->add(new Li($item));
    }
    return $this;
  }

  /**
   * @param $item
   */
  public function addItem($item)
  {
    $this->add(new Li($item));
  }

  public function hasItem()
  {
  	return count($this->items)>0?true:false;
  }
}

