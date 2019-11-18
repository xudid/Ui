<?php

namespace Ui\Widgets\Views;

use PHPUnit\Framework\TestCase;

class NavBarTest extends TestCase
{

    public function test__construct()
    {
        $navbar = new NavBar();
        $this->assertInstanceOf(NavBar::class,$navbar);
    }
}
