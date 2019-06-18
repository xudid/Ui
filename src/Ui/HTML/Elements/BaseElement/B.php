<?php
namespace Ui\HTML\Elements\BaseElement;
class B extends BaseElement{

	private $elementName ="b";

	public function __construct(){
		parent::__construct($this->elementName);
		return $this;
	}

}

?>