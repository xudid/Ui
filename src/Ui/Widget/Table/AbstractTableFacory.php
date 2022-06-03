<?php

namespace Ui\Widget\Table;

use Ui\HTML\Element\Nested\Div;
use Ui\Translation\TranslatorInterface;
use Ui\Widget\Table\Row\FactoryInterface;
use Ui\Widget\Table\Row\TableRow;

abstract class AbstractTableFacory implements TableFactoryInterface
{
    protected TranslatorInterface $translator;
    protected FactoryInterface $rowFactory;
    protected string $legendcss;
    protected array $legends = [];
    protected string $baseurl = '';
    protected array $columns = [];
    protected $dataDiv;
    protected $data;



    abstract public function getTable(): Div;

    public function setLegendCss(string $legendCss): TableFactoryInterface
    {
        $this->legendcss = $legendCss;
        return $this;
    }

    public function setOddRowCss(string $oddRowcCss): TableFactoryInterface
    {
        $this->rowcss['odd'] = $oddRowcCss;
        return $this;
    }

    public function setEvenRowCss(string $evenRowcCss): TableFactoryInterface
    {
        $this->rowcss['even'] = $evenRowcCss;
        return $this;
    }

    public function setHeaderCss($headerCss): TableFactoryInterface
    {
        $this->rowcss["header"] = $headerCss;
        return $this;
    }

    public function addRow(TableRow $tableRow): TableFactoryInterface
    {
        $this->dataDiv->add($tableRow);
        return $this;
    }

    public function setLegends(array $legends): TableFactoryInterface
    {
        $this->legends = $legends;
        return $this;
    }

    public function setColumns(...$columns): TableFactoryInterface
    {
        $this->columns = $columns;
        return $this;
    }

    public function useData(array $data): TableFactoryInterface
    {
        $this->data = $data;
        return $this;
    }

    public function setRowsclickable(bool $rowsclickable): TableFactoryInterface
    {
        $this->rowsclickable = $rowsclickable;
        return $this;
    }

    public function setBaseurl(string $baseurl): TableFactoryInterface
    {
        $this->baseurl = $baseurl;
        return $this;
    }
}