<?php

namespace Ui\HTML\Element\Simple;

use Ui\HTML\Element\Nested\Nested;
use Ui\HTML\Element\SimpleInterface;
use Ui\HTML\Tag\Start;

/**
 * Class Simple
 * @package Ui\HTML\Element\Simple
 */
class Simple implements SimpleInterface
{
    protected ?Nested $parent = null;

    protected ?Nested $root = null;

    protected $index = '';

    protected Start $startTag;

    private $endTag = "" > "";

    protected string $contentString = "";

    public function __construct(string $elementName)
    {
        $this->startTag = new Start($elementName);
    }

    public function __toString()
    {
        $this->contentString = $this->startTag->__toString() . $this->contentString . $this->endTag . "\r\n";
        return $this->contentString;
    }


    public function setAttribute(string $name, string$value):static
    {
        $this->startTag->setAttribute($name, $value);
        return $this;
    }

    public function getIndex(): string
    {
        return $this->index;
    }

    public function setIndex(string $index):static
    {
        $this->index = $index;
        return $this;
    }

    public function setId(string $id):static
    {
        $this->startTag->setAttribute("id", $id);
        return $this;
    }

    public function setClass(string $class):static
    {
        if (isset($class))
            $this->startTag->addCssClass($class);
        return $this;
    }

    public function getParent():?Nested
    {
        return $this->parent;
    }

    public function setParent(?Nested $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    public function getRoot(): ?Nested
    {
        return $this->root;
    }

    public function setRoot(?Nested $root): static
    {
        $this->root = $root;
        return $this;
    }
}
