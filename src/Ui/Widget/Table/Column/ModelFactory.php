<?php

namespace Ui\Widgets\Table\Column;

use Ui\Translation\TranslatorInterface;

class ModelFactory implements FactoryInterface
{
    private array $columnIndexes;
    private $value;
    private TranslatorInterface $translator;

    public function from($value): FactoryInterface
    {
        $this->value = $value;
        $this->columnIndexes = $this->value->getColumns();
        return $this;
    }

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
            $display = $this->resolveDisplay($columnIndex);
            $column = new Column($columnIndex, $display);
            $columns[] = $column;
        }
        return $columns;
    }

    private function resolveDisplay($columnIndex): string
    {
        return $this->translator->translate($columnIndex);
    }

    public function withTranslator(TranslatorInterface $translator): FactoryInterface
    {
        $this->translator = $translator;
        return $this;
    }
}
