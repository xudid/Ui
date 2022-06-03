<?php
namespace Ui\Widget\Table\Row;

use Ui\HTML\Element\Nested\Div;
use Ui\Widget\Table\Cell\Cell;


class TableRow extends Div{

    private $val;
    private int $rowIndex;
    private array $columns;
    private string $baseUrl;
    private int $colCount;
    private bool $rowsclickable;

    public function __construct()
    {
        parent::__construct();
        $this->setClass("row");
    }

    public function setClass(string $class):static
    {
        parent::setClass("row ".$class);
        return $this;
    }

    public function getCell(int $index) : Cell
    {
        if (array_key_exists($index, $this->children)) {
            return $this->children[$index];
        }

        return new Cell('');
    }

    public function addCell(Cell $cell):self
    {
        parent::add($cell);
        return $this;
    }


    public function add($cellContent)
    {
        parent::add(new Cell($cellContent));
        return $this;
    }
}
