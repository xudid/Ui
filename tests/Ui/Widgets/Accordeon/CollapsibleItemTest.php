<?php

namespace Ui\Widgets\Accordeon;

use PHPUnit\Framework\TestCase;

class CollapsibleItemTest extends TestCase
{

    public function test__construct()
    {
        $collapsibleItem = new CollapsibleItem();
        $this->assertInstanceOf(CollapsibleItem::class,$collapsibleItem);
    }
}
