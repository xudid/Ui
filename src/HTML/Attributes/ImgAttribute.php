<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class ImgAttribute extends GlobalAttribute
{
	const altAttribute = "alt";
	const crossoriginAttribute = "crossorigin";
	const heightAttribute = "height";
	const ismapAttribute = "ismap";
	const sizeslangAttribute = "sizes";
	const longdescAttribute = "longdesc";
	const referrerpolicyAttribute = "referrerpolicy";
	const srcAttribute = "src";
	const srcsetAttribute = "srcset";
	const widthAttribute = "width";
	const usemapAttribute = "usemap";


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
