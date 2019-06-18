<?php 
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
class Footer extends NestedHtmlElement{


	private $elementName = "footer";


	public function __construct(){
		parent::__construct($this->elementName);
	}


}



?>