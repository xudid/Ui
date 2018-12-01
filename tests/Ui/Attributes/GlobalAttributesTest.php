<?php
namespace Brick\tests\Ui\Attributes;
use Brick\Ui\HTML\Attributes\GlobalAttribute;


use PHPUnit\Framework\TestCase;

/**
 * test case.
 */
class GlobalAttributesTest extends TestCase
{

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // TODO Auto-generated GlobalAttributesTest::setUp()
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated GlobalAttributesTest::tearDown()
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */


    public function testCanContructGlobalAttribute()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $this->assertNotEquals(null,$attr);
    }

    public function testaccesskeyAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::accesskeyAttribute;
        $this->assertEquals("accesskey", $r);
    }

    public function testclassAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::classAttribute;
        $this->assertEquals("class", $r);
    }

    public function testcontenteditableAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::contenteditableAttribute;
        $this->assertEquals("contenteditable", $r);
    }

    public function testcontextmenuAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::contextmenuAttribute;
        $this->assertEquals("contextmenu", $r);
    }

    public function testdirAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::dirAttribute;
        $this->assertEquals("dir", $r);
    }

    public function testdraggableAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::draggableAttribute;
        $this->assertEquals("draggable", $r);
    }

    public function testdropzoneAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::dropzoneAttribute;
        $this->assertEquals("dropzone", $r);
    }

    public function testhiddenAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::hiddenAttribute;
        $this->assertEquals("hidden", $r);
    }

    public function testidAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::idAttribute;
        $this->assertEquals("id", $r);
    }

    public function testlangAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::langAttribute;
        $this->assertEquals("lang", $r);
    }

    public function testspellcheckAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::spellcheckAttribute;
        $this->assertEquals("spellcheck", $r);
    }

    public function teststyleAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::styleAttribute;
        $this->assertEquals("style", $r);
    }

    public function testtabindexAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::tabindexAttribute;
        $this->assertEquals("tabindex", $r);
    }

    public function testtitleAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::titleAttribute;
        $this->assertEquals("title", $r);
    }

    public function testtranslateAttributeNameValue()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr::translateAttribute;
        $this->assertEquals("translate", $r);
    }

    public function testAttributeNameClassIsInFinalString()
    {
        $attr = new GlobalAttribute(GlobalAttribute::classAttribute, "test");
        $r = $attr->__toString();
        $this->assertContains(GlobalAttribute::classAttribute, $r);
        $this->assertContains("test", $r);

    }

    public function testAttributeNameIdIsInFinalString()
    {
        $attr = new GlobalAttribute(GlobalAttribute::idAttribute, "test");
        $r = $attr->__toString();
        $this->assertContains(GlobalAttribute::idAttribute, $r);
        $this->assertContains("test", $r);

    }
}
