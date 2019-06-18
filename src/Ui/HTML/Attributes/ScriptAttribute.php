<?php
namespace Ui\HTML\Attributes;

/**
 * This file contains ScriptAttribute class and its methods.
 * @package Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */

/**
 *
 * ScriptAttribute class contains Link element attributes and common attributes
 *
 */
class ScriptAttribute extends GlobalAttribute
{
    const ASYNC = "async";
    const DEFER = "defer";
    const CROSS_ORIGIN = "crossorigin";
    const INTEGRITY = "integrity";
    const NO_MODULE = "nomodule ";
    const NONCE = "nonce";
    const SRC = "src";
    const TEXT = "text";
    const TYPE = "type" ;

    /**
     * Construct the Attribute from its name and value
     * @param string $name the name of the Attribute
     * @param mixed $value the value of the Attribute a string or an array
     * for the class attribute
     */

    public function __construct($name, $value)
    {
        parent::__construct($name, $value);
        $this->value = $value;
    }
}
