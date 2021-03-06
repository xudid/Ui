<?php
namespace Ui\HTML\Elements\Nested;

use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Div
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Div extends Nested{
	protected $index;
	/**
	 * Div constructor.
	 */
	public function __construct(...$children){
		parent::__construct("div");
		$this->feed(...$children);
	}


	/**
	 * @param string $action
	 * @return Div
	 */
	public function setOnClick(string $action){
 	 $this->startTag->setAttribute("onclick",$action);
 	 return $this;
  }

	/**
	 * @return $this
	 */
	public function setContentEditable(){
 	 $this->startTag->setAttribute("contenteditable", "true");
 	 return $this;
  }
}

