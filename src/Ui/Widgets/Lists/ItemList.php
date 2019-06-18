<?php
namespace Ui\Widgets\Lists;
use Ui\HTML\Elements\NestedHtmlElement\Ul;
use Ui\HTML\Elements\NestedHtmlElement\Li;
/**
 *
 */
class ItemList extends Ul
{
  private $items=null;

  function __construct(array $items=[])
  {
    parent::__construct();
    $this->items = $items;
    foreach($this->items as $item){
      $this->addElement(new Li($item));
    }
    return $this;
  }

  public function addItem($item)
  {
    $this->addElement(new Li($item));
  }
}

?>
