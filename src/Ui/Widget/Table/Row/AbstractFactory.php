<?php

namespace Ui\Widget\Table\Row;

use Ui\HTML\Element\Nested\A;
use Ui\Widget\Table\Cell\Cell;

abstract class AbstractFactory implements FactoryInterface
{
    protected string $baseUrl;
    protected array $columns;
    protected bool $rowClickable;
    protected string $type;

    public function setBaseUrl(string $baseUrl): FactoryInterface
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function setColumns(array $columns): FactoryInterface
    {
        $this->columns = $columns;
        return $this;
    }

    public function setRowClickable(): FactoryInterface
    {
        $this->rowClickable = true;
        return $this;
    }

    public function getRowFromValue($value, $index): TableRow
    {
        $tableRow = new TableRow();
        if (!$this->validate($value)) {
            return $tableRow;
        }

        if (!count($this->columns)) {
            return $tableRow;
        }

        foreach ($this->columns as $column) {
            $cellData = $this->getCellData($value, $column);
            $isEditable = $column->isEditable();
            $cell = new Cell($cellData, $isEditable);

            if ($column->isBaseIdSet()) {
                $cell->setIndex($column->getBaseId() . $index);
            }

            $tableRow->addCell($cell);
            if ($column->getName() == 'id' && $this->rowClickable)  {
                $id = $this->getData($value, 'id');
                if ($id) {
                    $tableRow->setOnClick("location.href='" . $this->baseUrl . "/" . $id . "'");
                }
            }
        }
        return $tableRow;
    }

    protected function getCellData($value, $column)
    {
        $columnName = $column->getName();
        $data = $this->getData($value, $column);
        if($columnName == 'id'){
            $cellData =  new A((string)$data, $this->baseUrl . '/' . $data);
            $cellData->setClass('btn btn-xs btn-primary');
            return $cellData;
        } else {
            return $data;
        }
    }

    abstract protected function getData($value, $column);
    abstract  protected function validate($value);
}
