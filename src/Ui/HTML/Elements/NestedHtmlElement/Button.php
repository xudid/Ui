<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
use Ui\HTML\Tags\StartTag;
class Button extends NestedHtmlElement{


	private $elementName = "button";
	
	public function __construct($text){
		parent::__construct($this->elementName);
		if(isset($text)){
			$this->addElement($text);
		}
		
	}

	public function setAttribute($name, $value)
	{
        $this->startTag->setAttribute($name, $value);
        return $this;
  }


}



?>
