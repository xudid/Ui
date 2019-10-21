<?php
namespace Ui\HTML\Attributes;

/**
 * This file contains SelectAttribute class and its methods.
 * @package Ui\HTML\Attributes
 * @author Didier Moindreau
 * SelectAttribute class contains Select element attributes
 * and GlobalAttributes
 */
class SelectAttribute extends GlobalAttribute
{
    const AUTOFOCUS = "autofocus";
    const DISABLED = "disabled";
    const FORM = "form";
    const MULTIPLE ="multiple";
    const REQUIRED ="required";
    const NAME = "name";
    const SIZE = "size";

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
