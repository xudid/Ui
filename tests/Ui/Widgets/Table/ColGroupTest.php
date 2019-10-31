<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;

class ColGroupTest extends TestCase
{

    public function test__construct()
    {
        $group = new ColGroup(3);
        $this->assertInstanceOf(ColGroup::class,$group);
    }
}
