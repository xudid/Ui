<?php
namespace Ui\HTML\Elements\BaseElement;
class H1 extends BaseElement{

	private $elementName ="h1";

	public function __construct($text){
		parent::__construct($this->elementName);
		if(isset($text)){
				$this->setContentString($text);
		}
		return $this;
	}

}

?>