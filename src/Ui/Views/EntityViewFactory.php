<?php
namespace Brick\Views;
use Ui\HTML\Elements\Nested\P;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Empties\Br;

use Ui\Widgets\Views\EntityView;
use Ui\Widgets\Views\EntityPartialViewFactory;
use Ui\Model\Association;
use Ui\Model\EntityInformationHolder;

use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableLegend;
use Ui\Widgets\Accordeon\CollapsibleList;
use Ui\Widgets\Accordeon\CollapsibleItem;
use Ui\Widgets\Button\{Button,SubmitButton};

use Brick\Views\TableColumn;

/**
 * [EntityViewFactory description]
 */
class EntityViewFactory{

/**
 * [private description]
 * @var [type]
 */
  private $view = null;

  private $collapsiblelist=null;
  /**
   * [private description]
   * @var [type]
   */
    private $entityView = null;

    /**
     * [private description]
     * @var [type]
     */
    private $classname = "";

    /**
     * [private description]
     * @var [type]
     */
    private $shortClassName="";

    /**
     * [private description]
     * @var [type]
     */
    private $colNames = null;

    /**
     * [private description]
     * @var [type]
     */
    private $getMethodNames = null;

    /**
     * [private description]
     * @var [type]
     */
    private $accessFilter=null;

    /**
     * [private description]
     * @var [type]
     */
    private $viewTitle=null;

    /**
     * [private description]
     * @var [type]
     */
    private $iscollapsible=false;
    /**
     * [private description]
     * @var [type]
     */
    private $viewables = null;

    /**
     * [private description]
     * @var [type]
     */
    private $eih=null;

    /**
     * [private description]
     * @var [type]
     */
    private $path="";

    /**
     * [processAssociations description]
     * @param array $associations [description]
     */
    private function processAssociations(array $associations)
    {
      foreach ($associations as $key => $value)
      {
        $associationType = $value->getType();
        //ManyToOne Association
        if($associationType=="ManyToOne"||$associationType=="ManyToMany")
        {
          $this->processManyTypeAssociations($value);
        }
        if($associationType=="OneToMany")
        {
          $this->processOneTypeAssociations($value);
        }
      }

    }

    /**
     * [processManyTypeAssociations description]
     * @param Association $association [description]
     */
    private function processManyTypeAssociations(Association $association)
    {
      $classname = $association->getClassname();
      //we work on an object to generate the view
     if($this->eih->hasEntity())
     {

       $epvf1=null;
       $val = $this->eih->getEntityFieldValue($association->getFieldname());
       //Association Many Has entity is not instance of \Doctrine\ORM\PersistentCollection
       if(!($val instanceof \Doctrine\ORM\PersistentCollection))
       {
         $epvf1 = new EntityPartialViewFactory($val,"default");
         if($epvf1 !=null)
         {
           if($this->iscollapsible)
           {
             $epvf1->setCollapsible();
             $epvf1->setCurrentPath($this->path);
             $view1 = $epvf1->getPartialView();
             $this->collapsiblelist->addItem($view1);
           }
           else
           {
             $epvf1->setCurrentPath($this->path);
             $view1 = $epvf1->getPartialView();
             $this->view->addElement($view1);
           }

         }

       }
        //Association Many Has entity is  instance of \Doctrine\ORM\PersistentCollection
       else
       {
         $collection = $val->getValues();
         $ei = new EntityInformationHolder($classname);
         $shortClassName = $ei->getShortClassName();

         $display = $this->eih->getDisplayFor($shortClassName);
         $title = ($ei->getDisplayFor($shortClassName))."s";
         $columns = $this->generateTableColumns($ei);

         $drt = new DivTable([new TableLegend($title, TableLegend::TOP_LEFT)],
         $columns,
         $collection ,false," ");

         $this->addAssociationView($drt,$display);

       }
     }
     //else We don't work on an object
    }


