<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class OlAttribute extends GlobalAttribute
{
	const compactAttribute = "compact";

	const typeAttribute = "type";
	const reversedAttribute = "reversed";
	const startAttribute = "start";


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
