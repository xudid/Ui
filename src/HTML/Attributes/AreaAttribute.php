<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class AreaAttribute extends GlobalAttribute
{
	const altAttribute = "alt";
	const coordsAttribute = "coords";
	const downloadAttribute = "download";
	const hrefAttribute = "href";
	const hreflangAttribute = "hreflang";
	const mediaAttribute = "media";
	const referrerpolicyAttribute ="referrerpolicy ";
	const relAtttibute = "rel";
	const shapeAttribute ="shape";
	const targetAttribute = "target";

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
