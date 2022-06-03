<?php

namespace Ui\HTML\Element\Base;

use Ui\HTML\Element\Nested\Nested;
use Ui\HTML\Element\SimpleInterface;
use Ui\HTML\Tag\End;
use Ui\HTML\Tag\Start;

/**
 * Class Base
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Base implements SimpleInterface
{
    protected $index;
    protected ?Nested $parent = null;
    protected ?Nested $root = null;
    private string $elementName;

    protected Start $startTag;
    protected End $endTag;
    protected string $contentString = "";

    public function __construct($elementName)
    {
        $this->elementName = $elementName;
        $this->startTag = new Start($this->elementName);
        $this->endTag = new End($this->elementName);
        return $this;
    }

    public function __toString()
    {
        $this->contentString = $this->startTag->__toString() . $this->contentString . $this->endTag->__toString();
        return $this->contentString;
    }

    public function setContentString($string): static
    {
        $this->contentString = $string;
        return $this;
    }

    public function setAttribute(string $name, $value): static
    {
        $this->startTag->setAttribute($name, $value);
        return $this;
    }

    public function setClass(string $class): static
    {
        if (isset($class))
            $this->startTag->addCssClass($class);
        return $this;
    }

    public function addClass(string $class): static
    {
        $this->startTag->addCssClass($class);
        return $this;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function setIndex(string $index): SimpleInterface
    {
        $this->index = $index;
        return $this;
    }

    public function setId(string $id): SimpleInterface
    {
        $this->index = $id;
        $this->startTag->setAttribute("id", $id);
        return $this;
    }

    public function setClasses(array $classes): SimpleInterface
    {
        if (is_array($classes)) {
            $this->setAttribute('class', implode(', ', $classes));
        }
        return $this;
    }

    public function setParent(?Nested $parent): SimpleInterface
    {
        $this->parent = $parent;
        return $this;
    }

    public function getParent(): ?Nested
    {
        return !is_null($this->parent)
            ? $this->parent
            : null;
    }

    public function getRoot(): ?Nested
    {
        return $this->getParent()?->getRoot();
    }

    public function setRoot(?Nested $root): SimpleInterface
    {
        $this->root = $root;
        return $this;
    }
}
