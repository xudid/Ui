<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;

class TableCorpTest extends TestCase
{

    public function test__construct()
    {
        $boby = new TableCorp();
        $this->assertInstanceOf(TableCorp::class,$boby);
    }
}
