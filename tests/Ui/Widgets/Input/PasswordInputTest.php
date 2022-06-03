<?php

namespace Ui\Widgets\Input;

use PHPUnit\Framework\TestCase;

class PasswordInputTest extends TestCase
{

    public function test__construct()
    {
        $input = new Password("pass");
        $this->assertInstanceOf(Password::class,$input);
    }
}
