<?php 
namespace Brick\HtmlElements\NestedHtmlElement;
use Brick\HtmlElements\NestedHtmlElement\NestedHtmlElement;
class Address extends NestedHtmlElement{


	private $elementName = "address";


	public function __construct(){
		parent::__construct($this->elementName);
	}


}



?>