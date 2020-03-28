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

    private function getTableRowFromObject()
    {

        $ro = new ReflectionObject($this->val);
        $hasgetId = false;
        if ($ro->hasMethod("getId")) {
            $hasgetId = true;
        }

        for ($i = 0; $i < $this->colCount; $i++) {
            $column = $this->columns[$i];
            $colname = $column->getName();
            $isEditable = $column->isEditable();
            $methodName = "get" . ucfirst($colname);
            try {
                $method = new ReflectionMethod($this->val, $methodName);
            } catch (ReflectionException $e) {
            }
            $value = $method->invoke($this->val);
            $cell = new Cell($value, $isEditable);
            if ($column->isBaseIdSet()) {
                $cell->setIndex($column->getBaseId() . $this->rowIndex);
            }
            $this->add($cell);
            //Todo create a default row click action
            //Todo allow to provide a row click action
            if ($hasgetId && $this->rowsclickable) {
                try {
                    $method = new ReflectionMethod($this->val, "getId");
                    $id = $method->invoke($this->val);
                    $this->setOnClick("location.href='" . $this->baseUrl . "/" . $id . "'");
                } catch (ReflectionException $e) {
                    throw $e;
                }

            }
        }
    }

    private function getTableRow(){
       if(array_key_exists("id" , $this->val)&&$this->rowsclickable)
        {
            $id = $this->val["id"];
            $this->setOnClick("location.href='".$this->baseUrl."/".$id."'");
        } elseif(array_key_exists("id" , $this->val)) {
           $a = new A((string)$this->val['id'], $this->baseUrl . "/" . $this->val['id'] );
           $a->setClass('btn btn-primary btn-xs');
           $cell = new Cell($a,false);

           $this->add($cell);
       }
        for($i=0;$i<$this->colCount;$i++)
        {
            $column = $this->columns[$i];
            $isEditable = $column->isEditable();
            $columnName = $column->getName();
            if ($columnName != 'id') {
                $cell = new Cell($this->val[$columnName],$isEditable);
                if($column->isBaseIdSet())
                {
                    $cell->setIndex($column->getBaseId().$this->rowIndex);
                }
                $this->add($cell);
            }

        }
    }

}
