<?php


use PHPUnit\Framework\TestCase;
use Ui\Widgets\Table\Column\Column;
use Ui\Widgets\Table\Legend\TableLegend;
use Ui\Widgets\Table\ModelTableFactory;

class TableFactoryTest extends TestCase
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
            $mock = $this->createMock(Column::class);
            $mock->method('getName')->willReturn($column);
            $mock->method('getHeader')->willReturn(ucfirst($column));
            $mock->method('isEditable')->willReturn(false);

            $this->columns[]= $mock;
        }
    }

    private function getLegends(array $datas):array
    {
        $legends =[];
        foreach ($datas as $data) {
            $mock = $this->createMock(TableLegend::class);
            $mock->method('getContent')->willReturn($data['content']);
            $mock->method('getPosition')->willReturn($data['position']);
            $legends[] = $mock;
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
        $drt = (new ModelTableFactory())->setLegends($this->legends)->setColumns($this->columns)->setDataArray($this->datas);
        $this->assertInstanceOf(ModelTableFactory::class,$drt);
    }
}
