<?php

namespace Ui\Widget\Table\Row;

class ArrayFactory extends AbstractFactory
{
    public function __construct(string $type, array $tableColumns)
    {
        $this->type = $type;
        $this->columns = $tableColumns;
    }

    protected function getData($value, $column)
    {
        $columnName = $column->getName();
        if (!array_key_exists($columnName, $value)) {
            return '';
        }
        return $value[$columnName];
    }

    protected function validate($value)
    {
        return !empty($value);
    }
}
