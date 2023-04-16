<?php

namespace Ui\HTML\Element\Nested;

use ArrayAccess;
use ReflectionObject;
use Ui\HTML\Element\Base\Base;
use Ui\HTML\Element\Base\InnerText;
use Ui\HTML\Element\SimpleInterface;

/**
 * Class Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Nested extends Base implements ArrayAccess
{
    protected array $children = [];
    protected int $lastNumericIndex = 0;

    public function __construct(string $elementName)
    {
        parent::__construct($elementName);
        $this->children = array();
        return $this;
    }

    public function feed(...$children)
    {
        foreach ($children as $child) {
            $this->add($child);
        }
        return $this;
    }

    public function isRoot(): bool
    {
        return is_null($this->root);
    }

    public function __toString()
    {
        $this->generateContentString();
        return $this->contentString;
    }

    public function setContentString($string): static
    {
        $this->children = [$string];
        $this->generateContentString();
        return $this;
    }

    public function add($element)
    {
        if ($element instanceof SimpleInterface) {
            $index = $element->getIndex();
            if ($index && !array_key_exists($index, $this->children)) {
                $this->children[$index] = $element;
            } else {
                $this->children[] = $element;
                $index = $this->lastNumericIndex++;
                $element->setIndex($index);
            }
        }
        if (is_string($element) && !empty($element)) {
            $innerText = new InnerText($element);
            $innerText->setIndex($this->lastNumericIndex++);
            $this->children[] = $element;
        }
        return $this;
    }

    public function remove($element)
    {
        if ($element != null && !is_string($element)) {
            $this->children[$element->getIndex()] = null;
        }
    }

    public function setFirst($element)
    {
        if ($element != null && !is_string($element)) {
            $index = $element->getIndex();
            if (
                $index
                && !array_key_exists($index, $this->children)) {
                $temp[$index] = $element;
            } elseif (empty($index)) {
                $index = $this->lastNumericIndex++;
                $element->setIndex($index);
                $temp[$index] = $element;
            } else {
                $temp[$index] = $element;
                $this->children[$index] = null;
            }
            array_filter($this->children);
            $this->children = array_merge($temp, $this->children);
        }
        return $this;
    }

    protected function generateContentString()
    {
        $this->contentString = $this->startTag;
        foreach ($this->children as $child) {
            $this->contentString .= $this->getChildsString($child);
        }
        $this->contentString = $this->contentString . $this->endTag;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    protected function getChildsString($child)
    {
        if ($child !== $this) {
            if (is_array($child)) {
                foreach ($child as $subchild) {
                    return $this->getChildsString($subchild);
                }
            }
            if (is_object($child) && $child instanceof SimpleInterface) {
                return $child->__toString();
            }
        }

        return $child;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->children[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->children[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->children[] = $value;
        } else {
            $this->children[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->children[$offset]);
    }

    public function __call($name, $arguments)
    {
        if (property_exists(get_class($this), $name)) {
            $result = $this;
            $ro = new ReflectionObject($this);
            $property = $ro->getProperty($name);
            $propertyAccessModified = false;
            if ($property->isPrivate() || $property->isProtected()) {
                $propertyAccessModified = true;
                $property->setAccessible(true);
            }
            if ($arguments) {
                $property->setValue($arguments);
            } else {
                $result = $property->getValue($this);
            }
            if ($propertyAccessModified) {
                $property->setAccessible(false);
            }

            return $result;
        }
    }
}
