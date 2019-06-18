<?php
namespace Ui\Widgets\Views;

use Ui\HTML\Elements\NestedHtmlElement\Nav;
use Ui\HTML\Elements\NestedHtmlElement\Li;
use Ui\Widgets\Lists\ItemList;

/**
 *
 */
class NavBar extends Nav
{
  private $lil = null;
  private $ril = null;
  function __construct()
  {
    parent::__construct();
    $this->lil = new ItemList();
    $this->ril = new ItemList();
    $this->lil->setClass("navbar_items");
    $this->ril->setClass("navbar_items");
    parent::addElement($this->lil);
    parent::addElement($this->ril);
  }

  public function addMenu($menu,$position)
  {
    if($position=="left")
    {
      $item = new Li($menu);
      $item->setClass('navbar_item');
      $this->lil->addElement($item);
    }
    else {
      $item = new Li($menu);
      $item->setClass('navbar_item_right');
      $this->ril->addElement($item);
    }

  }

  public function setClass($class)
  {
    parent::setClass($class);
  }
}
 ?>
