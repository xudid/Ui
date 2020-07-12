<?php

namespace Ui\Widgets\Table;

use Entity\DefaultResolver;

/**
 * Trait ColumnsFactory
 * @package Ui\Widgets\Table
 */
trait ColumnsFactory
{
    public static function make(string $className)
    {
        $columns = [];
        // use Model to make TableColumn
        try {
            $fieldsDefinitions = DefaultResolver::getFieldDefinitions($className);
            $fieldFilter = DefaultResolver::getFilter($className);
            foreach ($fieldFilter->getViewables() as $key => $value) {
                $display = $fieldsDefinitions->getDisplayFor($value);
                $column = new TableColumn($value, $display);
                $columns[] = $column;
            }
            return $columns;
        } catch (\Exception $exception) {
            dump($exception);
        }
    }
}
