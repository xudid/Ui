<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class LinkAttribute extends GlobalAttribute
{
	const asAttribute = "as";
	const crossoriginAttribute = "crossorigin";
	const hrefAttribute = "href";
	const hreflangAttribute = "hreflang";
	const integrityAttribute = "integrity";
	const mediaAttribute = "media";
	const methodsAttribute = "methods";
	const referrerpolicyAttribute = "referrerpolicy";
	const relAttribute = "rel";
	const sizesAttribute = "sizes";
	const titleAttribute = "title";
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
