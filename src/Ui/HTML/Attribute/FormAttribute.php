<?php
namespace Ui\HTML\Attribute;
/**
 * This file contains FormAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * FormAttribute class contains Form element attributes and common attributes
 */
class FormAttribute extends GlobalAttribute
{
    const ACCEPT_CHARSET = "accept-charset";
    const ACTION = "action";
    const AUTOCOMPLETE = "autocomplete";
    const ENCTYPE = "enctype";
    const METHOD = "method";
    const NAME = "name";
    const NOVALIDATE = "novalidate";
    const TARGET = "target";

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
