<?php
namespace Ui\HTML\Elements\BaseElement;
class H5 extends BaseElement{

	private $elementName ="h5";

	public function __construct($text){
		parent::__construct($this->elementName);
		if(isset($text)){
				$this->setContentString($text);
		}
		return $this;
	}

}

?>