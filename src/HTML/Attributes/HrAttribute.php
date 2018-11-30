<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class HrAttribute extends GlobalAttribute
{
	const widthAttribute = "width";
	const alignAttribute = "align";
	const colorAttribute = "color";
	const noshadeAttribute = "noshade";
	const sizelangAttribute = "size";


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
