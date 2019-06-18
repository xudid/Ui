<?php 
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Obj extends NestedHtmlElement{


	private $elementName = "object";
	protected $startTag = null;


	public function __construct(){
		parent::__construct($this->elementName);
		
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
        
    }


}



?>