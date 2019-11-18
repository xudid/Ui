<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class ButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new Button("test");
        $this->assertInstanceOf(Button::class,$button);
    }
}
