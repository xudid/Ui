<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class SubmitButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new Submit("test");
        $this->assertInstanceOf(Submit::class,$button);
    }
}
