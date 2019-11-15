<?php
namespace Ui\Widgets\Views;

use Ui\HTML\Elements\Nested\Nav;
use Ui\HTML\Elements\Nested\Li;
use Ui\Widgets\Lists\ItemList;

/**
 * Class NavBar
 * @package Ui\Widgets\Views
 */
class NavBar extends Nav
{
  private $lil = null;
  private $ril = null;

  /**
   * NavBar constructor.
   */
  public function __construct()
  {
    parent::__construct();
    $this->lil = new ItemList();
    $this->ril = new ItemList();
    $this->lil->setClass("navbar_items");
    $this->ril->setClass("navbar_items_right");
    parent::add($this->lil);
    parent::add($this->ril);
  }

  /**
   * @param $menu
   * @param $position
   */
  public function addMenu($menu,$position)
  {
    if($position=="left")
    {
      $item = new Li($menu);
      $item->setClass('navbar_item');
      $this->lil->add($item);
    }
    else {
      $item = new Li($menu);
      $item->setClass('navbar_item');
      $this->ril->add($item);
    }
  }

  public function setMenuClass(string $css)
  {
	if($this->hasMenu()){
		foreach ($this->ril as $menu)
		{
			$menu->setClass($css);
		}
		foreach ($this->lil as $menu)
		{
			$menu->setClass($css);
		}
	}
  }

  private function hasMenu()
  {
  	return ($this->lil->hasItem()||$this->ril->hasItem());
  }
}

