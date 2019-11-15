<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class MenuButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new MenuButton();
        $this->assertInstanceOf(MenuButton::class,$button);
    }
}
