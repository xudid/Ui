<?php
namespace Ui\HTML\Elements\NestedHtmlElement;

use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Div extends NestedHtmlElement{


	private $elementName = "div";


	public function __construct(){
		parent::__construct($this->elementName);
	}
	public function setClass($class){
 	 $this->startTag->setAttribute("class",$class);
  }

	public function setId($id){
		$this->startTag->setAttribute("id",$id);
	}

	public function setOnClick($action){
 	 $this->startTag->setAttribute("onclick",$action);
  }

	public function setContentEditable(){
 	 $this->startTag->setAttribute("contenteditable", "true");
  }
}



?>
