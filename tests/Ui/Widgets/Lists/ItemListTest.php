<?php

namespace Ui\Widgets\Lists;

use PHPUnit\Framework\TestCase;

class ItemListTest extends TestCase
{

    public function test__construct()
    {
        $list = new ItemList(["test1","test2"]);
        $this->assertInstanceOf(ItemList::class,$list);
    }
}
