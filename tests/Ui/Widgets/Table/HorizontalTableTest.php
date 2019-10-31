<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;

class HorizontalTableTest extends TestCase
{
    /**
     * @var array
     */
    private array $columns;
    /**
     * @var array
     */
    private array $legends;
    /**
     * @var array
     */
    private array $datas;

    protected function setUp()
    {
        parent::setUp();
        $this->getColumns(["firstName","lastName","old"]);
        $this->legends = $this->getLegends([["content"=>"Legend",'position'=>"TOP_LEFT"]]);
        $this->datas = $this->getDatas();
    }


    private function getColumns($columns)
    {
        $this->columns = [];
        foreach ($columns as $k=>$column) {
            $mock = $this->createMock(TableColumn::class);
            $mock->method('getName')->willReturn($column);
            $mock->method('getHeader')->willReturn(ucfirst($column));
            $this->columns[]= $mock;
        }
    }

    private function getLegends(array $datas):array
    {
        $legends =[];
        foreach ($datas as $k =>$data) {
            $mock = $this->createMock(TableLegend::class);
            $mock->method('getContent')->willReturn($data['content']);
            $mock->method('getPosition')->willReturn($data['position']);
        }

        return $legends;
    }

    private function getDatas()
    {
        return [
            array("firstName" => "John", "lastName" => "Doe", "old" => "42"),
            array("firstName" => "Jane", "lastName" => "Doe", "old" => "43"),
            array("firstName" => "Ada", "lastName" => "Lovelace", "old" => "44"),
            array("firstName" => "Alan", "lastName" => "Turing", "old" => "45")
        ];
    }

    /**
     * public function __construct(array $legends,
     * array $columns,
     * array $dataArray,
     * bool $columnsclickable = false,
     * string $baseurl = " ")
     */
    public function test__construct()
    {
        $ht = new HorizontalTable($this->legends,$this->columns,$this->datas);
        $this->assertInstanceOf(HorizontalTable::class,$ht);
    }
}
