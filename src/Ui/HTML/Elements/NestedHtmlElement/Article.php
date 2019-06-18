<?php 
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Article extends NestedHtmlElement{


	private $elementName = "article";


	public function __construct(){
		parent::__construct($this->elementName);
	}


}



?>