<?php


namespace Ui\Widgets\Views;


use Ui\HTML\Elements\Nested\Div;
use Ui\Widgets\Lists\ItemList;

/**
 * Class Sidebar
 * @package Ui\Widgets\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 24/11/2019.
 */
class Sidebar extends Div
{
	/**
	 * @var ItemList
	 */
	private $itemList;

	/**
	 * Sidebar constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setClass('sidebar');
		$this->itemList = new ItemList();
		$this->add($this->itemList);
	}

	/**
	 * @param string $class
	 * @return self
	 */
	public function setClass(string $class)
	{
		parent::setClass('sidebar '.$class);
		return $this;
	}

	/**
	 * @param mixed ...$elements
	 * @return Div|void
	 */
	public function feed(...$elements)
	{
		foreach ($elements as $element) {
			$element->setClass(' d-block text-dark');
			$this->itemList->add($element);
		}
		return $this;
	}


}