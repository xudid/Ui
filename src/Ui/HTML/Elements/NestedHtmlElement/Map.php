<?php
namespace Brick\HtmlElements\NestedHtmlElement;
use Brick\HtmlElements\NestedHtmlElement\NestedHtmlElement;
use Brick\Tags\MapStartTag;
class Map extends NestedHtmlElement{


	private $elementName = "map";
	protected $startTag = null;


	public function __construct($name){
		parent::__construct($this->elementName);
		$this->startTag = new MapStartTag();
		$this->startTag->setAttribute("name", $name);
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;

    }


}



?>
