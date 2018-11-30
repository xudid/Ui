<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class LiAttribute extends GlobalAttribute
{
	const valueAttribute = "value";

	const typeAttribute = "type";




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
