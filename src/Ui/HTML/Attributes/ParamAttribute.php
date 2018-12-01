<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class ParamAttribute extends GlobalAttribute
{
	const nameAttribute = "name";
	const valueAttribute = "value";



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
