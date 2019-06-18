<?php 
namespace Brick\HtmlElements\NestedHtmlElement;
use Brick\HtmlElements\NestedHtmlElement\NestedHtmlElement;
class Aside extends NestedHtmlElement{


	private $elementName = "aside";


	public function __construct(){
		parent::__construct($this->elementName);
	}


}



?>