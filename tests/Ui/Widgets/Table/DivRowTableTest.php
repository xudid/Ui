<?php


use PHPUnit\Framework\TestCase;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;

class DivRowTableTest extends TestCase
{
    public function testCanConstruct()
    {
        $drt = new DivTable([],[new TableColumn("name", "Nom"),new TableColumn("email", "Mail"),new TableColumn("tel", "Téléphone")],array(array("name"=>"John","email"=>"john@free.fr","tel"=>"0652525252"),array("name"=>"Arthur","email"=>"Arthur@free.fr","tel"=>"0652535353")));
        $this->assertInstanceOf(DivTable::class,$drt);
    }
}
