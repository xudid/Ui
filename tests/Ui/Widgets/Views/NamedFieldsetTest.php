<?php

namespace Ui\Widgets\Views;

use PHPUnit\Framework\TestCase;

class NamedFieldsetTest extends TestCase
{

    public function test__construct()
    {
        $nfs = new NamedFieldset("legend");
        $this->assertInstanceOf(NamedFieldset::class,$nfs);
    }
}
