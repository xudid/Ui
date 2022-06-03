<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class ResetButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new Reset("test");
        $this->assertInstanceOf(Reset::class,$button);
    }
}
