<?php
namespace Ui\Widgets\Table;
use Ui\HTML\Elements\Nested\Div;

/**
 * Class DivCell
 * @package Ui\Widgets\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Cell extends  Div{

    /**
     * @var bool $editable
     */
    private bool $editable = false;

    /**
     * @var mixed|null $value
     */
    private  $value = null;

    /**
     * DivCell constructor.
     * @param bool $editable
     * @param mixed|null $value
     */
    public function __construct($value, bool $editable=false)
    {
        parent::__construct();
        $this->editable = $editable;
        $this->value = $value;
        if($this->editable)
        {
            $this->setContentEditable();
        }
        if(is_array($value))
        {
            $value = implode("<br>", $value);
        }
        if (is_numeric($value)) {
            $value = (string)$value;
        }
        $this->add($value);
        $this->setClass('div-cell large-30');
        return $this;
    }
}
