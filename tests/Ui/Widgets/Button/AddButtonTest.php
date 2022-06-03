<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class AddButtonTest extends TestCase
{
    public function test__construct()
    {
        $button = new Add();
        $this->assertInstanceOf(Add::class,$button);
    }
}
