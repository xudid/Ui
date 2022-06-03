<?php

namespace Ui\Widget\View;

use Ui\HTML\Element\Nested\Div;
use Ui\Widget\Lists\ItemList;

/**
 * Class Sidebar
 * @package UI\Widget\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 24/11/2019.
 */
class Sidebar extends Div
{
	private $itemList;

	public function __construct()
	{
		parent::__construct();
		$this->setClass('sidebar');
		$this->itemList = new ItemList();
		$this->add($this->itemList);
	}

	public function setClass(string $class):static
	{
		parent::setClass('sidebar '.$class);
		return $this;
	}

	public function feed(...$elements):self
	{
		foreach ($elements as $element) {
			$element->setClass(' d-block text-dark');
			$this->itemList->add($element);
		}
		return $this;
	}
}
