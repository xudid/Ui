<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class SubmitButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new SubmitButton("test");
        $this->assertInstanceOf(SubmitButton::class,$button);
    }
}
