<?php

namespace Ui\Views;

use Entity\Model\ManagerInterface;
use Entity\Model\ModelManager;
use Router\Router;
use Ui\HTML\Elements\Bases\H5;
use Ui\HTML\Elements\Nested\{Div, Form};
use Ui\Views\Generator\FormFieldGenerator;
use Ui\Views\Generator\ManyToManyViewGenerator;
use Ui\Views\Generator\OneToManyViewGenerator;
use Ui\Views\Generator\OneToOneViewGenerator;
use Ui\Widgets\Button\{SubmitButton};
use Ui\Widgets\Input\HiddenInput;

class FormFactory extends ViewFactory
{
    private ?Router $router;
    private ?ModelManager $modelManager;
    private $form = null;
    private $formTitle = null;
    private $formAction = '';
    private $formMethod = 'POST';
    private $inline = false;

    private $app;
    /**
     * @var FormFieldGenerator
     */
    private FormFieldGenerator $fieldGenerator;
    /**
     * @var $model
     */
    protected $model;

    /**
     *FormFactory
     * @param $model
     * @throws \ReflectionException
     */
    public function __construct($model)
    {
        parent::__construct($model);

        try {
            $this->setFieldsDefinitions();

            $this->view = (new EntityView())->setClass("bg-light text-dark shadow-lg py-3 m-4");
            $this->form = new Form();
            $this->form->setAction($this->formAction)
                ->setMethod($this->formMethod)
                ->setName($this->classNamespace)
                ->setClass('m-3');
        } catch (\ReflectionException $e) {
            throw $e;
        }
    }

    public function withAction(string $action)
    {
        $this->formAction = $action;
        return $this;
    }

    public function withMethod(string $method)
    {
        $this->formMethod = $method;
        return $this;
    }


    public function getForm()
    {
        $this->form->setAction($this->formAction);
        if ($this->inline) {
            $this->form->setClass("form_inline");
        }
        $this->form->setClass('justify-content-around p-3');
        if (!$this->inline) {
            $t = "";
            if (isset($this->formTitle)) {
                $t = $this->formTitle;
            } else {
                $t = $this->shortClassName;
            }
            $this->view->setTitle($t);
        }

        //Init FormFieldGenerator
        $this->fieldGenerator = new FormFieldGenerator($this->model, $this->accessFilter);

        if ($this->inline) {
            $this->fieldGenerator->setInline();
        }
        //Get partial form for class or object given
        $this->fieldGenerator->setAccessFilter($this->accessFilter);
        $this->fieldGenerator->setContainer($this->form);
        $this->fieldGenerator->getPartialForm();

        $this->view->add($this->form);
        //Test if entity or class has associations
        $model = $this->model;
        if (is_string($model)) {
            $model = new $model([]);
        }
        $associations = $model::getAssociations();
        if (count($associations) > 0) {
            $this->processAssociations($associations);
        }
        $submitButton = new SubmitButton("Valider");
        if ($this->inline) {
            $submitButton->setClass("btn btn-primary form_inline_button");
        } else {
            $submitButton->setClass("btn btn-primary ml-3");
        }
        $this->form->add($submitButton);
        return $this->view;
    }

    private function processAssociations(array $associations)
    {
        //here we must create fields for unary relations and a link
        // to a formtable to manage many associations
        // to do that make a form optionnal on the first datatableview with ajax for crud

        foreach ($associations as $key => $association) {
            if (in_array(strtolower($association->getName()),
                $this->accessFilter->getWritables())
            ) {
                $associationType = $association->getType();
                $className = $association->getOutClassName();
                $shortName = $association->getName();
                $view = null;
                if (is_object($this->model)) {

                    $value = $this->model->getPropertyValue($association->getName());

                    //ManyToOne Association display a form
                    if ($associationType == "ManyToOne") {
                        $fieldGenerator = new FormFieldGenerator($className, "default");
                        $fieldGenerator->setContainer($this->form);
                        $view = $fieldGenerator->getPartialForm();

                    }
                    //ManyToMany Association if "new" display a form if "edit" display a table
                    if ($associationType == "ManyToMany") {
                        if ($value) {
                            $associationTable = $association->getTableName();
                            $url = $this->router->generateUrl($associationTable, ['id' => $this->model->getId(), 'GET']);
                            $manyGenerator = new ManyToManyViewGenerator($className);
                            $view = $manyGenerator->getView($url);
                        } else {
                            $manyGenerator = new ManyToManyViewGenerator($className);
                            $view = $manyGenerator->getView();
                        }


                    }
                    //OneToMany Association if "new" display a form if "edit" display a table
                    if ($associationType == "OneToMany") {
                        $view = (new OneToManyViewGenerator($className))->getView($value, true);

                    }
                    //ManyToOne Association display a form
                    if ($associationType == "OneToOne") {
                        $view = (new OneToOneViewGenerator($className))->getView($value, true);
                    }

                    if ($view) {
                        $this->form->add((new Div())->setClass('row ml-0')->add($view));
                    }
                } elseif (is_string($className)) {
                    $title = $this->fieldsDefinitions->getDisplayFor($shortName);
                    $this->form->add((new H5($title)));
                    if ($associationType == "OneToOne") {
                        $fieldGenerator = new FormFieldGenerator($className);
                        $fieldGenerator->setContainer($this->form);
                        $view = $fieldGenerator->getPartialForm();
                    }

                    if ($associationType == "ManyToMany") {
                        $classNameModelManager = $this->modelManager->manage($className);
                        $view = new AssociationSelect($classNameModelManager, $association);
                    }
                    if ($view) {
                        $this->form->add((new Div())->setClass('row m-2')->add($view));
                    }
                }

            }
        }
    }

    public function setInline()
    {
        $this->inline = true;
        return $this;
    }

    public function setFormTitle($title)
    {
        if (isset($title)) {
            $this->formTitle = $title;
        }
        return $this;
    }

    public function addHiddenInput(HiddenInput $input)
    {
        $this->form->add($input);
        return $this;
    }

    public function setRouter(Router $router)
    {
        $this->router = $router;
        return $this;
    }

    public function setManager(ManagerInterface $manager)
    {
        $this->modelManager = $manager;
        return $this;
    }
}
