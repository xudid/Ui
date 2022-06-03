<?php

namespace Ui\Widgets\Table\Row;

class ModelFactory extends AbstractFactory
{
    public function __construct(string $type, array $tableColumns)
    {
        $this->type = $type;
        $this->columns = $tableColumns;
    }

    protected function getData($value, $column)
    {
        $columnName = $column->getName();
        return $value->getPropertyValue($columnName);
    }

    protected function validate($value)
    {
        return !is_null($value);
    }
}
