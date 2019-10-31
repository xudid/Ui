<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class SearchButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new SearchButton();
        $this->assertInstanceOf(SearchButton::class,$button);
    }
}
