<?php

namespace Ui\Widgets\Lists;

use PHPUnit\Framework\TestCase;

class OrderedItemListTest extends TestCase
{

    public function test__construct()
    {
        $list = new OrderedItemList(["item1","item2"]);
        $this->assertInstanceOf(OrderedItemList::class,$list);
    }
}
