<?php 
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Audio extends NestedHtmlElement{


	private $elementName = "audio";
	


	public function __construct(){
		parent::__construct($this->elementName);
		
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
    }


}



?>