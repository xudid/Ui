<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class MetaAttribute extends GlobalAttribute
{
	const charsetAttribute = "charset";
	const contentAttribute = "content";
	const http_equivAttribute = "http-equiv";
	const refreshAttribute = "name";
	const nameAttribute = "sizes";
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
