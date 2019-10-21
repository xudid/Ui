<?php 
namespace Ui\Views;?>

<style>
  .head {background-color:lightgray;color:#000000;display: table-header-group;font-weight:bold;text-align:center;}
  .cell {display: table-cell;padding: 0.5rem; border: 1px solid #999;border-radius: 3px;}
</style>
<?php
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Header;
/**
 *
 */
class DivRowTableHeaderFactory
{

  private $colnames =[];

  function __construct($colnames)
  {
    $this->colnames = $colnames;
  }

  private function getTableHeader()
  {
      $header = new Header();
      $header->addCssClass("head");
      foreach($this->colnames as $val)
      {
        $header->addElement($this->getCell(\ucfirst($val),false));
      }
      return $header;
  }

  private function getCell($value,$isEditable)
  {
      $div = new Div();
      $div->addCssClass("cell");
      if($isEditable)
      {
        $div->setContentEditable();
      }
      $div->addElement($value);
      return $div;
  }
}

 ?>
