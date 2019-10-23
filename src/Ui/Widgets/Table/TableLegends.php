<?php
namespace Ui\Widgets\Table;

use Ui\HTML\Elements\Nested\Div;

/**
 * Class DivTableLegend
 * @package Ui\Widgets\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */

//Todo BugFix legend alignment
class TableLegends extends Div {


    /**
     * @var array $tableLegends
     */
    private array $tableLegends;

    /**
     * DivTableLegend constructor.
     * @param array $tableLegends
     */
    public function __construct(array &$tableLegends)
    {
        parent::__construct();
        $this->tableLegends = $tableLegends;
        $this->setClass("legende_top");
       // $row = new Div();
        //$row->setClass("row");
        //$this->add($row);
        $countLegends = count($this->tableLegends);

        for ($i=0;$i<$countLegends;$i++) {

            $l =$tableLegends[$i];
            $legend = new Div();
            if($l->getPosition()==TableLegend::TOP_LEFT)
            {
                $legend->setClass("legende_left");
            }
            if($l->getPosition()==TableLegend::TOP_RIGHT)
            {
                $legend->setClass("legende_right");
            }
            $legend->add($l->getContent());
            $this->add($legend);
        }
        return $this;
    }

    public function setClass($class)
    {
        parent::setClass("legende_top ".$class);
        return $this;
    }
}
