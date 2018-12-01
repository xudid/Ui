<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class ObjectAttribute extends GlobalAttribute
{
	const dataAttribute = "data";

	const formAttribute = "form";
	const heightAttribute = "height";
	const nameAttribute	= "name";
	const typeAttribute = "type";
	const typemustmatchAttribute = "typemustmatch ";
	const usemapAttribute = "usemap";
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
