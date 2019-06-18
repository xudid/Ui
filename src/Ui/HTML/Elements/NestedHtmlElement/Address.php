<?php 
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
class Address extends NestedHtmlElement{


	private $elementName = "address";


	public function __construct(){
		parent::__construct($this->elementName);
	}


}



?>