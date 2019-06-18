<?php
namespace Brick\HtmlElements\EmptyElements;
class Br extends EmptyElement{

	private $elementName ="br";

	public function __construct(){
		parent::__construct($this->elementName);
	}

}

?>