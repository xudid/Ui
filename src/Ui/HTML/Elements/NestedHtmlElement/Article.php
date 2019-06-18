<?php 
namespace Brick\HtmlElements\NestedHtmlElement;
use Brick\HtmlElements\NestedHtmlElement\NestedHtmlElement;
class Article extends NestedHtmlElement{


	private $elementName = "article";


	public function __construct(){
		parent::__construct($this->elementName);
	}


}



?>