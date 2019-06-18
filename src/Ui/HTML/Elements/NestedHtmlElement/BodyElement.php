<?php
namespace  Ui\HTML\Elements\NestedHtmlElement;

class BodyElement extends NestedHtmlElement{

	private $elementName = "body";

	public function __construct(){
		parent::__construct($this->elementName);
	}
}

?>