<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class AddButtonTest extends TestCase
{
    public function test__construct()
    {
        $button = new AddButton();
        $this->assertInstanceOf(AddButton::class,$button);
    }
}
