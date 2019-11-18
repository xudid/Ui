<?php
namespace Ui\HTML\Elements\BaseElement;
class H6 extends BaseElement{

	private $elementName ="h6";

    /**
     *  
     * @param string $text :[description]
     */
	public function __construct(string $text){
		parent::__construct($this->elementName);
		if(isset($text)){
				$this->setContentString($text);
		}
		return $this;
	}
}
