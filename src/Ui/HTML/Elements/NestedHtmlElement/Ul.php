<?php 
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
use Ui\HTML\Tags\StartTag;
class Ul extends NestedHtmlElement{


	private $elementName = "ul";
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