<?php
namespace Ui\Widgets\Table;

use Ui\HTML\Elements\Nested\Div;

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

    public function __construct(array $columns, $val, int $rowIndex, string $baseUrl)
    {
        parent::__construct();
        $this->setClass("row");
        $this->val = $val;
        $this->rowIndex = $rowIndex;
        $this->columns = $columns;
        $this->colCount = count($this->columns);
        $this->baseUrl = $baseUrl;
        if(is_object($val))
        {
            $this->getTableRowFromObject();
        }
        else
        {
            $this->getTableRow();
        }
        return $this;
    }

    public function setClass(string $class)
    {
        parent::setClass("row ".$class);
        return $this;
    }

    private function getTableRowFromObject()
    {
        $ro = new \ReflectionObject($this->val);
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
                $method = new \ReflectionMethod($this->val, $methodName);
            } catch (\ReflectionException $e) {
            }
            $value = $method->invoke($this->val);
            $cell = new Cell($value, $isEditable);
            if ($column->isBaseIdSet()) {
                $cell->setId($column->getBaseId() . $this->rowIndex);
            }
            $this->add($cell);
            if ($hasgetId && $this->rowsclickable) {
                $method = new \ReflectionMethod($this->val, "getId");
                $id = $method->invoke($this->val);
                $this->setOnClick("location.href='" . $this->baseurl . "/" . $id . "'");
            }
        }
    }

    private function getTableRow(){
       if(array_key_exists("id" , $this->val)&&$this->rowsclickable)
        {
            $id = $this->val["id"];
            $this->setOnClick("location.href='".$this->baseurl."/".$id."'");
        }
        for($i=0;$i<$this->colCount;$i++)
        {
            $column = $this->columns[$i];
            $isEditable = $column->isEditable();

            $cell = new Cell($this->val[$column->getName()],$isEditable);
            if($column->isBaseIdSet())
            {
                $cell->setId($column->getBaseId().$this->rowIndex);
            }
            $this->add($cell);
        }
    }

}
