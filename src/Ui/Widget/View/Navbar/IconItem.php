<?php

namespace Ui\Widget\View\Navbar;

use Ui\Widget\Button\ClickableImage;

/**
 * Class IconItem
 * @package Ui\Widget\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 23/11/2019.
 */
class IconItem extends Item
{
	public function __construct(string $href, string $imagePath, string $alternateText, $position)
	{
		$item = new ClickableImage($href, $imagePath, $alternateText);
        parent::__construct($item);
        if ($position) {
            $this->setPosition($position);
        }
        $this->setClass('nav-link text-white');
	}
}
