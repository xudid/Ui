<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class UlAttribute extends GlobalAttribute
{
	const compactAttribute = "compact";

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
