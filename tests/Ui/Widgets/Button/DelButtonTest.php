<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class DelButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new DelButton();
        $this->assertInstanceOf(DelButton::class,$button);
    }
}
