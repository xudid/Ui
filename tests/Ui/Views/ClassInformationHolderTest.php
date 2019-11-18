<?php

use Ui\Views\Holder\ClassInformationHolder;
use PHPUnit\Framework\TestCase;





class ClassInformationHolderTest extends TestCase
{

    public function testGetSettersNameReturnArray()
    {
		$classInformationHolder = new ClassInformationHolder("Ui\Model\Field");
        $gettersName = $classInformationHolder->getSettersName();
        $this->assertIsArray($gettersName);
    }

    public function testGetShortClassName()
    {

		$classInformationHolder = new ClassInformationHolder("Ui\Model\Field");
        $className = $classInformationHolder->getShortClassName();
        $this->assertIsString($className);
        $this->assertEquals("Field",$className);
    }

    public function testGetClassName()
    {
		$classInformationHolder = new ClassInformationHolder("Ui\Model\Field");
        $className = $classInformationHolder->getClassName();
        $this->assertIsString($className);
        $this->assertEquals("Ui\Model\Field",$className);
    }

    public function test__construct()
    {
        $classInformationHolder = new ClassInformationHolder("Ui\Model\Field");
        $this->assertInstanceOf(ClassInformationHolder::class,$classInformationHolder);
    }

    public function testHasAssociationReturnBool()
    {
        $classInformationHolder = new ClassInformationHolder("Ui\Model\Field");
        $isAssociated = $classInformationHolder->hasAssociation();
        $this->assertIsBool($isAssociated);
    }

    public function testGetGettersNameReturnsArray()
    {
        $classInformationHolder = new ClassInformationHolder("Ui\Model\Field");
        $gettersName = $classInformationHolder->getGettersName();
        $this->assertIsArray($gettersName);
    }

    public function testGetAssociationReturnsArray()
    {
        $classInformationHolder = new ClassInformationHolder("Ui\Model\Field");
        $associations = $classInformationHolder->getAssociations();
        $this->assertIsArray($associations);
    }
}
