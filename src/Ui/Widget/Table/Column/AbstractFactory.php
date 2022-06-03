<?php

namespace Ui\Widget\Table\Column;

use Ui\Translation\TranslatorInterface;

abstract class AbstractFactory implements FactoryInterface
{
    protected array $columnIndexes;
    protected mixed $value;
    protected TranslatorInterface $translator;

    public function filter(...$fields): FactoryInterface
    {
        $indexes = $this->columnIndexes;
        $this->columnIndexes = array_filter($indexes, function($index) use($fields){
            if (in_array($index, $fields)) {
                return false;
            }
            return true;
        });
        return $this;
    }

    public function make(): array
    {
        $columns = [];
        foreach ($this->columnIndexes as $columnIndex) {
            $display = $this->resolveDisplay($this->value, $columnIndex);
            $column = new Column($columnIndex, $display);
            $columns[] = $column;
        }

        return $columns;
    }

    protected function resolveDisplay($value, $columnIndex):string
    {
        return $this->translator->translate($columnIndex);
    }

    public function withTranslator(TranslatorInterface $translator): FactoryInterface
    {
        $this->translator = $translator;
        return $this;
    }

    abstract public function from($value): FactoryInterface;
}