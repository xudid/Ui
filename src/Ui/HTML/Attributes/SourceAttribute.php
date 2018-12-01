<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class SourceAttribute extends GlobalAttribute
{
	const sizesAttribute = "sizes";
	const srcsetAttribute = "srcset";
	const srcAttribute = "src";
	const typeAttribute = "type";
	const mediaAttribute = "media";



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
