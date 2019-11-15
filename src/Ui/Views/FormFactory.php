<?php
namespace Ui\Views;

use Doctrine\ORM\PersistentCollection;
use Ui\HTML\Elements\Nested\{Form, P};
use Ui\Model\DefaultResolver;
use Ui\Views\Generator\FormFieldGenerator;
use Ui\Views\Generator\ManyToManyViewGenerator;
use Ui\Views\Generator\ManyToOneViewGenerator;
use Ui\Views\Generator\OneToManyViewGenerator;
use Ui\Views\Generator\OneToOneViewGenerator;
use Ui\Views\Holder\ClassInformationHolder;
use Ui\Views\Holder\EntityInformationHolder;
use Ui\Widgets\Button\{SubmitButton};

class FormFactory
{

    private $classname = "";
    private $shortClassName = "";
    private $entity = null;
    private $frm = null;
    private $accessFilter = null;
    private $ffds = null;
    private $formTitle = null;
    private $formAction = "";
    private $formMethod = "";
    private $inline = false;
    private $informationHolder = null;

    /**
     *FormFactory
     * @param $className : class name with complete namespace
     * or an Object
     *
     * @param $accessFilter : null generated form presents all the
     *                 fields of the class
     *                 default use an accessFilter named :
     *                 classname + FormFilter in the same directory of the class
     *                 a FormFilter object
     *
     * @param $action : form
     * @param $method :the method used to send data "GET"/"POST"...
     * @throws \ReflectionException
     */
    public function __construct($entity, $accessFilter, ?ViewFieldsDefinitionInterface $fieldsDefinitions = null, string $action, string $method)
    {
        //Init InformationHolderInterface
        if (is_string($entity)) {
            $this->informationHolder = new ClassInformationHolder($entity);
        } else {
            $this->informationHolder = new EntityInformationHolder($entity);
        }
        //Init class names
        $this->classname = $this->informationHolder->getClassName();
        $this->shortClassName = $this->informationHolder->getShortClassName();

        //Init Access Filter
        $this->setAccessFilter($accessFilter);


        //Init Entity
        if ($this->informationHolder->hasEntity()) {
            $this->entity = $this->informationHolder->getEntity();
            //Init FormFieldGenerator
            $this->ffg = new FormFieldGenerator($this->entity, $this->accessFilter);

        } else {
            //Init FormFieldGenerator
            $this->ffg = new FormFieldGenerator($this->classname, $this->accessFilter);

        }

        //Init Form variables
        $this->formAction = $action;
        $this->formMethod = $method;


        //Setting FieldsDefinitions
        if ($fieldsDefinitions !== null) {
            $this->ffds = $fieldsDefinitions;

        } else {
            $ffdsClassName = DefaultResolver::getFieldDefinitions($this->classname);
            $this->ffds = new $ffdsClassName($this->classname);
        }
        $this->view = new EntityView();
        $this->frm = new Form();
        $this->frm->setAction($this->formAction);
        $this->frm->setMethod($this->formMethod);
        $this->frm->setName($this->classname);
    }

    private function setAccessFilter($accessFilter)
    {
        if ($accessFilter == null) {
            $this->accessFilter = null;
        }
        if ($accessFilter === "default") {
            $accessFilterName = DefaultResolver::getFilter($this->classname);
            $this->accessFilter = new $accessFilterName();

        } else {
            $this->accessFilter = $accessFilter;

        }
    }

    public function getForm()
    {
        if (!$this->inline) {
            $this->frm->setClass("form");
        } else {
            $this->frm->setClass("form_inline");
        }

        if (!$this->inline) {
            $title = new P();
            $title->setClass("form_title");
            $t = "";
            if (isset($this->formTitle)) {
                $t = $this->formTitle;
            } else {
                $t = $this->shortClassName;
            }
            $title->add($t);
            $this->frm->add($title);
        }

        //Get partial form for class or object given
        $this->frm->add($this->ffg->getPartialForm());

        //Test if entity or class has associations
        if ($this->informationHolder->hasAssociation()) {
            $associations = $this->informationHolder->getAssociations();
            $this->processAssociations($associations);

        }
        $submitButton = new SubmitButton("Valider");
        if ($this->inline) {
            $submitButton->setClass("form_inline_button");
        }
        $this->frm->add($submitButton);
        $this->view->add($this->frm);
        return $this->view;
    }

