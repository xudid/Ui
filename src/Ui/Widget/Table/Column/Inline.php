<?php

namespace Ui\Widget\Table\Column;

use Ui\HTML\Element\Nested\Div;
use Ui\Widget\Table\Cell\Cell;

/**
 * Class Inline
 * @package X\Widget\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 30/10/2019.
 */
class Inline extends Div
{
    public function __construct(Column $tableColumn, $datas)
    {
        parent::__construct();
        $this->setClass("div-row");
        $this->add(new Cell($tableColumn->getHeader(),false));
        foreach ($datas as $data)
        {
            $this->add(new Cell($data,false));
        }
    }

    public function cells()
    {
        return $this->children;
    }

    public function firstCell()
    {
        if (count($this->children) > 0) {
            return reset($this->children);
        }
        return null;
    }
}
