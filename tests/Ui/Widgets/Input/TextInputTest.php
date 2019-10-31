<?php

namespace Ui\Widgets\Input;

use PHPUnit\Framework\TestCase;

class TextInputTest extends TestCase
{

    public function test__construct()
    {
        $input = new TextInput();
        $this->assertInstanceOf(TextInput::class,$input);
    }
}
