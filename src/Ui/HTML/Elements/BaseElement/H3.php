<?php
namespace Ui\HTML\Elements\BaseElement;
class H3 extends BaseElement{

	private $elementName ="h3";

	public function __construct($text){
		parent::__construct($this->elementName);
		if(isset($text)){
				$this->setContentString($text);
		}
		return $this;
	}

}

?>