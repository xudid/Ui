<?php

namespace Ui\Widgets\Input;

use PHPUnit\Framework\TestCase;

class ColorInputTest extends TestCase
{

    public function test__construct()
    {
        $input = new Color();
        $this->assertInstanceOf(Color::class,$input);
    }
}
