<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
class P extends NestedHtmlElement{


	private $elementName = "p";


	public function __construct(){
		parent::__construct($this->elementName);
	}

	public function setClass($class){
		if(isset($class))
		{$this->startTag->setAttribute("class",$class);}
	}


}



?>
