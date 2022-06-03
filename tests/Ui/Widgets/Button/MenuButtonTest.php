<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class MenuButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new Menu();
        $this->assertInstanceOf(Menu::class,$button);
    }
}
