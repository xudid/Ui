<?php

namespace Ui\Widgets\Table;

use Entity\Model\Model;
use Ui\HTML\Elements\Nested\Div;
/**
 * Class DivRowTable
 * @package Ui\Widgets\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 * must be use with Ui css
 */
class DivTable extends Div
{

    private array $legends = [];
    private array $columns = [];
    private array $DataArray = [];
    private $tableSection = null;
    private $dataDiv = null;
    private int $colCount = 0;
    private bool $rowsclickable = false;
    private string $baseurl = "";
    private array $rowcss = [];
    /**
     * @var string
     */
    private string $legendcss;


    //Todo create a TableFactory and a TableFactoryIntercace
    /**
     * DivTable constructor.
     * @param array $legends
     * @param array $columns
     * @param array $DataArray
     * @param bool $rowsclickable
     * @param string $baseurl
     * @throws \ReflectionException
     */
    public function __construct(array $legends,
                                array $columns,
                                array $DataArray,
                                bool $rowsclickable = false,
                                string $baseurl = " "
    )
    {
    	parent::__construct();
		$this->setClass("div-table");

        $this->legends = $legends;
        $this->columns = $columns;
        $this->colCount = count($columns);
        $this->DataArray = $DataArray;
        $this->rowsclickable = $rowsclickable;
        $this->baseurl = $baseurl;
        $this->rowcss["odd"] = "py-1";
        $this->rowcss["even"] = 'py-1';
        $this->rowcss["header"]= "";
        $this->legendcss= "";
		$this->dataDiv = new TableCorp();
        $this->feed(
        	(new TableLegends($this->legends))->setClass($this->legendcss),
			new ColGroup($this->colCount),
			(new TableHeader($this->columns))->setClass($this->rowcss["header"]),
			$this->dataDiv,
		);

        $rowFactory = new RowFactory(RowType::DIV, $this->columns);
        $rowFactory->useBaseUrl($this->baseurl);
        for ($i = 0; $i < count($this->DataArray); $i++) {
            $value = $this->DataArray[$i];
            $parity = $i%2===0?'even':'odd';

            if ($value instanceof Model) {
                $tableRow = $rowFactory->rowFromModel($value, $i);
            } elseif (is_object($value)) {
                try {
                    $tableRow = $rowFactory->rowFromObject($value, $i);
                } catch (\ReflectionException $e) {
                    throw $e;
                }
            } elseif (is_array($value)) {
                $tableRow = $rowFactory->rowFromArray($value, $i);
            } else {
                throw new \Exception('Unsupported data type to generate row');
            }
            $this->addRow($tableRow->setClass($this->rowcss[$parity]));
        }
    }

    /**
     * @param array $rowcss
     */
    public function setRowcss(array $rowcss): void
    {
        $this->rowcss = $rowcss;
    }

    public function addRow(TableRow $tableRow)
    {
        $this->dataDiv->add($tableRow);
    }
}
