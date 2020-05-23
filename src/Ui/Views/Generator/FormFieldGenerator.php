<?php

namespace Ui\Views\Generator;

use Ui\HTML\Elements\Nested\Nested;
use Ui\Views\FormFieldAdder;
use Ui\Views\ViewFactory;
use Ui\HTML\Elements\ElementInterface;
use Ui\Widgets\Factory\WidgetFactory;
use Ui\HTML\Elements\Empties\Br;
use Ui\Widgets\Views\NamedFieldset;
use Exception;
use ReflectionException;

/**
 *  FormFieldGenerator generate fields
 *  for a form , put value in field if needed ,
 *  place them in a NamedFieldset which legend
 *  is the display given for the shortclassname
 *  of the processed class
 *
 */
class FormFieldGenerator extends ViewFactory
{
    private $writables = [];
    private $inline = false;

    /**
     * @var NamedFieldset
     */
    private Nested $container;

    /**
     * FormFieldGenerator constructor.
     * @param $model
     * @throws Exception
     */
    function __construct($model)
    {   
        try {
            parent::__construct($model);
            
            //Setting columnsDefinitions
            $this->setFieldsDefinitions();
            $fieldSetTitle = $this->fieldsDefinitions->getDisplayFor($this->shortClassName);
            $this->container = (new NamedFieldset($fieldSetTitle))->setClass('m-3');
            
        } catch (ReflectionException $e) {
            throw $e;
        }
    }
// Rename this class in DefaultPartial
// Rename this method as getView
    public function setContainer(Nested $container)
    {
        $this->container = $container;
    }

    public function setInline()
    {
        $this->inline = true;
    }

    public function getPartialForm()
    {
        $fieldAdder = new FormFieldAdder($this->model, $this->container);
        $fieldAdder->setAccessFilter($this->accessFilter);
        if ($this->inline) {
            $fieldAdder->inline();
        }
        $writables = $this->getWritables();
        foreach ($this->fields as $k => $field) {
            $fieldName = $field->getName();
            if (in_array($fieldName, $writables)) {
                $fieldAdder->add($fieldName);
            }
        }
        return $this->container;
    }
}
