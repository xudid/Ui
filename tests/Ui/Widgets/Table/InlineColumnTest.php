<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;
use Ui\Widgets\Table\Column\Inline;
use Ui\Widgets\Table\Column\Column;

class InlineColumnTest extends TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $tableColumn;

    protected function setUp():void
    {
        parent::setUp();
        $this->tableColumn = $this->createMock(Column::class);
        $this->tableColumn->method('getName')->willReturn("name");
        $this->tableColumn->method('getHeader')->willReturn("Name");

    }

    private function getDatas():array
    {
        return [["name"=>"Ada"],["name"=>"Marie"],["name"=>"Alan"],["name"=>"Steve"]];
    }


    /**
     *  public function __construct(Column $tableColumn,$datas)
     */
    public function test__constructWithEmtyDatas()
    {
        $inlineColumn = new Inline($this->tableColumn,[]);
        $this->assertInstanceOf(Inline::class,$inlineColumn);
    }

    public function test__constructWithDatas()
    {
        $inlineColumn = new Inline($this->tableColumn,$this->getDatas());
        $this->assertInstanceOf(Inline::class,$inlineColumn);
    }
}
