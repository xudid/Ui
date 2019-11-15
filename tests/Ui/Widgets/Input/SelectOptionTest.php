<?php

namespace Ui\Widgets\Input;

use PHPUnit\Framework\TestCase;

class SelectOptionTest extends TestCase
{

    public function test__construct()
    {
        $select = new SelectOption([]);
        $this->assertInstanceOf(SelectOption::class,$select);
    }
}
