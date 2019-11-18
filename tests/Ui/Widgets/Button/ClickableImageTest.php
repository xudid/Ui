<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class ClickableImageTest extends TestCase
{

    public function test__construct()
    {
        $button = new ClickableImage( "/action","/pictures/logo.png","action");
        $this->assertInstanceOf(ClickableImage::class,$button);
    }
}
