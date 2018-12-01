<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class TrackAttribute extends GlobalAttribute
{
	const defaultsAttribute = "default";
	const kindAttribute = "kind";
	const labelAttribute = "label";
	const srcAttribute = "src";
	const srclangAttribute = "srclang";



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
