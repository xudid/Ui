<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class ButtonAttribute extends GlobalAttribute
{
	const autofocusAttribute = "autofocus";
	const disabledAttribute = "disabled";
	const formAttribute = "form";
	const formactionAttribute = "formaction";
	const formenctypeAttribute = "formenctype";
	const formmethodAttribute = "formmethod";
	const formnovalidateAttribute = "formnovalidate";
	const formtargetAttribute = "formtarget";
	const nameAttribute = "name";
	const typeAttribute = "type";
	const valueAttribute = "value";

	protected $name = "";

    protected $value = "";



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
