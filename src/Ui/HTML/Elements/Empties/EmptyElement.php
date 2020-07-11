<?php

namespace Ui\HTML\Elements\Empties;

use Ui\HTML\Elements\ElementInterface;
use Ui\HTML\Elements\Nested\Nested;
use Ui\HTML\Tags\StartTag;


/**
 * Class EmptyElement
 * @package Ui\HTML\Elements\Empties
 */
class EmptyElement implements ElementInterface
{
    protected ?Nested $parent = null;

    protected ?Nested $root = null;

    protected $index = '';

    protected StartTag $startTag;

    private $endTag = "" > "";

    protected string $contentString = "";

    /**
     * EmptyElement constructor.
     * @param string elementName HtmlElement name in start and end Tag
     */
    public function __construct(string $elementName)
    {
        $this->startTag = new StartTag($elementName);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $this->contentString = $this->startTag->__toString() . $this->contentString . $this->endTag . "\r\n";
        return $this->contentString;
    }


    /**
     * Set an Element attribute with value
     * @ return void
     * @param string $name Element Attribute name
     * @param string $value Element Attribute value
     * @return EmptyElement
     */
    public function setAttribute(string $name, $value)
    {
        $this->startTag->setAttribute($name, $value);
        return $this;
    }

    /**
     * @return string
     */
    public function getIndex(): string
    {
        return $this->index;
    }

    /**
     * @param string $index
     * @return self
     */
    public function setIndex(string $index)
    {
        $this->index = $index;
        return $this;
    }

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id) : self
    {
        $this->startTag->setAttribute("id", $id);
        return $this;
    }

    /**
     * @param string $class
     * @return self
     */
    public function setClass(string $class) : self
    {
        if (isset($class))
            $this->startTag->addCssClass($class);
        return $this;
    }

    /**
     * @return Nested|null
     */
    public function getParent(): ?Nested
    {
        return $this->parent;
    }

    /**
     * @param Nested|null $parent
     * @return EmptyElement
     */
    public function setParent(?Nested $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return Nested|null
     */
    public function getRoot(): ?Nested
    {
        return $this->root;
    }

    /**
     * @param Nested|null $root
     * @return EmptyElement
     */
    public function setRoot(?Nested $root): EmptyElement
    {
        $this->root = $root;
        return $this;
    }
}
