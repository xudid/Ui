<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;

class TableLegendsTest extends TestCase
{
    private $legends;

    protected function setUp()
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
