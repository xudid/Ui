<?php

namespace Ui\Widgets\Table;

use PHPUnit\Framework\TestCase;
use Ui\Widgets\Table\Column\Group;

class ColGroupTest extends TestCase
{

    public function test__construct()
    {
        $group = new Group(3);
        $this->assertInstanceOf(Group::class,$group);
    }
}
