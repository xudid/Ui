<?php

namespace Ui\Widgets\Accordeon;
use Ui\Widgets\Lists\ItemList;

/**
 * Class CollapsibleList contains CollapsibleItems
 * @package Ui\Widgets\Accordeon
 */
class CollapsibleList extends ItemList
{

  /**
   * CollapsibleList constructor.
   */
  public function __construct()
  {
    parent::__construct();
    $this->setClass("collapsible");
  }

/**
 * @param $item
 */
  public function addItem($item)
  {
    $this->add($item);
  }
}
