<?php
namespace Ui\HTML\Elements\Nested;

/**
 * Class P
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class P extends Nested{
	/**
	 * P constructor.
	 */
	public function __construct(...$elements){
		parent::__construct("p");
		$this->feed($elements);
	}
}