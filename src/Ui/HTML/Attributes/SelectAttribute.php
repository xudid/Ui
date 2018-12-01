<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class SelectAttribute extends GlobalAttribute
{
	const autofocusAttribute = "autofocus";
	const disabledAttribute = "disabled";
	const formAttribute = "form";
	const multipleAtteibute ="multiple";
  const requiredAttribute ="required";

	const nameAttribute = "name";
	const sizeAttribute = "size";


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
