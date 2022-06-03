<?php

namespace Ui\Utils;

use Exception;
use ReflectionClass;

class Enum
{
    public function __construct($name)
    {
        $c = new ReflectionClass($this);
        if (!in_array($name, $c->getConstants())) {
            throw new Exception();
        }
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->value;
    }
}
