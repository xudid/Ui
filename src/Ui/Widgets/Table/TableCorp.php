<?php
namespace Ui\Widgets\Table;

use Ui\HTML\Elements\Nested\Div;

class TableCorp extends Div{

    /**
     * TableCorp constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClass("div-corp");
        return $this;
    }
}