<?php


use PHPUnit\Framework\TestCase;
use Ui\HTML\Element\Base\Base;

/**
 * Class BaseTest
 */
class BaseTest extends TestCase
{

    public function testSetAttribute()
    {
        $base = new Ui\HTML\Element\Base\Base("b");
        $base->setAttribute("id","test");
        $this->assertStringContainsString('id="test"',$base->__toString());
    }



    public function testSetId()
    {
        $base = new Ui\HTML\Element\Base\Base("b");
        $base->setId('test');
        $this->assertStringContainsString('id="test"',$base->__toString());
    }

    public function test__toString()
    {
        $base = new Ui\HTML\Element\Base\Base("b");
        $string = $base->__toString();
        $this->assertStringContainsString("<b></b>",$string);
    }



    public function test__construct()
    {
        $base= new Ui\HTML\Element\Base\Base("b");
        $this->assertInstanceOf(Base::class,$base);
    }

    public function testSetContentString()
    {
        $base = new Ui\HTML\Element\Base\Base("b");
        $base->setContentString("test");
        $string = $base->__toString();
        $this->assertStringContainsString("<b>test</b>",$string);
    }


}
