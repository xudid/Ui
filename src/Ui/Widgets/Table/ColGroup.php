<?php
namespace Ui\Widgets\Table;

use Ui\HTML\Elements\Nested\Div;

/**
 * Class DivColGroup
 * @package Ui\Widgets\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class ColGroup extends Div {
    /**
     * @var
     */
    private $colCount;

    /**
     * DivColGroup constructor.
     * @param int $colCount
     */
    public function __construct(int $colCount)
    {
        parent::__construct();
        $this->colCount = $colCount;
        $this->setClass("div-colgroup ");
        for($i=0;$i<$this->colCount;$i++)
        {
            $col = new Div();
            $col->setClass("div-col ");
            $this->add($col);
        }
        return $this;

    }
}
