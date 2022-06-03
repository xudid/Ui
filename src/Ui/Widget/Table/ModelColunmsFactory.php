<?php

namespace Ui\Widgets\Table;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\NoopWordInflector;
use Ui\Widgets\Table\Column\AbstractFactory;
use Ui\Widgets\Table\Column\FactoryInterface;

class ModelColunmsFactory extends AbstractFactory
{
    private Inflector $inflector;

    public function from($value): FactoryInterface
    {
        $this->value = array_values($value)[0];
        $this->columnIndexes = $this->value->getColumns();
        $this->inflector = new Inflector(new NoopWordInflector(), new NoopWordInflector());
        return $this;
    }

    private function resolveDisplay($value, mixed $columnIndex): string
    {
        return $this->translator->translate($this->inflector->tableize($columnIndex));
    }
}
