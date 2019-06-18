<?php
namespace Ui\Views;
use Ui\Model\EntityInformationHolder;
use Ui\HTML\Elements\NestedHtmlElement\Form;
use Ui\HTML\Elements\NestedHtmlElement\Div;
use Ui\HTML\Elements\NestedHtmlElement\P;
use Ui\HTML\Elements\EmptyElements\Br;

use Ui\Widgets\Input\TextInput;
use Ui\Widgets\Input\SelectOption;
use Ui\Widgets\Button\SubmitButton;
use Ui\Widgets\Button\CheckBox;
use Ui\Widgets\Lists\CollapsibleList;
use Ui\Widgets\Lists\CollapsibleItem;

class SearchViewFactory
{
  private $classname="";
  private $viewTitle=null;
  private $frm=null;
  private $searchables;
  private $viewables;
  private $writables;
  private $eih=null;
  private $ffds=null;

  public function __construct($className,$accessFilter,$action,$method)
  {

    $this->formAction = $action;
	  $this->formMethod = $method;
    $this->eih = new EntityInformationHolder($className);
    $this->classname = $this->eih->getClassName();
    $this->setAccessFilter($accessFilter);


    $this->ffds = $this->eih->getFormFieldDefinitions();
    //$this->setFormFieldDefinitions();
	  $this->setAccessFilter($accessFilter);
    $this->colNames = $this->getColumnNames($this->classname);
    $this->searchables = $this->eih->getSearchables();


  }

public function getSearchView()
{
	$this->frm = new Form();
  $this->frm->addCssClass("form");
  $this->frm->setAction($this->formAction);
  $this->frm->setMethod($this->formMethod);
  $this->frm->setName($this->classname);
	$t="Search :".$this->classname;
  if(isset($this->viewTitle))
  {
		$t= $this->viewTitle;
	}
	$title = new P($t);
	$title->addElement($t);
  $title->addCssClass("form_title");
  $this->frm->addElement($title);
  //$this->frm->addElement(new Br());

  $choose = new Div();
  $collapsiblelist = new CollapsibleList();
  $item = new CollapsibleItem();
  $item->setHeader("Search parameters");
  $item->setContent($choose);
  $collapsiblelist->addItem($item);

  $this->frm->addElement($collapsiblelist);
  foreach ($this->colNames as $value)
  {
    if(in_array($value,$this->searchables))
    {

       $checkbox = new CheckBox($value,$value);
       $checkbox->withLabel($value,$value);
       $choose->addElement($checkbox);

      switch ($this->ffds->getInputTypeFor($value))
      {
          case "input":
          {
            $input = new TextInput();
            $input->setName($value);
            $input->SetPlaceholder($value);
            $input->setId($value);
            $this->frm->addElement($input);
            $this->frm->addElement(new br());
            break;
          }
          case "password":
          {
            $input = new PasswordInput("password", $value);
            $input->setName($value);
            $input->SetPlaceholder($value);
            $input->setId($value);
            $this->frm->addElement($input);
            $this->frm->addElement(new br());
            break;
          }
          case "select":
          {
            $options = $this->ffds->getDataForListInput($value);
						$selOption = new SelectOption($options);
						$selOption->setId($value);
						$selOption->setName($value);
						$this->frm->addElement($selOption);
            $this->frm->addElement(new br());
            break;
           }



      }
    }
  }
  $submit = new SubmitButton("Valider");
  $submit->setName("submit");
  $this->frm->addElement($submit);
	return $this->frm;
}


	public function getEntityName($entity)
  {
        $rc = new \ReflectionClass($entity);
        return $rc->getName();
  }

   private function setAccessFilter($accessFilter)
   {
        if($accessFilter == null)
        {
            $path_parts = explode('\\',$this->classname);
            $path_parts_l = count($path_parts);
            $path_parts[$path_parts_l-2]="Views";
            $path_parts[$path_parts_l-1]=$path_parts[$path_parts_l-1]."FormFilter";
            $classname = implode('\\',$path_parts);
            $class = new \ReflectionClass($classname);
            $this->accessFilter = $class->newInstance();

        }
        else
        {
            $this->accessFilter = $accessFilter;
        }


    }

    // private function setFormFieldDefinitions()
    // {
    //     $classname = $this->classname."FormFieldDefinition";
    //
    //     try{
    //     $class = new \ReflectionClass($classname);
    //     }
    //     catch(\ReflectionException $logicDuh){
    //         print_r($logicDuh);
    //     }
    //
    //     $this->ffds = $class->newInstance();
    // }

    private function getSearchables(){
        $result = array();
        $result= $this->accessFilter->getSearchables();
        return $result;

    }


    private function setClassName($className){
        if (is_string($className)) {
            $this->classname = $className;
        }
        else{
            $this->classname = $this->getEntityName($className);
        }

    }

    public function getColumnNames($entity) {
        $result = array();
        $rc = new \ReflectionClass($entity);
        foreach ($rc->getMethods() as $method) {
            $methodName = $method->getName();
            if (strstr($methodName, 'set') == $methodName) {
                $field = str_replace('set', '', $methodName);
                $string = strtolower($field);

                    $result[] = $string;

            }
        }

        return $result;
    }

    public function getMethodNames($entity) {
        $result = array();
        $rc = new \ReflectionClass($entity);
        foreach ($rc->getMethods() as $method) {
            $methodName = $method->getName();
            if (strstr($methodName, 'get') == $methodName) {
                $field = str_replace('get', '', $methodName);
                $string = strtolower($field);

                    $result[] = $methodName;

            }
        }

        return $result;
    }

		public function  setViewTitle($title){
      if(isset($title)){
        $this->viewTitle = $title;

      }
    }


}
?>
