<?php
namespace Ui\HTML\Elements\Nested;

use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Nav
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Nav extends Nested{
	/**
	 * Nav constructor.
	 */
	public function __construct(){
		parent::__construct("nav");
	}
}
