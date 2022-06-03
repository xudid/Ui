<?php

namespace Ui\Widget\Lists;

use Ui\HTML\Element\Nested\Ul;
use Ui\HTML\Element\Nested\Li;

/**
 * Class ItemList
 * @package X\Widget\Lists
 */
class ItemList extends Ul
{
  private $items=null;

  /**
   * ItemList constructor.
   * @param array $items
   */
  public function __construct(...$items)
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

