<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class ScriptAttribute extends GlobalAttribute
{
	const asyncAttribute = "async";
	const deferAttribute = "defer";
	const crossoriginAttribute = "crossorigin";
	const integrityAttribute = "integrity";
	const nomoduleAttribute = "nomodule ";
	const nonceAttribute = "nonce";
	const srcAttribute = "src";
	const textAttribute = "text";
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
