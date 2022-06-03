<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;

class TableCorpTest extends TestCase
{

    public function test__construct()
    {
        $boby = new RowGroup();
        $this->assertInstanceOf(RowGroup::class,$boby);
    }
}
