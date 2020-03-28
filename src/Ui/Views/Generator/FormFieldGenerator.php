<?php

namespace Ui\Views\Generator;

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
    private NamedFieldset $namedFieldset;

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
            $this->namedFieldset = (new NamedFieldset($fieldSetTitle))->setClass('m-3');

            //Init writables
            $this->writables = $this->getWritables();
        } catch (ReflectionException $e) {
            throw $e;
        }
    }
// Rename this class in DefaultPartial
// Rename this method as getView

    public function getPartialForm()
    {
        foreach ($this->fields as $k => $field) {
            $fieldName = $field->getName();
            if (in_array($fieldName, $this->writables)) {
                switch ($this->fieldsDefinitions->getInputTypeFor($fieldName)) {

                    case "email":
                    {
                        $this->addInputToForm(
                            WidgetFactory::getEmailInput($fieldName),
                            $fieldName
                        );

                        break;
                    }
                    case "password":
                    {
                        $this->addInputToForm(
                            WidgetFactory::getPasswordInput($fieldName),
                            $fieldName
                        );
                        break;
                    }

                    case "select":
                    {
                        $options = $this->fieldsDefinitions->getDataForListInput($fieldName);
                        $selOption = WidgetFactory::getSelectOption($fieldName, $options);
                        if (is_object($this->$this->model)) {
                            $val = $this->$this->model->getPropertyValue($fieldName);
                            $index = array_keys($options, $val);
                            $selOption->setCheckedOption($index[0]);
                        }
                        $this->namedFieldset->add($selOption);
                        if (!$this->inline) {
                            $this->namedFieldset->add(new Br());
                        }
                        break;
                    }

                    case "textarea":
                    {

                        if (is_object($this->$this->model)) {
                            $val = $this->$this->model->getPropertyValue($fieldName);
                            $textarea = WidgetFactory::getTextarea($fieldName, $fieldName, $val);
                        } else {
                            $textarea = WidgetFactory::getTextarea($fieldName, $fieldName);
                            $textarea->setPlaceholder($fieldName);
                        }
                        $this->namedFieldset->add($textarea);
                        if (!$this->inline) {
                            $this->namedFieldset->add(new Br());
                        }
                        break;
                    }
                    default:
                    {
                        $this->addInputToForm(WidgetFactory::getTextInput($fieldName, $fieldName), $fieldName);
                        break;
                    }
                }
            }
        }

        return $this->namedFieldset;
    }

    /**
     * @param ElementInterface $widget
     * @param string $fieldName
     */
    private function addInputToForm($widget, $fieldName)
    {
        $widget->setClass('form-control');
        $this->namedFieldset->add($widget);
        $placeholder = $fieldName;

        if (is_object($this->model)) {
            $val = $this->model->getPropertyValue($fieldName);
            $fieldName = strtolower($this->shortClassName)  . '_' . $fieldName;
            $widget->setValue($val)
                ->setPlaceholder($placeholder)
                ->setName($fieldName);
        } else {
            $fieldName = strtolower($this->shortClassName)  . '_' . $fieldName;
            $widget->setPlaceholder($placeholder)->setName($fieldName);
        }
        if (!$this->inline) {
            $this->namedFieldset->add(new Br());
        }
    }
}
