<?php
/**
 * This file contains TextAreaAttribute class and its methods.
 * @package Brick\Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */
namespace Brick\Ui\HTML\Attributes;

/**
 *
 * TextAreaAttribute class contains TextArea element attributes and common attributes
 *
 */
class TextAreaAttribute extends GlobalAttribute
{
    const AUTOCOMPLETE = "autocomplete";
    const AUTOFOCUS = "autofocus";
    const COLS = "cols";
    const DISABLED = "disabled";
    const FORM = "form";
    const MAXLENGTH = "maxlength";
    const MINLENGTH = "minlength" ;
    const NAME = "name" ;
    const PLACEHOLDER = "placeholder";
    const READONLY = "readonly";
    const REQUIRED = "required";
    const ROWS = "rows";
    const SPELLCHECK ="spellcheck";
    const WRAP = "wrap";

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
