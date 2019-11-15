<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\Nested\Nested;


/**
 * Class TextArea
 * @package Ui\Widgets\Input
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class TextArea extends Nested
{
	/**
     * TextArea constructor.
     */
	public function __construct()
	{
		parent::__construct("textarea");
	}

	/**
	 * @param $name
	 * @return self
	 */
	public function setName(string $name){
		if(isset($name))
		{$this->startTag->setAttribute("name",$name);}
		return $this;
	}

	/**
	 * @param string $value
	 * @return $this
	 */
	public function setPlaceholder(string $value){
		$this->startTag->setAttribute("placeholder", $value);
		return $this;
	}

	public function setCols(int $num){
		$this->startTag->setAttribute("cols", $num);
		return $this;
	}

	public function setRows(int $num){
		$this->startTag->setAttribute("rows", $num);
		return $this;
	}

	public function setMinLength(int $num){
		$this->startTag->setAttribute("minlength", $num);
		return $this;
	}

	public function setMaxLength(int $num){
		$this->startTag->setAttribute("maxlength", $num);
		return $this;
	}

	public function setRequired()
	{
		$this->startTag->setAttribute("required", true);
		return $this;
	}

	public function setReadOnly()
	{
		$this->startTag->setAttribute("readonly", true);
		return $this;
	}

	public function setDisabled()
	{
		$this->startTag->setAttribute("disabled", true);
		return $this;
	}
}

