<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;
use Ui\Widgets\Table\Legend\TableLegend;
use Ui\Widgets\Table\Legend\TableLegends;

class TableLegendsTest extends TestCase
{
    private $legends;

    protected function setUp():void
    {
        parent::setUp();
        $this->legends = $this->getLegends([["content"=>"Legend",'position'=>"TOP_LEFT"]]);

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

    public function test__construct()
    {

        $legends = new TableLegends($this->legends);
        $this->assertInstanceOf(TableLegends::class,$legends);
    }
}
