<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;

class TableColumnTest extends TestCase
{

    public function test__construct()
    {
        $column = new TableColumn("test","Test");
        $this->assertInstanceOf(TableColumn::class,$column);
    }
}
