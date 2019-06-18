<?php 
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Fieldset extends NestedHtmlElement{


	private $elementName = "fieldset";


	public function __construct(){
		parent::__construct($this->elementName);
	}


}



?>