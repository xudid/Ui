<?php

namespace Ui\Widget\View\Navbar;

use Ui\HTML\Element\Nested\A;

/**
 * Class TextItem
 * @package Ui\Widget\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 23/11/2019.
 */
class TextItem extends Item
{
	public function __construct($content, $url, $position = self::RIGHT)
	{
		$item = (new A($content, $url))->setClass('primary text-white');
		parent::__construct($item, $position);
	}
}
