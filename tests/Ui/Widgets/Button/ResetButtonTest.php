<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class ResetButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new ResetButton("test");
        $this->assertInstanceOf(ResetButton::class,$button);
    }
}
