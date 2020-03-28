<?php


namespace Ui\Widgets\Table;


use Entity\DefaultResolver;

trait ColumnsFactory
{
    public static function make(string $className)
    {
        $columns = [];
        $fieldsDefinitions = DefaultResolver::getFieldDefinitions($className);
        $fieldsDefinitions = new $fieldsDefinitions();
        $fieldFilter = DefaultResolver::getFilter($className);
        $fieldFilter = new $fieldFilter();
        foreach ($fieldFilter->getViewables() as $key => $value) {
            $display = $fieldsDefinitions->getDisplayFor($value);
            $column = new TableColumn($value, $display);
            $columns[] = $column;
        }
        return $columns;
    }
}