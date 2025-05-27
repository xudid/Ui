<?php
namespace Xudid\Ui\Widget\Input;

use Xudid\Ui\HTML\Element\Nested\Nested;


/**
 * Class TextArea
 * @package Ui\Widget\Input
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

	public function setName(string $name): static
	{
		if(isset($name)) {
			$this->startTag->setAttribute("name",$name);
		}

		return $this;
	}

	public function setPlaceholder(string $value): static
	{
		$this->startTag->setAttribute("placeholder", $value);

		return $this;
	}

	public function setCols(int $num){
		$this->startTag->setAttribute("cols", $num);
		return $this;
	}

	public function setRows(int $num): static
	{
		$this->startTag->setAttribute("rows", $num);

		return $this;
	}

	public function setMinLength(int $num)
	{
		$this->startTag->setAttribute("minlength", $num);

		return $this;
	}

	public function setMaxLength(int $num): static
	{
		$this->startTag->setAttribute("maxlength", $num);

		return $this;
	}

	public function setRequired(): static
	{
		$this->startTag->setAttribute("required", true);

		return $this;
	}

	public function setReadOnly(): static
	{
		$this->startTag->setAttribute("readonly", true);

		return $this;
	}

	public function setDisabled(): static
	{
		$this->startTag->setAttribute("disabled", true);

		return $this;
	}
}

