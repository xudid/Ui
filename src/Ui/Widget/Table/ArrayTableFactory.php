<?php

namespace Ui\Widget\Table;

use Ui\HTML\Element\Nested\Div;
use Ui\Translation\TranslatorInterface;
use Ui\Widget\Table\Column\ArrayFactory;
use Ui\Widget\Table\Column\Group;
use Ui\Widget\Table\Legend\TableLegends;
use Ui\Widget\Table\Row\ArrayFactory as ArrayRowFactory;
use Ui\Widget\Table\Row\Type;

class ArrayTableFactory extends AbstractTableFacory
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

        if (!$this->columns)
        $columnsFactory = new ArrayFactory();
        $this->columns = $columnsFactory->from($this->data)->withTranslator($this->translator)->make();
        $this->rowFactory = new ArrayRowFactory(Type::DIV, $this->columns);

        $table->feed(
            (new TableLegends($this->legends))->setClass($this->legendcss),
            new Group(count($this->columns)),
            (new TableHeader($this->columns))->setClass($this->rowcss["header"]),
            $this->dataDiv,
        );

        $this->rowFactory->setBaseUrl($this->baseurl);
        for ($i = 0; $i < count($this->data); $i++) {
            $value = $this->data[$i];
            $parity = $i % 2 === 0 ?'even' : 'odd';
            $tableRow = $this->rowFactory->getRowFromValue($value, $i);
            $this->addRow($tableRow->setClass($this->rowcss[$parity]));
        }
        return $table;
    }
}
