<?php
namespace Ui\Widget\Table\Cell;
use Ui\HTML\Element\Base\Span;
use Ui\HTML\Element\Nested\Div;

/**
 * Class DivCell
 * @package X\Widget\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Cell extends  Div{

    private bool $editable = false;
    private  $value = null;

    /**
     * Cell constructor.
     * @param bool $editable
     * @param mixed|null $value
     */
    public function __construct($value, bool $editable=false)
    {
        parent::__construct();
        $this->editable = $editable;
        $this->setValue($value);
        if($this->editable)
        {
            $this->setContentEditable();
        }

        $this->setClass('cell');
        return $this;
    }

    public function setValue($value)
    {
        if(is_array($value))
        {
            $value = implode(new Span(''), $value);
        }
        if (is_numeric($value)) {
            $value = (string)$value;
        }
        $this->value = $value;
        return $this;
    }

    public function setClass(string $class):static
    {
        return parent::setClass('cell ' . $class);
    }

    public function __toString(): string
    {
        $this->add($this->value);
        return parent::__toString();
    }
}
