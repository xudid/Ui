<?php
namespace Ui\Widgets\Accordeon;

use Ui\Widgets\Lists\ItemList;



/**
 *Contains CollapsibleItems 
 */
class CollapsibleList extends ItemList
{

  function __construct()
  {
    parent::__construct();
    $this->setClass("collapsible");

  }

  public function addItem($item)
  {
    $this->addElement($item);
  }
}

 ?>
