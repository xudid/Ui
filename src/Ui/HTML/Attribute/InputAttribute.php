<?php
namespace Ui\HTML\Attribute;

/**
 * This file contains InputAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * InputAttribute class contains Input element attributes and common attributes
 */
class InputAttribute extends GlobalAttribute
{
    const TYPE = "type";
    const ACCEPT = "accept";
    const AUTOCOMPLETE = "autocomplete";
    const AUTOFOCUS = "autofocus";
    const CAPTURE = "capture";
    const CHECKED = "checked";
    const DISABLED = "disabled";
    const FORM = "form";
    const FORM_ACTION = "formaction";
    const FORM_ENCTYPE = "formenctype";
    const FORM_METHOD = "formmethod";
    const FORM_TARGET = "formtarget";
    const HEIGHT = "height";
    const INPUT_MODE = "inputmode";
    const LIST = "list";
    const MAX ="max";
    const MAX_LENGTH = "maxlength";
    const MIN = "min";
    const MIN_LENGTH = "minlength";
    const MULTIPLE = "multiple";
    const NAME = "name";
    const PATTERN = "pattern";
    const PLACEHOLDER = "placeholder";
    const READONLY = "readonly";
    const REQUIRED = "required";
    const SELECTION_DIRECTION = "selectionDirection" ;
    const SELECTION_END = "selectionEnd";
    const SELECTION_START = "selectionStart";
    const SIZE = "size";
    const SPELLCHECK = "spellcheck";
    const SRC = "src";
    const STEP  = "step";
    const VALUE = "value";
    const WIDTH = "width";

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
