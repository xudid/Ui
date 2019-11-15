<?php


namespace Ui\Widgets\Table;


use Ui\HTML\Elements\Nested\Div;

/**
 * Class InlineColumn
 * @package Ui\Widgets\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 30/10/2019.
 */
class InlineColumn extends Div
{
    /**
     * InlineColumn constructor.
     * @param TableColumn $tableColumn
     * @param mixed $datas
     */
    public function __construct(TableColumn $tableColumn,$datas){
        parent::__construct();
        $this->setClass("div-row");
        $this->add(new Cell($tableColumn->getHeader(),false));
        foreach ($datas as $k =>$data)
        {
            $this->add(new Cell($data,false));
        }
    }
}