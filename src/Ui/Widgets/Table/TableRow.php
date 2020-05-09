<?php
namespace Ui\Widgets\Table;

use ReflectionException;
use ReflectionMethod;
use ReflectionObject;
use Ui\HTML\Elements\Nested\A;
use Ui\HTML\Elements\Nested\Div;

//Todo create a RowFactory and a  RowFactoryInterface with setRowClickAction setRowClass setRowCss setRowColumns ?
class TableRow extends Div{

    /**
     * @var mixed $val
     */
    private $val;
    /**
     * @var int$rowIndex;
     */
    private int $rowIndex;
    /**
     * @var array $columns;
     */
    private array $columns;
    /**
     * @var string $baseUrl
     */
    private string $baseUrl;

    /**
     * @var int $colCount;
     */
    private int $colCount;
    private bool $rowsclickable;

    public function __construct()
    {
        parent::__construct();
        $this->setClass("div-row");
    }

    public function setClass(string $class)
    {
        parent::setClass("div-row ".$class);
        return $this;
    }

    public function getCell(int $index) : Cell
    {
        if (array_key_exists($index, $this->childs)) {
            return $this->childs[$index];
        }
        return false;
    }

    public function addCell(Cell $cell)
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
