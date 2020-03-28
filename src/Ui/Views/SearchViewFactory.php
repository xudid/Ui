<?php

namespace Ui\Views;

use Entity\DefaultResolver;
use ReflectionClass;
use Ui\HTML\Elements\Empties\Br;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Form;
use Ui\HTML\Elements\Nested\P;
use Ui\Views\Holder\TraitInformationHolder;
use Ui\Widgets\Accordeon\CollapsibleItem;
use Ui\Widgets\Accordeon\CollapsibleList;
use Ui\Widgets\Button\CheckBox;
use Ui\Widgets\Button\SubmitButton;
use Ui\Widgets\Input\PasswordInput;
use Ui\Widgets\Input\SelectOption;
use Ui\Widgets\Input\TextInput;

class SearchViewFactory
{
    private $classname = "";
    private $viewTitle = null;
    private $form = null;
    private $searchables;
    private $viewables;
    private $writables;
    private $informationHolder = null;
    private $formFieldDefinitions = null;
    /**
     * @var object
     */
    private object $accessFilter;
    use TraitInformationHolder;

    public function __construct($entity, $accessFilter, $action, $method)
    {

        $this->formAction = $action;
        $this->formMethod = $method;
        $this->getInformationHolder($entity);
        $this->classname = $this->informationHolder->getClassName();
        $this->setAccessFilter($accessFilter);

        $formFieldDefinitions = DefaultResolver::getFieldDefinitions($this->classname);
        $this->formFieldDefinitions = new $formFieldDefinitions();
        //$this->setFormFieldDefinitions();
        $this->setAccessFilter($accessFilter);
        $this->colNames = $this->getColumnNames($this->classname);
        $this->searchables = $this->accessFilter->getSearchables();


    }

    public function getSearchView()
    {
        $this->form = new Form();
        $this->form->setClass("form");
        $this->form->setAction($this->formAction);
        $this->form->setMethod($this->formMethod);
        $this->form->setName($this->classname);
        $t = "Search :" . $this->classname;
        if (isset($this->viewTitle)) {
            $t = $this->viewTitle;
        }
        $title = new P($t);
        $title->add($t);
        $title->setClass("form_title");
        $this->form->add($title);
        //$this->frm->add(new Br());

        $choose = new Div();
        $collapsiblelist = new CollapsibleList();
        $item = new CollapsibleItem();
        $item->setHeader("Search parameters");
        $item->setContent($choose);
        $collapsiblelist->addItem($item);

        $this->form->add($collapsiblelist);
        foreach ($this->colNames as $value) {
            if (in_array($value, $this->searchables)) {

                $checkbox = new CheckBox($value, $value);
                $checkbox->withLabel($value, $value);
                $choose->add($checkbox);

                switch ($this->formFieldDefinitions->getInputTypeFor($value)) {
                    case "input":
                    {
                        $input = new TextInput();
                        $input->setName($value);
                        $input->SetPlaceholder($value);
                        $input->setIndex($value);
                        $this->form->add($input);
                        $this->form->add(new br());
                        break;
                    }
                    case "password":
                    {
                        $input = new PasswordInput("password", $value);
                        $input->setName($value);
                        $input->SetPlaceholder($value);
                        $input->setId($value);
                        $this->form->add($input);
                        $this->form->add(new br());
                        break;
                    }
                    case "select":
                    {
                        $options = $this->formFieldDefinitions->getDataForListInput($value);
                        $selOption = new SelectOption($options);
                        $selOption->setIndex($value);
                        $selOption->setName($value);
                        $this->form->add($selOption);
                        $this->form->add(new br());
                        break;
                    }


                }
            }
        }
        $submit = new SubmitButton("Valider");
        $submit->setName("submit");
        $this->form->add($submit);
        return $this->form;
    }


    public function getEntityName($entity)
    {
        $rc = new ReflectionClass($entity);
        return $rc->getName();
    }

    private function setAccessFilter($accessFilter)
    {
        if ($accessFilter == null) {
            $path_parts = explode('\\', $this->classname);
            $path_parts_l = count($path_parts);
            $path_parts[$path_parts_l - 2] = "Views";
            $path_parts[$path_parts_l - 1] = $path_parts[$path_parts_l - 1] . "FormFilter";
            $classname = implode('\\', $path_parts);
            $class = new ReflectionClass($classname);
            $this->accessFilter = $class->newInstance();

        } else {
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

    private function getSearchables()
    {
        $result = array();
        $result = $this->accessFilter->getSearchables();
        return $result;

    }


    private function setClassName($className)
    {
        if (is_string($className)) {
            $this->classname = $className;
        } else {
            $this->classname = $this->getEntityName($className);
        }

    }

    public function getColumnNames($entity)
    {
        $result = array();
        $rc = new ReflectionClass($entity);
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

    public function getMethodNames($entity)
    {
        $result = array();
        $rc = new ReflectionClass($entity);
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

    public function setViewTitle($title)
    {
        if (isset($title)) {
            $this->viewTitle = $title;

        }
    }
}
