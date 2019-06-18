<?php 
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Ol extends NestedHtmlElement{


	private $elementName = "ol";
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