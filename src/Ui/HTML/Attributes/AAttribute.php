<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class AAttribute extends GlobalAttribute
{
	const downloadAttribute = "download";
	const hrefAttribute = "href";
	const hreflangAttribute = "hreflang";
	const pingAttribute = "ping";
	const referrerpolicyAttribute = "referrerpolicy";
	const relAttribute = "rel";
	const targetAttribute = "target" ;
	const typeAttribute = "type" ;



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
