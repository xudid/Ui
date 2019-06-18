<?php
namespace Ui\HTML\Elements\EmptyElements;

class Br extends EmptyElement{

	private $elementName ="br";

	public function __construct(){
		parent::__construct($this->elementName);
	}

}

?>