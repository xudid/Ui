<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Option
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Option extends Nested{
	/**
	 * Option constructor.
	 * @param $display
	 * @param $value
	 */
	public function __construct($display,$value){
		parent::__construct("option");
		$this->startTag->setAttribute("value", $value);
		$this->add($display);
		return $this;
	}
}
