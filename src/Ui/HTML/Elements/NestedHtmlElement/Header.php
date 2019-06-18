<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
class Header extends NestedHtmlElement{


	private $elementName = "header";


	public function __construct(){
		parent::__construct($this->elementName);
	}
	public function setClass($class){
 	 $this->startTag->setAttribute("class",$class);
  }

}



?>
