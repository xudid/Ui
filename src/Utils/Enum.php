<?php
namespace Brick\Utils;

use ReflectionClass;

/**
 *
 * @author didux
 *        
 */
class Enum
{

    /**
     */
    public function __construct($name)
    {
        $c = new ReflectionClass($this);
        if (! in_array($name, $c->getConstants())) {
            throw IllegalArgumentException();
        }
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->value;
    }
}

