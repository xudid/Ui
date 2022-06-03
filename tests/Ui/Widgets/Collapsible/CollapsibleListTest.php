<?php

namespace Ui\Widgets\Collapsible;

use PHPUnit\Framework\TestCase;

class CollapsibleListTest extends TestCase
{

    public function test__construct()
    {
        $collapsibleList = new CollapsibleList();
        $this->assertInstanceOf(CollapsibleList::class,$collapsibleList);
    }
}
