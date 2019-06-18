<?php 
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
class Aside extends NestedHtmlElement{


	private $elementName = "aside";


	public function __construct(){
		parent::__construct($this->elementName);
	}


}



?>