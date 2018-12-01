<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class EmbedAttribute extends GlobalAttribute
{
	const heightAttribute = "height";
	const srcAttribute = "src";
	const typeAttribute = "type";
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
