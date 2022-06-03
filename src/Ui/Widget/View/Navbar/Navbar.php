<?php

namespace Ui\Widget\View\Navbar;

use Ui\HTML\Element\Nested\Div;
use Ui\HTML\Element\Nested\Nav;
use Ui\Widget\Lists\ItemList;

/**
 * Class Navbar
 * @package X\Widget\Views
 */
class Navbar extends Nav
{
    private $leftNavItems = null;
    private $rightNavItems = null;
    private $leftColumn = null;
    private $rightColumn = null;

    /**
     * Navbar constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClass("navbar");
        $this->leftColumn = (new Div())->setClass("nav-column-left  py-1");
        $this->rightColumn = (new Div())->setClass("nav-column-right");
        $this->leftNavItems = new ItemList();
        $this->leftColumn->add($this->leftNavItems);
        $this->rightNavItems = new ItemList();
        $this->rightColumn->add($this->rightNavItems);
        $this->leftNavItems->setClass("navbar-items my-0");
        $this->rightNavItems->setClass("navbar-items-right my-0");
        parent::add($this->leftColumn);
        parent::add($this->rightColumn);
    }

    public function feed(...$items): Navbar
    {
        foreach ($items as $item) {
            $this->addMenu($item);
        }
        return $this;
    }

    /**
     * @param $item
     * @param $position
     */
    public function addMenu(Item $item)
    {
        if ($item && $item->getPosition() == Item::LEFT) {
            $this->leftNavItems->add($item);
        } elseif ($item && $item->getPosition() == Item::RIGHT) {
            $this->rightNavItems->add($item);
        }
    }

    public function setClass(string $class):static
    {
        parent::setClass("navbar " . $class);
        return $this;
    }

    public function setMenuClass(string $css)
    {
        if ($this->hasMenu()) {
            foreach ($this->rightNavItems as $item) {
                $item->setClass($css);
            }
            foreach ($this->leftNavItems as $item) {
                $item->setClass($css);
            }
        }
    }

    private function hasMenu()
    {
        return ($this->leftNavItems->hasItem() || $this->rightNavItems->hasItem());
    }
}

