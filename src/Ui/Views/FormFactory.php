<?php

namespace Ui\Views;

use App\App;
use Ui\HTML\Elements\Nested\{Div, Form};
use Ui\Views\Generator\FormFieldGenerator;
use Ui\Views\Generator\ManyToManyViewGenerator;
use Ui\Views\Generator\OneToManyViewGenerator;
use Ui\Views\Generator\OneToOneViewGenerator;
use Ui\Widgets\Button\{SubmitButton};

class FormFactory extends ViewFactory
{
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


    public function getForm(App $app)
    {
        $this->app = $app;
        $this->form->setAction($this->formAction);
        if ($this->inline) {
            $this->form->setClass("form_inline");
        }
        $this->form->setClass('justify-content-around');
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
        $this->form->add($this->fieldGenerator->getPartialForm());
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
                if (is_object($this->model)) {
                    //$manager = $this->app->getModelManager($this->classNamespace);

                    $value = $this->model->getPropertyValue($association->getName());
                    $view = null;

                        //ManyToOne Association display a form
                        if ($associationType == "ManyToOne") {
                            $fieldGenerator = new FormFieldGenerator($className, "default");
                            $view = $fieldGenerator->getPartialForm();

                        }
                        //ManyToMany Association if "new" display a form if "edit" display a table
                        if ($associationType == "ManyToMany") {
                            $manyGenerator = new ManyToManyViewGenerator($className);
                            $view = $manyGenerator->getView();
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
                        $this->view->add((new Div())->setClass('row ml-0')->add($view));
                    }
                } elseif (is_string($className)) {
                    if ($associationType == "OneToOne") {
                        $fieldGenerator = new FormFieldGenerator($className);
                        $view = $fieldGenerator->getPartialForm();
                    }

                    if ($associationType == "ManyToMany") {
                        $classNameModelManager = $this->app->getModelManager($className);
                        $view = new AssociationSelect($classNameModelManager, $association);
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
}
