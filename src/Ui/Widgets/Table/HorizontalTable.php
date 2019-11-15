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
        for ($i=0;$i<$colCount;$i++){
            $col = (new Div())->setClass("div-col");
            $this->dataCols[] = $col;
            $this->colGroup->add($col);
        }
    }

    private function generateRows()
    {
        foreach ($this->columns as $k =>$column){
          $datas = array_column($this->dataArray,$column->getName());
          $this->add(new InlineColumn($column,$datas));
        }
    }

    public function setTableClass($css)
    {
        $this->setClass("div-table ".$css);
        return $this;
    }

    public function setHeaderClass($css)
    {
        $this->headerCol->setClass("div-col ".$css);
        return $this;
    }

    public function setColClass($css)
    {
        foreach ($this->dataCols as $col)
        {
            $col->setClass("div-col ".$css);
        }
    }
}