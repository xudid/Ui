<?php
namespace Ui\Widgets\Views;

use Ui\HTML\Elements\Bases\{Base, H1, H2, H3, H4, H5, H6};

/**
 * @author Didier Moindreau <dmoindreau@gmail.com>
 * @license M.I.T
 */
class Title extends Base
{
    private $element = null;
    /**
     * [__construct description]
     * @param integer $level :[description]
     * @param string $text :[<description>]
     * @return self :[<description>]
     */
    function __construct(int $level, string $text)
    {
        $elementname = 'Ui\HTML\Elements\Bases\H'.$level;
        $this->element = new $elementname($text);
        return $this;
    }

    public function  __toString()
    {
        return $this->element->__toString();
    }

    public function setId($id)
    {
        $this->element->setId($id);
    }

    public function setAttribute($name, $value)
    {
        $this->element->setAttribute($name, $value);
    }

    public function setClass(string $class)
	{
		return  $this->element->setClass($class);
	}


}