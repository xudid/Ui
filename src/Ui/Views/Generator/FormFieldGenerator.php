<?php
namespace Ui\Views\Generator;



use Ui\HTML\Elements\Empties\Br;

use Ui\Model\DefaultFormFilterResolver;
use Ui\Model\DefaultResolver;
use Ui\Model\FieldDefinitionResolver;
use Ui\Views\Holder\ClassInformationHolder;
use Ui\Views\Holder\EntityInformationHolder;
use Ui\Views\Holder\InformationHolderInterface;
use Ui\Views\ViewFieldsDefinitionInterface;
use Ui\Views\ViewFilterInterface;
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
    private $shortClassName="";
    private $entity = null;
    private $accessFilter=null;
    private $ffds = null;
    private $writables =[];
    private $viewables =[];
    private $inline = false;
    private ?InformationHolderInterface $informationHolder=null;
    private array $fields = [];
    private ?WidgetFactory $factory = null;
    /**
     * @var WidgetFactory
     */
    private $widdgetFactory;
    /**
     * @var NamedFieldset
     */
    private NamedFieldset $namedFieldset;


	/**
	 * Initialise the FormFieldGenerator
	 * @param mixed $entity the name of the class or
	 * the object to process
	 *
	 * @param $accessFilter
	 * @param ViewFieldsDefinitionInterface|null $fieldsDefinitions
	 */
    function __construct($entity, $accessFilter, ViewFieldsDefinitionInterface $fieldsDefinitions = null)
    {

        $this->widdgetFactory = new WidgetFactory();
        try {
            //Init InformationHolderInterface
            if (is_string($entity)||is_null($entity)) {
               $this->informationHolder = new ClassInformationHolder($entity);
            } else {
                 $this->informationHolder = new EntityInformationHolder($entity);
            }

            //Init class names
            $this->classname = $this->informationHolder->getClassName();
            $this->shortClassName = $this->informationHolder->getShortClassName();
            $this->namedFieldset = new NamedFieldset("$this->shortClassName");

            //Retrieve fields
            $this->fields = $this->informationHolder->getFields();

            //Setting AccessFilter
            $this->setAccessFilter($accessFilter);

            //Setting FieldsDefinitions
            if ($fieldsDefinitions !== null) {
                $this->ffds = $fieldsDefinitions;

            } else {
                $ffdsClassName= DefaultResolver::getFieldDefinitions($this->classname);
                $this->ffds = new $ffdsClassName($this->classname);
            }

            //Init writables
            $this->writables = $this->getWritables();
        }catch (\ReflectionException $e) {
            print_r(__FILE__.__LINE__." ".$e->getMessage()."\n");
        }
    }

    /**
     * setAccessFilter init the FormFieldGenerator accessfilter
     * @param [type] $accessFilter can be null "default" or an AccessFilter
     * Interface implementation
     */
    private function setAccessFilter($accessFilter)
    {
        if($accessFilter == null)
        {
            $this->accessFilter = null;
        }
        if($accessFilter === "default")
        {
            $accessFilterName =  DefaultResolver::getFilter($this->classname);
            $this->accessFilter = new $accessFilterName();

        }
        else
        {
            $this->accessFilter = $accessFilter;

        }
    }

    private function getWritables()
    {
        $result = array();
        if(isset($this->accessFilter))
        {
            $result= $this->accessFilter->getWritables();
        }
        return $result;
    }

    public function getPartialForm()
    {

        foreach ($this->fields as $k =>$field)
        {
            $fieldName = $field->getName();

            if(in_array($fieldName,$this->writables)&&!$field->isAssociation())
            {

                switch ($this->ffds->getInputTypeFor($fieldName))
                {

                    case "email":
                    {
                        $input = $this->widdgetFactory->getEmailInput($fieldName);
                        $this->addInputToForm($input,$fieldName);

                        break;
                    }
                    case "password":
                    {
                        $input = $this->widdgetFactory->getPasswordInput($fieldName);
                        $this->addInputToForm($input,$fieldName);
                        break;
                    }

                    case "select":
                    {
                        $options = $this->ffds->getDataForListInput($fieldName);
                        $selOption = $this->widdgetFactory->getSelectOption($fieldName, $options);
                        if($this->informationHolder->hasEntity())
                        {
                            $val = $this->informationHolder->getEntityFieldValue($fieldName);
                            $index = array_keys($options,$val);
                            $selOption->setCheckedOption($index[0]);
                        }
                        $this->namedFieldset->add($selOption);
                        if(!$this->inline)
                        {
                            $this->namedFieldset->add(new Br());
                        }
                        break;
                    }

                    case "textarea":
                    {


                        if($this->informationHolder->hasEntity())
                        {
                            $val = $this->informationHolder->getEntityFieldValue($fieldName);
                            $textarea = $this->widdgetFactory->getTextarea($fieldName,$fieldName,$val);
                        } else {
                            $textarea = $this->widdgetFactory->getTextarea($fieldName,$fieldName);
                            $textarea->setPlaceholder($fieldName);
                        }
                        $this->namedFieldset->add($textarea);
                        if(!$this->inline)
                        {
                            $this->namedFieldset->add(new Br());
                        }
                        break;
                    }
                    default:
                    {
                        $input = $this->widdgetFactory->getTextInput($fieldName,$fieldName);
                        $this->addInputToForm($input,$fieldName);
                        break;
                    }

                }
            }
        }

        return $this->namedFieldset;
    }

    private function addInputToForm($widget,$fieldName)
    {

        $this->namedFieldset->add($widget);
        if($this->informationHolder->hasEntity())
        {
            $val = $this->informationHolder->getEntityFieldValue($fieldName);

            $widget->setValue($val);
        } else {
            $widget->setPlaceholder($fieldName);
        }
        if(!$this->inline)
        {
            $this->namedFieldset->add(new Br());
        }
    }




}




