<?php


use PHPUnit\Framework\TestCase;
use Ui\HTML\Elements\Bases\Base;

/**
 * Class BaseTest
 */
class BaseTest extends TestCase
{

    public function testSetAttribute()
    {
        $base = new Ui\HTML\Elements\Bases\Base("b");
        $base->setAttribute("id","test");
        $this->assertContains('id="test"',$base->__toString());
    }



    public function testSetId()
    {
        $base = new Ui\HTML\Elements\Bases\Base("b");
        $base->setIndex('test');
        $this->assertContains('id="test"',$base->__toString());
    }

    public function test__toString()
    {
        $base = new Ui\HTML\Elements\Bases\Base("b");
        $string = $base->__toString();
        $this->assertContains("<b></b>",$string);
    }



    public function test__construct()
    {
        $base= new Ui\HTML\Elements\Bases\Base("b");
        $this->assertInstanceOf(Base::class,$base);
    }

    public function testSetContentString()
    {
        $base = new Ui\HTML\Elements\Bases\Base("b");
        $base->setContentString("test");
        $string = $base->__toString();
        $this->assertContains("<b>test</b>",$string);
    }


}
