<?php

namespace Ui\Widgets\Table;

use Ui\HTML\Elements\Empties\Hr;
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
     * @var string
     */
    private string $legendcss;


    /**
     * DivRowTable constructor.
     * @param array $legends :array of TableLegend
     * @param array $columns :array of TableColumn
     * @param array $DataArray
     * @param bool $rowsclickable
     * @param string $baseurl
     */
    //Todo create a ColumnFactory and a ColumnFactoryIntercace
    //Todo create a TableFactory and a TableFactoryIntercace
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
        $this->rowcss["odd"] = " ";
        $this->rowcss["even"] = "";
        $this->rowcss["header"]= "bg-primary text-white";
        $this->legendcss="bg-primary text-white";


        $colgroupDiv = new ColGroup($this->colCount);
        $this->tableSection = (new Section())->setClass("div-table bg-dark text-white");

        $this->tableSection->add((new TableLegends($this->legends))->setClass($this->legendcss));

        $this->tableSection->add($colgroupDiv);




        $this->tableSection->add((new TableHeader($this->columns))->setClass($this->rowcss["header"]));

        $this->dataDiv = new TableCorp();

        $this->tableSection->add($this->dataDiv);

        $datacount = count($this->DataArray);

        //Todo use the RowFactory
        for ($i = 0; $i < $datacount; $i++) {
            $val = $this->DataArray[$i];
            $parity = $i%2===0?'even':'odd';
            $this->dataDiv->add((new TableRow($this->columns, $val, $i, $this->baseurl,$this->rowsclickable))->setClass($this->rowcss[$parity]));
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
