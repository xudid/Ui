<?php

namespace Ui\Widget\Table\Row;

use ReflectionMethod;

class ObjectFactory extends AbstractFactory
{
    public function __construct(string $type, array $tableColumns)
    {
        $this->type = $type;
        $this->columns = $tableColumns;
    }

    protected function getData($value, $column)
    {
        $columnName = $column->getName();
        $methodName = "get" . ucfirst($columnName);
        $objectMethods = get_class_methods($value);
        if (!in_array($methodName, $objectMethods)) {
            return '';
        }

        $method = new ReflectionMethod($value, $methodName);
        if ($method->isPrivate() || $method->isProtected()) {
            return '';
        }
        return $method->invoke($value);
    }

    protected function validate($value)
    {
        return !is_null($value);
    }
}
