<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class OptionAttribute extends GlobalAttribute
{
	const disabledAttribute = "disabled";
	const labelAttribute = "label";
	const selectedAttribute = "selected";
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
