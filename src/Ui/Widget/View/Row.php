<?php


namespace Ui\Widget\View;


use Ui\HTML\Element\Nested\Div;

class Row extends Div
{
    private $class = 'd-row';
    public function __construct(...$children)
    {
        parent::__construct($children);
        $this->setClass($this->class);
    }
}
