<?php
namespace Brick\HtmlElements\BaseElement;
class H6 extends BaseElement{

	private $elementName ="h6";

	public function __construct($text){
		parent::__construct($this->elementName);
		if(isset($text)){
				$this->setContentString($text);
		}
		return $this;
	}

}

?>