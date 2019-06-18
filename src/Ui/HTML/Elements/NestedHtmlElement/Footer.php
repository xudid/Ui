<?php 
namespace Brick\HtmlElements\NestedHtmlElement;
use Brick\HtmlElements\NestedHtmlElement\NestedHtmlElement;
class Footer extends NestedHtmlElement{


	private $elementName = "footer";


	public function __construct(){
		parent::__construct($this->elementName);
	}


}



?>