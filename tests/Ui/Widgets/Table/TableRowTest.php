<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;

class TableRowTest extends TestCase
{
    /**
     * @var array
     */
    private array $columns;

    /**
     * @var array
     */
    private array $datas;

    protected function setUp():void
    {
        parent::setUp();
        $this->getColumns(["firstName","lastName","old"]);
        $this->datas = $this->getDatas();
    }

    private function getColumns($columns)
    {
        $this->columns = [];
        foreach ($columns as $k=>$column) {
            $mock = $this->createMock(TableColumn::class);
            $mock->method('getName')->willReturn($column);
            $mock->method('getHeader')->willReturn(ucfirst($column));
            $mock->method('isEditable')->willReturn(false);
            $this->columns[]= $mock;
        }
    }

    private function getDatas()
    {
        return array("firstName" => "John", "lastName" => "Doe", "old" => "42");
    }

    public function test__construct()
    {
        $row = new TableRow($this->columns, $this->datas, 1, );
        $this->assertInstanceOf(TableRow::class,$row);
    }
}
