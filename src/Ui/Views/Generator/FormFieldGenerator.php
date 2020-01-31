<?php

namespace Ui\Views\Generator;

use Entity\DefaultResolver;
use Entity\Metadata\Holder\InformationHolderInterface;
use http\Exception\InvalidArgumentException;
use ReflectionException;
use Ui\HTML\Elements\ElementInterface;
use Ui\HTML\Elements\Empties\Br;
use Ui\Views\Holder\TraitInformationHolder;
use Ui\Views\ViewFieldsDefinitionInterface;
use Ui\Widgets\Factory\WidgetFactory;
use Ui\Widgets\Views\NamedFieldset;

/**
 *  FormFieldGenerator generate fields
 *  for a form , put value in field if needed ,
 *  place them in a NamedFieldset which legend
 *  is the display given for the shortclassname
 *  of the processed class
 *
 */
class FormFieldGenerator
{
    private $classname = "";
    private $shortClassName = "";
    private $entity = null;
    private $accessFilter = null;
    private $fieldsDefinitions = null;
    private $writables = [];
    private $viewables = [];
    private $inline = false;
    private ?InformationHolderInterface $informationHolder = null;
    private array $fields = [];

    /**
     * @var NamedFieldset
     */
    private NamedFieldset $namedFieldset;
    use TraitInformationHolder;

    /**
     * Initialise the FormFieldGenerator
     *
     * @param mixed $entity the name of the class or
     * the object to process
     * @param $accessFilter
     * @param ViewFieldsDefinitionInterface|null $fieldsDefinitions
     */
    function __construct($entity, $accessFilter, ViewFieldsDefinitionInterface $fieldsDefinitions = null)
    {
        try {
            if (is_null($entity)) {
                throw new InvalidArgumentException("FormFieldGenerator entity parameter must be an existing class name or an object");
            }

            $this->getInformationHolder($entity);
            //Init class names
            $this->classname = $this->informationHolder->getClassName();
            $this->shortClassName = $this->informationHolder->getShortClassName();

            //Retrieve fields
            $this->fields = $this->informationHolder->getFields();

            //Setting AccessFilter
            $this->setAccessFilter($accessFilter);

            //Setting FieldsDefinitions
            if ($fieldsDefinitions !== null) {
                $this->fieldsDefinitions = $fieldsDefinitions;

            } else {
                $ffdsClassName = DefaultResolver::getFieldDefinitions($this->classname);
                $this->fieldsDefinitions = new $ffdsClassName($this->classname);
            }
            $fieldSetTitle = $this->fieldsDefinitions->getDisplayFor($this->shortClassName);
            $this->namedFieldset = (new NamedFieldset($fieldSetTitle))->setClass('m-3');

            //Init writables
            $this->writables = $this->getWritables();
        } catch (ReflectionException $e) {
            print_r(__FILE__ . __LINE__ . " " . $e->getMessage() . "\n");
        }
    }

    /**
     * setAccessFilter init the FormFieldGenerator accessfilter
     *
     * @param [type] $accessFilter can be null "default" or an AccessFilter
     * Interface implementation
     */
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

    private function getWritables()
    {
        $result = array();
        if (isset($this->accessFilter)) {
            $result = $this->accessFilter->getWritables();
        }
        return $result;
    }

    public function getPartialForm()
    {
        foreach ($this->fields as $k => $field) {
            $fieldName = $field->getName();
            if (in_array($fieldName, $this->writables) && !$field->isAssociation()) {
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
                        if ($this->informationHolder->hasEntity()) {
                            $val = $this->informationHolder->getEntityFieldValue($fieldName);
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

                        if ($this->informationHolder->hasEntity()) {
                            $val = $this->informationHolder->getEntityFieldValue($fieldName);
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
        if ($this->informationHolder->hasEntity()) {
            $val = $this->informationHolder->getEntityFieldValue($fieldName);
            $widget->setValue($val)
                ->setPlaceholder($fieldName);
            //var_dump($widget->__toString());
        } else {
            $widget->setPlaceholder($fieldName);
        }
        if (!$this->inline) {
            $this->namedFieldset->add(new Br());
        }
    }
}
