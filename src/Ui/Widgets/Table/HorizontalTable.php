<?php


namespace Ui\Widgets\Table;


use Ui\HTML\Elements\Nested\Div;

class HorizontalTable extends Div
{
    /**
     * @var array
     */
    private $legends;
    /**
     * @var array
     */
    private $columns;
    /**
     * @var array
     */
    private $dataArray;
    /**
     * @var bool
     */
    private $columnsclickable;
    /**
     * @var string
     */
    private $baseurl;
    /**
     * @var array
     */
    private $rows;
    /**
     * @var \Ui\HTML\Elements\Bases\Base
     */
    private Div $colGroup;
    /**
     * @var \Ui\HTML\Elements\Bases\Base
     */
    private Div $headerCol;
    /**
     * @var array
     */
    private array $dataCols;

    /**
     * HorizontalTable constructor.
     * @param array $legends
     * @param array $columns
     * @param array $dataArray
     * @param bool $columnsclickable
     * @param string $baseurl
     */
    public function __construct(array $legends,
                                array $columns,
                                array $dataArray,
                                bool $columnsclickable = false,
                                string $baseurl = " ")
    {
        parent::__construct();
        $this->setClass("div-table");
        $this->legends = $legends;
        $this->columns = $columns;
        $this->dataArray = $dataArray;
        $this->columnsclickable = $columnsclickable;
        $this->baseurl = $baseurl;
        $this->rows = [];
        $this->colGroup = (new Div())->setClass("div-colgroup");
        $this->add($this->colGroup);
        $this->headerCol = (new Div())->setClass("div-col");
        $this->dataCols = [];
        $this->colGroup->add($this->headerCol);
        $this->generateCols();
        $this->generateRows();
    }

    private function generateCols()
    {

        $colCount = count($this->dataArray);
        for ($i = 0; $i < $colCount; $i++) {
            $col = (new Div())->setClass("div-col");
            $this->dataCols[] = $col;
            $this->colGroup->add($col);
        }
    }

    private function generateRows()
    {
        foreach ($this->columns as $k => $column) {
            $datas = array_column($this->dataArray, $column->getName());
            $column = new InlineColumn($column, $datas);
            $this->add($column);
        }
    }

    public function setTableClass($css)
    {
        $this->setClass("div-table " . $css);
        return $this;
    }

    public function setHeaderClass($css)
    {
        $columns = array_filter(
            $this->childs,
            function ($child) {
                if ($child instanceof InlineColumn) {
                    return $child;
                }
            }
        );
        foreach ($columns as $column) {
            if($cell = $column->firstCell()) {
                $column->firstCell()->setClass('div-cell ' . $css);
            }
        }
    }

    public function setColClass($css)
    {
        $columns = array_filter(
            $this->childs,
            function ($child) {
                if ($child instanceof InlineColumn) {
                    return $child;
                }
            }
        );
        foreach ($columns as $column) {
            $cells = $column->cells();
            array_shift($cells);
            foreach ($cells as $cell) {
                $cell->setClass('div-cell ' . $css);
            }
        }
    }
}