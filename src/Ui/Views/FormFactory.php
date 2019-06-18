<?php
namespace Brick\Views;
use Brick\HtmlElements\NestedHtmlElement\{Form,P};

use Brick\HtmlElements\EmptyElements\Br;

use Brick\HtmlElements\NestedHtmlElement\Div;


use Brick\Ui\{SubmitButton};


use Brick\Model\Association;
use Brick\Model\EntityInformationHolder;

use Brick\Ui\DivRowTable;
use Brick\Ui\TableLegend;

use Brick\Views\TableColumn;

use Doctrine\ORM\PersistentCollection;

class FormFactory
{

    private $classname = "";
    private $shortClassName="";
    private $entity = null;
    private $colNames = null;
    private $getMethodNames = null;
    private $frm = null;
    private $view =null;
    private $accessFilter=null;
    private $ffds = null;
    private $formTitle=null;
	  private $formAction ="";
	  private $formMethod="";
    //private $writables =[];
    //private $viewables =[];
    private $inline = false;
    private $eih=null;
/**
*FormFactory
*@param $className : class name with complete namespace
*or an Object
*
*@param $accessFilter : null generated form presents all the
*                 fields of the class
*               default use an accessFilter named :
*                 classname + FormFilter in the same directory of the class
*               a FormFilter object
*
*@param $action : form
*
*@param $method :the method used to send data "GET"/"POST"...
*/
    public function __construct($className,$accessFilter,$action,$method)
    {
      $this->eih = new EntityInformationHolder($className);
      $this->setAccessFilter($accessFilter);
      $this->ffg = new FormFieldGenerator($className,$accessFilter);
      $this->classname = $this->eih->getClassName();

      $this->shortClassName = $this->eih->getShortClassName();
      if($this->eih->hasEntity())
      {
        $this->entity = $this->eih->getEntity();
      }
        $this->formAction = $action;
		    $this->formMethod = $method;
        $this->ffds = $this->eih->getFormFieldDefinitions();
        $this->frm = new Form();
        $this->view = new Div();
        $this->view->addElement($this->frm);
        $this->frm->setAction($this->formAction);
        $this->frm->setMethod($this->formMethod);
        $this->frm->setName($this->classname);
    }

    public function getForm()
    {
      if(!$this->inline)
      {
        $this->frm->addCssClass("form");
      }
      else
      {
        $this->frm->addCssClass("form_inline");
      }

      if(!$this->inline)
      {
        $title = new P($this->classname);
        $title->addCssClass("form_title");
        $t="";
        if(isset($this->formTitle))
        {
          $t = $this->formTitle;}
          else
          {
            $t = $this->shortClassName;
          }
          $title->addElement($t);
          $this->frm->addElement($title);
        }
        $this->frm->addElement(new Br());

        //Get partial form for class or object given
        $fields = $this->ffg->getPartialForm();
        //add entity fields
        $this->frm->addElement($fields);

        //Test if entity or class has associations
        if($this->eih->hasAssociation())
        {
          //get entity associations
          $associations = $this->eih->getAssociations();
          //Foreach association
          foreach ($associations as $key => $association)
          {
            //test if entity exists for association
            //get entity

            $associationType = $association->getType();


            if($associationType=="ManyToOne"||$associationType=="ManyToMany")
            {
              //print_r(__FILE__.__LINE__." association OneToOne <br>");
              $this->processManyTypeAssociation($association);
            }
            if($associationType=="OneToOne")
            {
              //print_r(__FILE__.__LINE__." association OneToOne <br>");
              $this->processOneTypeAssociation($association);
            }

              if($associationType=="OneToMany")
              {
                $this->processOneTypeAssociation($association);
              }
          }
        }
        $submitButton = new SubmitButton("Valider");
        if($this->inline)
        {
          $submitButton->addCssClass("form_inline_button");
        }
        $this->frm->addElement($submitButton);
        $this->view->addCssClass("form");
        return $this->view;
}

private function processManyTypeAssociation(Association $association)
{
  //print_r(__FILE__.__LINE__." association is ".$association->getType()."<br>");
  $classname = $association->getClassname();
    //We want to Edit Something
    if($this->eih->hasEntity())
    {
      $val = $this->eih->getEntityFieldValue($association->getFieldname());
      if(!($val instanceof \Doctrine\ORM\PersistentCollection))
      {
        $ffg1 = new FormFieldGenerator($val,"default");
        //Get partial Form
        $fields1 = $ffg1->getPartialForm();
        //Add partiel Form to form
        $this->frm->addElement($fields1);
      }
      else
      {
        $collection = $val->getValues();
        $ei = new EntityInformationHolder($classname);
        $title = $ei->getDisplayFor($ei->getShortClassName());
        $drt = new DivRowTable([new TableLegend($title, TableLegend::TOP_LEFT)],
        [new TableColumn("name", "Roles")],
        $collection ,false," ");
        $this->frm->addElement($drt);
      }

    }
    //We want to create somethong
    else
    {
      $ffg1 = new FormFieldGenerator($classname,"default");
      //Get partial Form
      $fields1 = $ffg1->getPartialForm();
      //Add partiel Form to form
      $this->frm->addElement($fields1);
    }

}

private function processOneTypeAssociation(Association $association)
{
  //print_r(__FILE__.__LINE__." association is OneToMany <br>");

  $classname = $association->getClassname();
  $eih1 = new EntityInformationHolder($classname);
  $display = $eih1->getDisplayFor($eih1->getShortClassName());
  $action ="";
  $button = new SubmitButton($display);
  if($this->formAction == "update")
  {
    $action = "edit";
  }
  if($this->formAction == "new")
  {
    $action = "new";
  }
  if($this->entity !=null)
  {
    $formaction =strtolower("/".$eih1->getShortClassName())."/".$this->entity->getId()."/".$action;
    $button->setFormAction($formaction);
  }
  $this->frm->addElement( $button);
}


    public function setInline()
    {
        $this->inline = true ;
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

    public function setFormTitle($title)
    {
      if(isset($title)){
        $this->formTitle=$title;
      }
    }
}

?>
