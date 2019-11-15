<?php

namespace Ui\Widgets\Accordeon;

use PHPUnit\Framework\TestCase;

class CollapsibleListTest extends TestCase
{

    public function test__construct()
    {
        $collapsibleList = new CollapsibleList();
        $this->assertInstanceOf(CollapsibleList::class,$collapsibleList);
    }
}
