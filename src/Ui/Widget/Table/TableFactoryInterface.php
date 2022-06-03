<?php
namespace Ui\Widget\Table;

use Ui\HTML\Element\Nested\Div;
use Ui\Widget\Table\Row\TableRow;

/**
 * Class ModelTableFactory
 * @package X\Widget\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 * must be use with X css
 */
interface TableFactoryInterface
{
    public function getTable(): Div;

    public function setLegendCss(string $legendCss): TableFactoryInterface;

    public function setOddRowCss(string $oddRowcCss): TableFactoryInterface;

    public function setEvenRowCss(string $evenRowcCss): TableFactoryInterface;

    public function setHeaderCss($headerCss): TableFactoryInterface;

    public function addRow(TableRow $tableRow): TableFactoryInterface;

    /**
     * @param array $legends
     */
    public function setLegends(array $legends): TableFactoryInterface;

    /**
     * @param array $columns
     * @return ModelTableFactory
     */
    public function setColumns(...$columns): TableFactoryInterface;

    /**
     * @param array $DataArray
     * @return ModelTableFactory
     */
    public function useData(array $DataArray): TableFactoryInterface;

    /**
     * @param bool $rowsclickable
     * @return ModelTableFactory
     */
    public function setRowsclickable(bool $rowsclickable): TableFactoryInterface;

    /**
     * @param string $baseurl
     * @return ModelTableFactory
     */
    public function setBaseurl(string $baseurl): TableFactoryInterface;
}