<?php


namespace Ui\Widgets\Views;


use Ui\HTML\Elements\Nested\Li;

/**
 * Class NavbarItem
 * @package Ui\Widgets\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 23/11/2019.
 */
class NavbarItem extends Li
{
	const LEFT = 'LEFT';
	const RIGHT = 'RIGHT';
	private string $position;
	/**
	 * NavbarItem constructor.
	 * @param null $content
	 */
	public function __construct($content = null, string $position = NavbarItem::LEFT)
	{
		$this->position = $position;
		parent::__construct($content);
		$this->setClass();
	}

	public function setClass(string $class='')
	{
		parent::setClass('navbar_item' . $class);
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPosition(): string
	{
		return $this->position;
	}

	/**
	 * @param string $position
	 * @return NavbarItem
	 */
	public function setPosition(string $position): NavbarItem
	{
		$this->position = $position;
		return $this;
	}




}