    private function processAssociations(array $fields)
    {
        foreach ($fields as $key => $field) {
            $associationType = $field->getAssociationType();
            $className = $field->getType();
            if ($this->informationHolder->hasEntity()) {

                $value = $this->informationHolder->getEntityFieldValue($field->getName());
                $view = null;
                if ($value != null) {
                    //ManyToOne Association display a form
                    if ($associationType == "ManyToOne") {
                        $fieldGenerator = new FormFieldGenerator($className, "default");
                        $view = $fieldGenerator->getPartialForm();

                    }
                    //ManyToMany Association if "new" display a form if "edit" display a table
                    if ($associationType == "ManyToMany") {
                        $view = (new ManyToManyViewGenerator($className))->getView($value,true);

                    }
                    //OneToMany Association if "new" display a form if "edit" display a table
                    if ($associationType == "OneToMany") {
                        $view = (new OneToManyViewGenerator($className))->getView($value,true);

                    }
                    //ManyToOne Association display a form
                    if ($associationType == "OneToOne") {
                        $fieldGenerator = new FormFieldGenerator($className, "default");
                        $view = $fieldGenerator->getPartialForm();

                    }
                } else {

                }
                $this->view->add($view);
            } else {
                $fieldGenerator = new FormFieldGenerator($className, "default");
                $view = $fieldGenerator->getPartialForm();
                $this->frm->add($view);
            }

        }

    }


    private function processManyToOneAssociation($field)
    {
        //print_r(__FILE__.__LINE__." association is ".$field->getAssociationType()."<br>");
        $className = $field->getType();
        //We want to Edit Something
        $fieldGenerator = null;
        $val = null;
        $partial = null;
        $hasentity = $this->informationHolder->hasEntity();
        if ($hasentity) {
            $val = $this->informationHolder->getEntityFieldValue($field->getName());
            if ($val !== null) {
               $partial = new DataTableView(null, $className, "default");
            }
        } //We want to create something
        if (!$hasentity || $val === null) {
            //Get partial Form

        }


        //Add partiel Form to form
        $this->frm->add($partial);

    }

    /**
     * Add inputs to the form for given Field witch represents a OneToOne Association
     * If we work on an object try to get the field value and generate a filled form
     * else if we work on a class or field has null value generate an empty form
     * @param $field
     */
    private function processOneToOneAssociation($field)
    {
        //print_r(__FILE__.__LINE__." association is OneToMany <br>");
        $classname = $field->getType();
        $informationHolder = null;
        $entity = null;
        if ($this->informationHolder->hasEntity()) {
            $entity = $this->informationHolder->getEntity();
            if ($entity !== null) {
                $informationHolder = new EntityInformationHolder($entity);
            }

        }

        if ($entity === null) {
            $informationHolder = new ClassInformationHolder($classname);
        }
        $shortClassName = $informationHolder->getShortClassName();

        /** @var TYPE_NAME $informationHolder */
        $ffdsClassName = DefaultResolver::getFieldDefinitions($classname);
        $ffds = new $ffdsClassName($classname);
        $display = $ffds->getDisplayFor($shortClassName);
        $action = "";
        $button = new SubmitButton($display);
        if ($this->formAction == "update") {
            $action = "edit";
        }
        if ($this->formAction == "new") {
            $action = "new";
        }
        if ($this->entity != null) {
            $formaction = strtolower("/" . $shortClassName) . "/" . $this->entity->getId() . "/" . $action;
            $button->setFormAction($formaction);
        }
        $this->frm->add($button);
    }

    private function processManyToManyAssociation($field)
    {
        print_r(__FILE__.__LINE__." association is ".$field->getAssociationType()."<br>");
        $className = $field->getType();
        $fieldGenerator = null;
        $partial = null;
        if ($this->informationHolder->hasEntity()) {
            $val = $this->informationHolder->getEntityFieldValue($field->getName());
            if ($val !== null) {
                $partial = new DataTableView(null, $className, "default");
            } else {
                //Get partial Form
                $fieldGenerator = new FormFieldGenerator($className, "default");
                $partial = $fieldGenerator->getPartialForm();
            }

        } else {
            //Get partial Form
            $fieldGenerator = new FormFieldGenerator($className, "default");
            $partial = $fieldGenerator->getPartialForm();
        }
        $this->frm->add($partial);
    }

    private function processOneToManyAssociation($field)
    {
        $className = $field->getType();

        $fieldGenerator = null;
        $partial = null;
        if ($this->informationHolder->hasEntity()) {
            $val = $this->informationHolder->getEntityFieldValue($field->getName());
            if ($val !== null) {

                $partial = (new DataTableView(null, $className, "default"))->withClickableRows("/role/edit")->getView();
            } else {
                //Get partial Form
                $fieldGenerator = new FormFieldGenerator($className, "default");
                $partial = $fieldGenerator->getPartialForm();
            }

        } else {
            //Get partial Form
            $fieldGenerator = new FormFieldGenerator($className, "default");
            $partial = $fieldGenerator->getPartialForm();
        }
        $this->frm->add($partial);

    }

    public function setInline()
    {
        $this->inline = true;
    }

    public function setFormTitle($title)
    {
        if (isset($title)) {
            $this->formTitle = $title;
        }
    }
}
