<?php

namespace Ui\Widget\Table\Column;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\NoopWordInflector;
use ReflectionMethod;
use ReflectionObject;

class ObjectFactory extends AbstractFactory
{
    private Inflector $inflector;

    public function from($value): FactoryInterface
    {
        $this->value = array_values($value)[0];
        $this->columnIndexes = $this->getColumns($this->value);
        $this->inflector = new Inflector(new NoopWordInflector(), new NoopWordInflector());
        return $this;
    }

    private function getColumns($value)
    {
        $ro = new ReflectionObject($value);
        $properties = $ro->getProperties();
        $columns = [];
        foreach ($properties as $property) {
            $methodName = "get" . ucfirst($property->getName());
            if ($ro->hasMethod($methodName)) {
                $method = new ReflectionMethod($value, $methodName);
                if ($method->isPublic()) {
                    $columns[] = $property->getName();
                }
            }
        }

        return $columns;
    }

    protected function resolveDisplay($value, mixed $columnIndex): string
    {
        return $this->translator->translate($this->inflector->tableize($columnIndex));
    }
}
