<?php

namespace Ui\Widget\View\Navbar;

use Ui\HTML\Element\SimpleInterface;
use Ui\HTML\Element\Nested\Li;
use Ui\Widgets\View\Modal;

/**
 * Class Item
 * @package Ui\Widget\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 23/11/2019.
 */
class Item extends Li
{
	const LEFT = 'LEFT';
	const RIGHT = 'RIGHT';
	protected string $position;

	public function __construct($content = null, string $position = Item::LEFT)
	{
		$this->position = $position;
		$margin = $position == Item::LEFT ? 'mr-2' : 'ml-2';
		if ($content instanceof SimpleInterface) {
		    $content->setClass('d-inline ' . $margin);
        }

		if ($content instanceof Modal) {
		    $content->getTrigger()->setClass('d-inline ' . $margin);
        }

		parent::__construct($content);
		$this->setClass();
	}

	public function setClass(string $class=''):static
	{
		parent::setClass('navbar-item ' . $class);
		return $this;
	}

	public function getPosition(): string
	{
		return $this->position;
	}

	public function setPosition(string $position):static
	{
		$this->position = $position;
		return $this;
	}
}
