<?php


namespace Ui\Widgets\Views;

use Ui\HTML\Elements\Nested\A;

/**
 * Class TextNavbarItem
 * @package Ui\Widgets\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 23/11/2019.
 */
class TextNavbarItem extends NavbarItem
{

	/**
	 * TextNavbarItem constructor.
	 * @param $content
	 * @param $url
	 */
	public function __construct($content, $url)
	{
		$item = (new A($url))->setClass('primary text-white');
		$item->add($content);
		parent::__construct($item);
	}
}