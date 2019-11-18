<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;
use Ui\HTML\Tags\StartTag;

/**
 * Class Form
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Form extends Nested{
	/**
	 * Form constructor.
	 */
	public function __construct(){
		parent::__construct("form");
		return $this;
	}

	/**
	 * @param string $action
	 * @return Form
	 */
	public function setAction(string $action){
		if(isset($action))
		{$this->startTag->setAttribute("action",$action);}
		return $this;
	}

	/**
	 * @param string $method
	 * @return Form
	 */
	public function setMethod(string $method){
		if(isset($method))
		{$this->startTag->setAttribute("method",$method);}
		return $this;
	}

	/**
	 * @param string $name
	 * @return Form
	 */
	public function setName(string $name){
		if(isset($name))
		{$this->startTag->setAttribute("name",$name);}
		return $this;
	}
}
