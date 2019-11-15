<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;

class TableHeaderTest extends TestCase
{

    public function test__construct()
    {
        $header = new TableHeader([]);
        $this->assertInstanceOf(TableHeader::class,$header);
    }
}