    /**
     * [processOneTypeAssociations description]
     * @param Association $association [description]
     */
    private function processOneTypeAssociations(Association $association)
    {
      $classname = $association->getClassname();
      //print_r("<br>".__FILE__.__LINE__.$classname."<br>");
      $shortClassName = $association->getShortClassname();
      $eih1 = new EntityInformationHolder($classname);

      $getMethods = $eih1->getGetMethodNames();
      $columns = $this->generateTableColumns($eih1);
        //we work on an object to generate the view
      if($this->eih->hasEntity())
      {
        $vals = $this->eih->getEntityFieldValue(lcfirst($shortClassName));
        $data=[];
        //  print_r("<br>".__FILE__.__LINE__.get_class($vals)."<br>");
        if($vals instanceof \Doctrine\ORM\PersistentCollection)
        {
          $class="";
          foreach ($vals as $key => $v)
          {
            $class = get_class($v);
            $dpart=[];

            foreach ($getMethods as $key => $method)
            {
              $m = new \ReflectionMethod($v, $method);
              $d = $m->invoke($v);
              $fieldname = str_replace("get", "", $method );
              $fieldname= lcfirst($fieldname);
              if(is_object($d))
              {
                $dpart[$fieldname]=$d->__toString();
              }
              else
              {
               $dpart[$fieldname]=$d;
              }

            }
            $data[]=$dpart;
          }
          $drt = new DivTable([new TableLegend($eih1->getDisplayFor($class), TableLegend::TOP_LEFT)], $columns, $data , false, "");
          $display = $eih1->getDisplayFor($eih1->getShortClassName());
          $this->addAssociationView($drt,$display);

        }

       }

    }
  /**
   * Add the view to this collabsiblelist or to this entityview
   * @param mixed $view the view to add
   * @param string $display that we see in collapsible header
   * @return
   */
  private function addAssociationView($view,$display)
  {
    if($this->iscollapsible)
    {
      $item = new CollapsibleItem();
      $item->setHeader($display);
      $item->setContent($view);
      $this->collapsiblelist->addItem($item);
    }
    else
    {

      $div = new Div();
      $div->addCssClass("view");
      $div->addElement($view);
      $this->view->addElement($div);
    }
  }

  /**
   * [generateTableColumns description]
   * @param  EntityInformationHolder $eih [description]
   *
   * @return array           [description]
   */
  private function generateTableColumns(EntityInformationHolder $eih):array
  {
    $columns=[];
    $accessFilter= $eih->getEntityAccessFilter();
    $viewables = $accessFilter->getViewablesFor($this->path);
    $methods = $eih->getGetMethodNames();
    foreach ($methods as $key => $method)
    {
      $colname = str_replace("get", "", $method );
      $colname= lcfirst($colname);
      if( in_array($colname, $viewables ))
      {
        $display = $eih->getDisplayFor($colname);
        $columns[]=new TableColumn($colname, $display);
      }
    }
    return $columns;
  }
/**
 * [__construct description]
 * @param [type] $entity       [description]
 * @param [type] $accessFilter [description]
 */

    public function  __construct($entity,$accessFilter)
    {
        $this->view = new EntityView();
        $this->eih = new EntityInformationHolder($entity);
        $this->entity = $entity;

        $this->classname = $this->eih->getClassName();
        $this->shortClassName = $this->eih->getShortClassName();
        $this->accessFilter = $this->eih->getEntityAccessFilter();


       }

       /**
        * [getView description]
        * @return string [description]
        */
       public function getView(){
         $title ="";

         if(isset($this->viewTitle))
         {
           $title = $this->viewTitle;
         }
         else
         {
           $title = $this->shortClassName;
         }

         $this->entityView = new EntityView();
         $this->view->setTitle($title);
         $this->view->addCssClass("view");

         $epvf = new EntityPartialViewFactory($this->entity,$this->accessFilter);
         $epvf->setCurrentPath($this->path);

         if($this->iscollapsible)
         {
           $this->collapsiblelist = new CollapsibleList();
           $epvf->setCollapsible();
           $this->collapsiblelist->addItem($epvf->getPartialView());
           $this->view->addElement($this->collapsiblelist);

         }
         else
         {
           $this->view->addElement($epvf->getPartialView());
         }

         if($this->eih->hasAssociation())
         {
           $associations = $this->eih->getAssociations();
           $this->processAssociations($associations);

         }
         return $this->view;
    }


/**
 * [setViewTitle description]
 * @param [type] $title [description]
 */
    public function  setViewTitle($title)
    {
      if(isset($title))
      {
        $this->viewTitle = $title;
      }
    }

    public function setCurrentPath($path)
    {
      $this->path = $path;
    }

    public function setCollapsible()
    {
      $this->iscollapsible = true;
    }
}
?>
