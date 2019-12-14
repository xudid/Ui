<?php


namespace Ui\HTML\Elements\Bases;


class Span extends Base
{
	public function __construct($text){
		parent::__construct("span");
		if(isset($text)){
			$this->setContentString($text);
		}
		return $this;
	}
}