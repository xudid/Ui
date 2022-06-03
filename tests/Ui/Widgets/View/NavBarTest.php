<?php

namespace Ui\Widgets\View;

use PHPUnit\Framework\TestCase;
use Ui\Widgets\View\Navbar\Navbar;

class NavBarTest extends TestCase
{

    public function test__construct()
    {
        $navbar = new Navbar();
        $this->assertInstanceOf(Navbar::class,$navbar);
    }
}
