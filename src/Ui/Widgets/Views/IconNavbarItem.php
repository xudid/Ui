<?php


namespace Ui\Widgets\Views;

use Ui\Widgets\Button\ClickableImage;

/**
 * Class IconNavbarItem
 * @package Ui\Widgets\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 23/11/2019.
 */
class IconNavbarItem extends NavbarItem
{

	/**
	 * IconNavbarItem constructor.
	 */
	public function __construct(string $href, string $imagePath, string $alternateText)
	{
		$item = new ClickableImage($href, $imagePath, $alternateText);
		parent::__construct($item);
	}
}