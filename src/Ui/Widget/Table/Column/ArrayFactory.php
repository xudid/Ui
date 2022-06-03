<?php

namespace Ui\Widget\Table\Column;

class ArrayFactory extends AbstractFactory
{
    public function from($value): FactoryInterface
    {
        $this->value = array_values($value)[0];
        $this->columnIndexes = array_keys($this->value);
        return $this;
    }
}
