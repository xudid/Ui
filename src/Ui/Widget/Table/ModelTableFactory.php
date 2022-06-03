<?php

namespace Ui\Widgets\Table;

use Ui\HTML\Element\Nested\Div;
use Ui\Translation\TranslatorInterface;
use Ui\Widgets\Table\Column\Group;
use Ui\Widgets\Table\Legend\TableLegends;
use Ui\Widgets\Table\Row\ModelFactory;
use Ui\Widgets\Table\Row\Type;

/**
 * Class ModelTableFactory
 * @package X\Widget\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 * must be use with X css
 */
class ModelTableFactory extends AbstractTableFacory
{
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getTable(): Div
    {
        $table = (new Div())->setClass('table');
        $this->rowcss['odd'] = "py-1";
        $this->rowcss["even"] = 'py-1';
        $this->rowcss["header"]= "";
        $this->legendcss= "";
        $this->dataDiv = new RowGroup();
        $table->feed(
            (new TableLegends($this->legends))->setClass($this->legendcss),
            new Group(count($this->columns)),
            (new TableHeader($this->columns))->setClass($this->rowcss["header"]),
            $this->dataDiv,
        );

        $modelRowFactory = new ModelFactory(Type::DIV, $this->columns);
        $modelRowFactory->setBaseUrl($this->baseurl);
        for ($i = 0; $i < count($this->data); $i++) {
            $value = $this->data[$i];
            $parity = $i % 2 === 0 ?'even' : 'odd';

            $tableRow = $modelRowFactory->getRowFromValue($value, $i);
            $this->addRow($tableRow->setClass($this->rowcss[$parity]));
        }
        return $table;
    }
}
