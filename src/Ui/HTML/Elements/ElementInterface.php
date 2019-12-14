<?php


namespace Ui\HTML\Elements;


use Ui\HTML\Elements\Bases\Base;
use Ui\HTML\Elements\Nested\Nested;

interface ElementInterface
{
	public function getIndex();
	public function setIndex(string $index);
	public function setId(string $id);
	public function setAttribute(string $name, string $value);
	public function __toString();
	public function setClass(string $css);
	public function getParent():?Nested;
	public function setParent(?Nested $parent);
	public function getRoot(): ?Nested;
	public function setRoot(?Nested $root);

}