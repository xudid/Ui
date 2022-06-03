<?php

namespace Ui\Widgets\Table\Column;

use Entity\DefaultResolver;
use function dump;

/**
 * Trait ColumnsFactory
 * @package X\Widget\Table
 * @deprecated
 */
trait ColumnsFactory
{
    public static function make(string $className)
    {
        $columns = [];
        // use Model to make Column
        try {
            $fieldsDefinitions = DefaultResolver::getFieldDefinitions($className);
            $fieldFilter = DefaultResolver::getFilter($className);
            foreach ($fieldFilter->getViewables() as $key => $value) {
                $display = $fieldsDefinitions->getDisplayFor($value);
                $column = new Column($value, $display);
                $columns[] = $column;
            }
            return $columns;
        } catch (\Exception $exception) {
            dump($exception);
        }
    }
}
