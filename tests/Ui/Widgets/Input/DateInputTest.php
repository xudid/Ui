<?php

namespace Ui\Widgets\Input;

use PHPUnit\Framework\TestCase;

class DateInputTest extends TestCase
{

    public function test__construct()
    {
        $input = new Date();
        $this->assertInstanceOf(Date::class,$input);
    }
}
