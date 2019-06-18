<?php 
namespace Brick\HtmlElements\NestedHtmlElement;
use Brick\HtmlElements\NestedHtmlElement\NestedHtmlElement;
use Brick\Tags\AudioStartTag;
class Audio extends NestedHtmlElement{


	private $elementName = "audio";
	protected $startTag = null;


	public function __construct(){
		parent::__construct($this->elementName);
		$this->startTag = new AudioStartTag();
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
    }


}



?>