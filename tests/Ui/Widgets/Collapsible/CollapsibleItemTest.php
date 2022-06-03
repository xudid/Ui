<?php

namespace Ui\Widgets\Collapsible;

use PHPUnit\Framework\TestCase;

class CollapsibleItemTest extends TestCase
{

    public function test__construct()
    {
        $collapsibleItem = new Item();
        $this->assertInstanceOf(Item::class,$collapsibleItem);
    }
}
