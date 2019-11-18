<?php


use PHPUnit\Framework\TestCase;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;

class DivTableTest extends TestCase
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

    protected function setUp():void
    {
        //	parent::setUp();
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
            $mock->method('isEditable')->willReturn(false);

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
    public function testCanConstruct()
    {
        $drt = new DivTable($this->legends,$this->columns,$this->datas);
        $this->assertInstanceOf(DivTable::class,$drt);
    }
}
