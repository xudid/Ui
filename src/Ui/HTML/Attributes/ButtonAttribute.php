<?php
namespace Ui\HTML\Attributes;
/**
 * This file contains ButtonAttribute class and its methods.
 * @package Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */


/**
 *
 * ButtonAttribute class contains Link element attributes and common attributes
 *
 */
class ButtonAttribute extends GlobalAttribute
{
    const AUTOFOCUS = "autofocus";
    const DISABLED = "disabled";
    const FORM = "form";
    const FORM_ACTION = "formaction";
    const FORM_ENCTYPE = "formenctype";
    const FORM_METHOD = "formmethod";
    const FORM_NO_VALIDATE = "formnovalidate";
    const FORM_TARGET = "formtarget";
    const NAME = "name";
    const TYPE = "type";
    const VALUE = "value";

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
