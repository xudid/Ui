<?php

namespace Ui\HTML\Elements\Bases;

use Ui\HTML\Elements\ElementInterface;
use Ui\HTML\Elements\Nested\Nested;
use Ui\HTML\Tags\EndTag;
use Ui\HTML\Tags\StartTag;

/**
 * Class Base
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Base implements ElementInterface
{

    protected ?Nested $parent = null;

    protected ?Nested $root = null;

    protected $index = '';

    private $elementName = "";

    protected $startTag = null;

    protected $endTag = null;

    protected $contentString = "";

    /**
     * Base constructor.
     * @param $elementName
     * @return self
     */
    public function __construct($elementName)
    {
        $this->elementName = $elementName;
        $this->startTag = new StartTag($this->elementName);
        $this->endTag = new EndTag($this->elementName);
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $this->contentString = $this->startTag->__toString() . $this->contentString . $this->endTag->__toString();
        return $this->contentString;
    }

    /**
     * @param $string
     * @return $this
     */
    public function setContentString($string)
    {
        $this->contentString = $string;
        return $this;
    }


    /**
     * Set an Element attribute with value
     * @ return self
     * @ param name Element Attribute name
     * @ param value Element Attribute value
     */
    public function setAttribute($name, $value)
    {
        $this->startTag->setAttribute($name, $value);
        return $this;
    }

    /**
     * @param $class
     * @return self
     */
    public function setClass(string $class)
    {
        if (isset($class))
            $this->startTag->setAttribute("class", $class);
        return $this;
    }

    /**
     * @param string $class
     * @return self
     */
    public function addClass(string $class)
    {
        $this->startTag->addCssClass($class);
        return $this;
    }

    public function getIndex()
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
     * @param string $index
     * @return self
     */
    public function setId(string $id)
    {
        $this->index = $id;
        $this->startTag->setAttribute("id", $id);
        return $this;
    }


    /**
     * @param array $classes
     * @return $this
     */
    public function setClasses(array $classes)
    {
        if (is_array($classes)) {
            $this->setAttribute("class", $classes);
        }
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
     * @return Base
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
     * @return Base
     */
    public function setRoot(?Nested $root): Base
    {
        $this->root = $root;
        return $this;
    }
}
