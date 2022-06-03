<?php
namespace Ui\Widget\Table;

use Ui\HTML\Element\Nested\Div;

class RowGroup extends Div
{

    /**
     * RowGroup constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClass("corp");
        return $this;
    }
}