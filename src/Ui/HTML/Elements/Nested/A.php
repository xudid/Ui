<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class A
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class A extends Nested{
	/**
	 * A constructor.
	 * @param $href
	 */
	public function __construct($href){
		parent::__construct("a");
		$this->startTag->setAttribute("href", $href);
		return $this;
	}
}

