<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;

class TableLegendTest extends TestCase
{

    public function test__construct()
    {
        $legend = new TableLegend("test",TableLegend::TOP_LEFT);
        $this->assertInstanceOf(TableLegend::class,$legend);
    }
}
