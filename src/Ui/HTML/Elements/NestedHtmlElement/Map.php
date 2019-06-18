<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Map extends NestedHtmlElement{


	private $elementName = "map";
	protected $startTag = null;


	public function __construct($name){
		parent::__construct($this->elementName);
		
		$this->startTag->setAttribute("name", $name);
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;

    }


}



?>
