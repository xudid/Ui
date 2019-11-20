<?php
namespace Ui\Widgets\Accordeon;

use Ui\Widgets\Lists\ItemList;



/**
 *Contains CollapsibleItems 
 */
class CollapsibleList extends ItemList
{

  /**
   * [__construct description]
   */
  public function __construct()
  {
    parent::__construct();
    $this->setClass("collapsible");

  }

  /**
   * [addItem description]
   * @param [type] $item [description]
   */
  public function addItem($item)
  {
    $this->add($item);
  }
}

 ?>
