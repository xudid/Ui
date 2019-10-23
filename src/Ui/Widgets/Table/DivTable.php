<?php

namespace Ui\Widgets\Table;

use Ui\HTML\Elements\Nested\Section;


/**
 * Class DivRowTable
 * @package Ui\Widgets\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 * must be use with Ui css
 */
class DivTable
{

    private array $legends = [];
    private array $columns = [];
    private array $DataArray = [];
    private $tableSection = null;
    private $dataDiv = null;
    private int $colCount = 0;
    private bool $rowsclickable = false;
    private string $baseurl = "";
    private array $rowcss = [];


    /**
     * DivRowTable constructor.
     * @param array $legends :array of TableLegend
     * @param array $columns :array of TableColumn
     * @param array $DataArray
     * @param bool $rowsclickable
     * @param string $baseurl
     */
    public function __construct(array $legends,
                                array $columns,
                                array $DataArray,
                                bool $rowsclickable = false,
                                string $baseurl = " "
    )
    {
        $this->legends = $legends;
        $this->columns = $columns;
        $this->colCount = count($columns);
        $this->DataArray = $DataArray;
        $this->rowsclickable = $rowsclickable;
        $this->baseurl = $baseurl;
        $this->rowcss["odd"] = " row-odd-colors";
        $this->rowcss["even"] = " row-even-colors";
        $this->rowcss["header"]= "row-head-colors";

        $colgroupDiv = new ColGroup($this->colCount);
        $this->tableSection = (new Section())->setClass("table");



        $this->tableSection->add($colgroupDiv);

        $this->tableSection->add((new TableLegends($this->legends))->setClass("legend-top-colors"));


        $this->tableSection->add((new TableHeader($this->columns))->setClass($this->rowcss["header"]));

        $this->dataDiv = new TableCorp();

        $this->tableSection->add($this->dataDiv);

        $datacount = count($this->DataArray);

        for ($i = 0; $i < $datacount; $i++) {
            $val = $this->DataArray[$i];
            $parity = $i%2===0?'even':'odd';
            $this->dataDiv->add((new TableRow($this->columns, $val, $i, $this->baseurl))->setClass($this->rowcss[$parity]));
        }
    }

    /**
     * @param array $rowcss
     */
    public function setRowcss(array $rowcss): void
    {
        $this->rowcss = $rowcss;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->tableSection->__toString();
    }
}
