<?php
namespace Ui\Widget\Table\Column;

use Ui\HTML\Element\Nested\Div;

/**
 * Class DivColGroup
 * @package X\Widget\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Group extends Div {
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
        $this->setClass("colgroup ");
        for($i=0;$i<$this->colCount;$i++)
        {
            $col = new Div();
            $col->setClass("div-col ");
            $this->add($col);
        }
        return $this;

    }
}
