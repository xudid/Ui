<?php
namespace Ui\HTML\Elements\NestedHtmlElement;

class HtmlElement extends NestedHtmlElement{

	private $elementName = "html";


	public function __construct(){
		parent::__construct($this->elementName);
	}


}

?>
