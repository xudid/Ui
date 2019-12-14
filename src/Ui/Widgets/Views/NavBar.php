<?php
namespace Ui\Widgets\Views;

use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Nav;
use Ui\Widgets\Lists\ItemList;

/**
 * Class NavBar
 * @package Ui\Widgets\Views
 */
class NavBar extends Nav
{
  private $leftNavItems = null;
  private $rightNavItems = null;
  private $leftColumn = null;
  private $rightColumn = null;

  /**
   * NavBar constructor.
   */
  public function __construct()
  {
    parent::__construct();
    $this->setClass("navbar");
    $this->leftColumn = (new Div())->setClass("nav_column_left");
    $this->rightColumn = (new Div())->setClass("nav_column_right");
    $this->leftNavItems = new ItemList();
    $this->leftColumn->add($this->leftNavItems);
    $this->rightNavItems = new ItemList();
    $this->rightColumn->add($this->rightNavItems);
    $this->leftNavItems->setClass("navbar_items");
    $this->rightNavItems->setClass("navbar_items_right");
    parent::add($this->leftColumn);
    parent::add($this->rightColumn);
  }

  /**
   * @param $item
   * @param $position
   */
  public function addMenu(NavbarItem $item)
  {
  	if($item && $item->getPosition() == NavbarItem::LEFT)
    {
      $this->leftNavItems->add($item);
    }
    elseif($item && $item->getPosition() == NavbarItem::RIGHT) {
      $this->rightNavItems->add($item);
    }
  }

  public function setClass(string $class)
  {
	  parent::setClass("navbar ".$class);
	  return $this;
  }

	public function setMenuClass(string $css)
  {
	if($this->hasMenu()){
		foreach ($this->rightNavItems as $item)
		{
			$item->setClass($css);
		}
		foreach ($this->leftNavItems as $item)
		{
			$item->setClass($css);
		}
	}
  }

  private function hasMenu()
  {
  	return ($this->leftNavItems->hasItem()||$this->rightNavItems->hasItem());
  }
}

