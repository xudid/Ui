<?php 
namespace Brick\HtmlElements\NestedHtmlElement;
use Brick\HtmlElements\NestedHtmlElement\NestedHtmlElement;
use Brick\Tags\ObjectStartTag;
class Object extends NestedHtmlElement{


	private $elementName = "object";
	protected $startTag = null;


	public function __construct(){
		parent::__construct($this->elementName);
		$this->startTag = new ObjectStartTag();
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
        
    }


}



?>