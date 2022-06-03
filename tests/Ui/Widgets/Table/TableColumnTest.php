<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;
use Ui\Widgets\Table\Column\Column;

class TableColumnTest extends TestCase
{

    public function test__construct()
    {
        $column = new Column("test","Test");
        $this->assertInstanceOf(Column::class,$column);
    }
}
