<?php
namespace Ui\Widget\View;

use Ui\HTML\Element\Base\{Base, H1, H2, H3, H4, H5, H6};

/**
 * @author Didier Moindreau <dmoindreau@gmail.com>
 * @license M.I.T
 */
class Title extends Base
{
    private $element = null;
    function __construct(int $level, string $text)
    {
        $elementname = 'X\HTML\Elements\Bases\H'.$level;
        $this->element = new $elementname($text);
        return $this;
    }

    public function  __toString()
    {
        return $this->element->__toString();
    }

    public function setClass(string $class):static
	{
		return  $this->element->setClass($class);
	}
}
