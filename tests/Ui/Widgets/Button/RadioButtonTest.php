<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class RadioButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new RadioButton("radio","test");
        $this->assertInstanceOf(RadioButton::class,$button);
    }
}
