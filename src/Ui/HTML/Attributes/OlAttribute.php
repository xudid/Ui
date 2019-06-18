<?php
/**
 * This file contains LinkAttribute class and its methods.
 * @package Brick\Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */
namespace Brick\Ui\HTML\Attributes;

/**
 *
 * LinkAttribute class contains Link element attributes and common attributes
 *
 */
class OlAttribute extends GlobalAttribute
{
    const COMPACT = "compact";
    const TYPE = "type";
    const REVERSED = "reversed";
    const START = "start";

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
