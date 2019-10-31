<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class ViewListButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new ViewListButton();
        $this->assertInstanceOf(ViewListButton::class,$button);
    }
}
