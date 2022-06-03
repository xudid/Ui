<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;
use Ui\Widgets\Table\Cell\Cell;

class CellTest extends TestCase
{

    public function test__construct()
    {
        $cell = new Cell("test");
        $this->assertInstanceOf(Cell::class,$cell);
    }
}
