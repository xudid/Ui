<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
class Section extends NestedHtmlElement{


	private $elementName = "section";


	public function __construct(){
		parent::__construct($this->elementName);
	}

	public function setClass($class){
		$this->startTag->setAttribute("class",$class);
	}


}



?>
