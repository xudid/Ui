<?php
namespace Ui\HTML\Elements\Empties;

/**
 * Class Input
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Input extends EmptyElement
{
	/**
	 * Input constructor.
	 */
	public function __construct()
	{
		parent::__construct("input");
		return $this;
	}

	/**
	 * @param string $value
	 * @return self
	 */
	public function SetPlaceholder(string $value){
		$this->startTag->setAttribute("placeholder", $value);
		return $this;
	}

	/**
	 * @param string $value
	 * @return self
	 */
	public function setValue(string $value){
		$this->startTag->setAttribute("value", $value);
		return $this;
	}
	/**
	 * @param string $value
	 * @return self
	 */
	public function setName(string $value){
		$this->startTag->setAttribute("name", $value);
		return $this;
	}

	public function setRequired()
	{
		$this->startTag->setAttribute("required", true);
		return $this;
	}
}

