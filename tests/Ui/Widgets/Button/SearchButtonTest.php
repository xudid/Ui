<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class SearchButtonTest extends TestCase
{

    public function test__construct()
    {
        $button = new Search();
        $this->assertInstanceOf(Search::class,$button);
    }
}
