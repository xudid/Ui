<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class TextAreaAttribute extends GlobalAttribute
{
	const autocompleteAttribute = "autocompleteS";
	const autofocus = "autofocus";
	const colsAttribute = "cols";
	const disabledAttribute = "disabled";
	const formAttribute = "form";
	const maxlengthAttribute = "maxlength";
	const minlengthAttribute = "minlength" ;
	const nameAttribute = "name" ;
  const placeholderAttribute = "placeholder";
  const readonlyAttribute = "readonly";
  const requiredAttribute = "required";
  const rowsAttribute = "rows";
  const spellcheckAttribute ="spellcheck";
  const wrapAttribute = "wrap";



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
