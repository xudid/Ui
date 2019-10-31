<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;

class InlineColumnTest extends TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $tableColumn;

    protected function setUp()
    {
        parent::setUp();
        $this->tableColumn = $this->createMock(TableColumn::class);
        $this->tableColumn->method('getName')->willReturn("name");
        $this->tableColumn->method('getHeader')->willReturn("Name");

    }

    private function getDatas():array
    {
        return [["name"=>"Ada"],["name"=>"Marie"],["name"=>"Alan"],["name"=>"Steve"]];
    }


    /**
     *  public function __construct(TableColumn $tableColumn,$datas)
     */
    public function test__constructWithEmtyDatas()
    {
        $inlineColumn = new InlineColumn($this->tableColumn,[]);
        $this->assertInstanceOf(InlineColumn::class,$inlineColumn);
    }

    public function test__constructWithDatas()
    {
        $inlineColumn = new InlineColumn($this->tableColumn,$this->getDatas());
        $this->assertInstanceOf(InlineColumn::class,$inlineColumn);
    }
}
