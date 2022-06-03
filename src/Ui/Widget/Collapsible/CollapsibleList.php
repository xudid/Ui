<?php

namespace Ui\Widget\Collapsible;

use Ui\Widget\Lists\ItemList;

/**
 * Class CollapsibleList contains CollapsibleItems
 * @package Ui\Widget\Accordeon
 */
class CollapsibleList extends ItemList
{
    public function __construct()
    {
        parent::__construct();
        $this->setClass("collapsible");
    }

    public function addItem($item)
    {
        $this->add($item);
        return $this;
    }

    public function setClass(string $class):static
    {
        $this->setAttribute('class', 'collapsible ' . $class);
        return $this;
    }
}
