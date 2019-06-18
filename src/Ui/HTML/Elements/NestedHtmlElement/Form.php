<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
use Ui\HTML\Tags\StartTag;
class Form extends NestedHtmlElement{


	private $elementName = "form";


	public function __construct(){
		parent::__construct($this->elementName);
		
	}

	public function setClass($class){
		if(isset($class))
		{$this->startTag->setAttribute("class",$class);}
	}

	public function setAction($action){
		if(isset($action))
		{$this->startTag->setAttribute("action",$action);}
	}

	public function setMethod($method){
		if(isset($method))
		{$this->startTag->setAttribute("method",$method);}
	}

	public function setName($name){
		if(isset($name))
		{$this->startTag->setAttribute("name",$name);}
	}


}



?>
