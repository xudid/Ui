<?php

namespace Ui\Widgets\Input;

use PHPUnit\Framework\TestCase;

class EmailInputTest extends TestCase
{

    public function test__construct()
    {
        $input = new EmailInput();
        $this->assertInstanceOf(EmailInput::class,$input);
    }
}
