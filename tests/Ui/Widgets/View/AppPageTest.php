<?php

namespace Ui\Widgets\View;

use PHPUnit\Framework\TestCase;

class AppPageTest extends TestCase
{

    public function test__construct()
    {
        $appPage = new AppPage();
        $this->assertInstanceOf(AppPage::class,$appPage);
    }
}
