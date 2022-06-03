<?php

namespace Ui\Widget\Table\Row;

interface FactoryInterface
{
    public function setBaseUrl(string $baseUrl): FactoryInterface;
    public function setColumns(array $columns): FactoryInterface;
    public function setRowClickable(): FactoryInterface;
    public function getRowFromValue($value, $index);
}