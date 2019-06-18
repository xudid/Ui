<?php
namespace Ui\Views;

use Ui\Views\EntityView;
use Ui\Model\EntityInformationHolder;
use Ui\HTML\Elements\NestedHtmlElement\P;
use Ui\Widgets\Accordeon\CollapsibleItem;
use Ui\HTML\Elements\EmptyElements\Br;

/**
 *
 */
class EntityPartialViewFactory
{
  private $entity=null;
  private $eih=null;
  private $classname="";
  private $shortclassname="";
  private $accessFilter=null;
  private $colNames=[];
  private $getMethodNames=[];
  private $iscollapsible=false;
  /**
   * [private description]
   * @var [type]
   */
  private $path="";

  function __construct($entity,$accessFilter)
  {
    $this->entity = $entity;
    $this->eih = new EntityInformationHolder($entity);
    $this->classname = $this->eih->getClassName();
    $this->shortClassName = $this->eih->getShortClassName();

    $this->setAccessFilter($accessFilter);
    $this->colNames =   $this->eih->getColumnNames() ;
    $this->getMethodNames = $this->eih->getGetMethodNames();


  }


/**
 * [getPartialView description]
 * @return [type] [description]
 */
  public function getPartialView()
  {
    $this->viewables = $this->accessFilter->getViewablesFor($this->path);
  
    if($this->iscollapsible)
    {
      $this->entityView = new CollapsibleItem();
      $display = $this->eih->getDisplayFor($this->shortClassName);
      $this->entityView->setHeader($display);
      $content=new P();

      $content = $this->generateContent();
      $this->entityView->setContent($content);

    }
    else
    {
      $this->entityView = new EntityView();
      $this->entityView->addCssClass("view");
      $content = $this->generateContent();
      $this->entityView->addElement($content);
    }


    return $this->entityView->__toString();
  }

/**
 * [generateContent description]
 *
 */
private function generateContent()
{
  $element = new P();
  foreach ($this->colNames as $value)
  {
    if (in_array($value,$this->viewables))
    {
       $val = $this->eih->getEntityFieldValue($value);
       $display = $this->eih->getDisplayFor($value);
       $element->addElement(ucfirst($display).": ");
       $element->addElement($val);
       $element->addElement(new Br());
   }
  }
  return $element;

}
  private function setAccessFilter($accessFilter)
  {

    if($accessFilter == null)
    {
      $this->accessFilter = null;
    }
    if($accessFilter == "default")
    {

      $this->accessFilter =
                    $this->eih->getEntityAccessFilter();

    }
    else
    {

      $this->accessFilter = $accessFilter;

    }
  }

  /**
   * [setCollapsible description]
   */
  public function setCollapsible()
  {
    $this->iscollapsible =true;
  }

  public function setCurrentPath($path)
  {
    $this->path = $path;
  }
}


?>
