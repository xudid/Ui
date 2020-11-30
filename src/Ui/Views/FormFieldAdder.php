<?php


namespace Ui\Views;


use Entity\Model\Model;
use Ui\HTML\Elements\Empties\Br;
use Ui\HTML\Elements\Nested\Nested;
use Ui\Widgets\Factory\WidgetFactory;

class FormFieldAdder extends ViewFactory
{
    /**
     * @var Nested
     */
    private Nested $container;
    private bool $inline = false;

    /**
     * FormFieldAdder constructor.
     * @param $model
     * @param Nested $container
     */
    public function __construct($model, Nested $container)
    {
        try {
            parent::__construct($model);
            $this->setFieldsDefinitions();
            $this->container = $container;
        } catch (\Exception $e) {
            dump($e);
        }

    }

    public function inline()
    {
        $this->inline = true;
        return $this;
    }

    public function notInline()
    {
        $this->inline = false;
        return $this;
    }

    public function add(string $fieldName, $values = null, string $display = '')
    {
        $inputType = $this->fieldsDefinitions->getInputTypeFor($fieldName);
        switch ($inputType) {

            case "email":
            {
                $this->addToContainer(
                    WidgetFactory::getEmailInput($fieldName),
                    $fieldName
                );

                break;
            }
            case "password":
            {
                $this->addToContainer(
                    WidgetFactory::getPasswordInput($fieldName),
                    $fieldName
                );
                break;
            }

            case "select":
            {
                // move this to model : fieldsDefinitions->getDataForListInput($fieldName);
                // need association ? need helper withAssociation( $association)?
                $options = $this->fieldsDefinitions->getDataForListInput($fieldName);
                $selOptionName = strtolower($this->shortClassName) . '_' . $fieldName;
                $selOption = WidgetFactory::getSelectOption($selOptionName, $options);
                if (is_object($this->model)) {
                    $val = $this->model->getPropertyValue($fieldName);
                    $index = array_keys($options, $val);
                    $selOption->setCheckedOption($index[0]);
                }
                $selOption->setClass('form-control');
                $this->container->add($selOption);
                if (!$this->inline) {
                    $this->container->add(new Br());
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
                $this->container->add($textarea);
                if (!$this->isInline()) {
                    $this->container->add(new Br());
                }
                break;
            }
            default:
            {
                $this->addToContainer(WidgetFactory::getTextInput($fieldName, $fieldName), $fieldName);
                break;
            }
        }

    }

    private function addToContainer($widget, $fieldName)
    {
        $widget->setClass('form-control');
        $this->container->add($widget);

        $placeholder = $this->fieldsDefinitions->getDisplayFor($fieldName);
        if (is_object($this->model)) {
            $val = $this->model->getPropertyValue($fieldName);
            $fieldName = strtolower($this->shortClassName) . '_' . $fieldName;
            $widget->setValue($val)
                ->setPlaceholder($placeholder)
                ->setName($fieldName);
        } else {

            $fieldName = strtolower($this->shortClassName) . '_' . $fieldName;
            $widget->setPlaceholder($placeholder)->setName($fieldName);

        }
        if (!$this->isInline()) {
            $this->container->add(new Br());
        }

    }

    private function isInline()
    {
        return $this->inline;
    }
}
