<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class InputAttribute extends GlobalAttribute
{
	const typeAttribute = "type";
	const acceptAttribute = "accept";
	const autocompleteAttribute = "autocomplete";
	const autofocusAttribute = "autofocus";
	const captureAttribute = "capture";
	const checkedAttribute = "checked";
	const disabledAttribute = "disabled";
	const formAttribute = "form";
	const formactionAttribute = "formaction";
	const formenctypeAttribute = "formenctype";
	const formmethodAttribute = "formmethod";
	const formtargetAttribute = "formtarget";
	const heightAttribute = "height";
	const inputmodeAttribute = "inputmode";
	const listAttribute = "list";
	const maxAttribute ="max";
	const maxlengthAttriute = "maxlength";
	const minAttribute = "min";
	const minlengthAttribute = "minlength";
	const multipleAttribute = "multiple";
	const nameAttribute = "name";
	const patternAttribute = "pattern";
	const placeholderAttribute = "placeholder";
	const readonlyAttribute = "readonly";
	const requiredAttribute = "required";
	const selectionDirectionAttribute = "selectionDirection" ;
	const selectionEndAttribute = "selectionEnd";
	const selectionStartAttribute = "selectionStart";
    const sizeAttribute = "size";
    const spellcheckAttribute = "spellcheck";
    const srcAttribute = "src";
    const stepAttribute  = "step";
    const valueAttribute = "value";
    const widthAttribute = "width";

	protected $name = "";

    protected $value = "";

    protected $validAttributes;

	function __construct($name,$value)
	{
		parent::__construct($name,$value);
        $this->value = $value;
	}

	public function __toString()
    {
        $string = $this->name . '="' . $this->value . '"';
        return $string;
    }
}

?>
