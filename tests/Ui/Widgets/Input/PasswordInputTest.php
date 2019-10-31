<?php

namespace Ui\Widgets\Input;

use PHPUnit\Framework\TestCase;

class PasswordInputTest extends TestCase
{

    public function test__construct()
    {
        $input = new PasswordInput("pass");
        $this->assertInstanceOf(PasswordInput::class,$input);
    }
}
