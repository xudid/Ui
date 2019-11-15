<?php

namespace Ui\Widgets\Input;

use PHPUnit\Framework\TestCase;

class ColorInputTest extends TestCase
{

    public function test__construct()
    {
        $input = new ColorInput();
        $this->assertInstanceOf(ColorInput::class,$input);
    }
}
