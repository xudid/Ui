<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Option extends NestedHtmlElement{


	private $elementName = "option";
	public function __construct($display,$value){
		parent::__construct($this->elementName);
		
		$this->startTag->setAttribute("value", $value);
		$this->addElement($display);
		return $this;
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
    }


}



?>
