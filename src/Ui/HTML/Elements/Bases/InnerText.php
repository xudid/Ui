<?php


namespace Ui\HTML\Elements\Bases;


use Ui\HTML\Elements\ElementInterface;
use Ui\HTML\Elements\Nested\Nested;

class InnerText implements ElementInterface
{
	private $index;
	/**
	 * @var string
	 */
	private $text;


	/**
	 * InnerText constructor.
	 * @param string $text
	 */
	public function __construct($text)
	{
		$this->text = $text;
	}

	public function getIndex()
	{
		// TODO: Implement getIndex() method.
	}

	public function setIndex(string $index)
	{
		// TODO: Implement setIndex() method.
	}

	public function setId(string $id)
	{
		// TODO: nothing
	}

	public function setAttribute(string $name, string $value)
	{
		// nothing
	}

	public function __toString()
	{
		return $this->text;
	}

	public function setClass(string $css)
	{
		// nothing
	}

	public function getParent(): ?Nested
	{
		return !is_null($this->parent)?$this->parent:false;
	}

	public function setParent(?Nested $parent): Base
	{
		$this->parent = $parent;
	}

	public function getRoot(): ?Nested
	{
		return $this->getParent()?$this->getParent()->getRoot():false;
	}

	public function setRoot(?Nested $root)
	{
		$this->root = $root;

	}
}