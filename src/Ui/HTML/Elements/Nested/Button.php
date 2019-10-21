<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Button
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Button extends Nested{
	/**
	 * Button constructor.
	 * @param $text
	 */
	public function __construct($text){
		parent::__construct("button");
		if(isset($text)){
			$this->add($text);
		}
	}
}
