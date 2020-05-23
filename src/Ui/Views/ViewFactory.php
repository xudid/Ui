<?php


namespace Ui\Views;


use Entity\DefaultResolver;
use Entity\Model\Model;
use Exception;
use ReflectionException;

class ViewFactory
{
    /**
     * @var string
     */
    protected ?ViewFilterInterface $accessFilter;
    protected $classNamespace;
    /**
     * @var Model
     */
    protected $model;
    protected string $shortClassName;
    protected array $fields;
    protected $fieldsDefinitions;

    /**
     * ViewFactory constructor.
     * @param Model|string $model
     */
    public function __construct($model)
    {
        if(!is_string($model) && ! $model instanceof Model) {
            throw new Exception('ViewFactory constructor take only a string or an instannce of Model class as parameter');
        }

        $this->model = $model;
        if (is_string($model)) {
            $model = new $model([]);
        }

        // Init class names
        $this->classNamespace = $model->getClass();
        $this->shortClassName = $model->getShortClass();

        // Model fields
        $this->fields = $model->getColumns();

        $this->setAccessFilter();
    }
    public function setAccessFilter($accessFilter = null)
    {
        if ($accessFilter == null) {
            $accessFilterName = DefaultResolver::getFilter($this->classNamespace);
            if (class_exists($accessFilterName)) {
                $this->accessFilter = new $accessFilterName();
            } else {
                throw new Exception('Undefined form filter class : ' . $accessFilterName);
            }

        } else {
            $this->accessFilter = $accessFilter;
        }
        return $this;
    }
    public function setFieldsDefinitions(ViewFieldsDefinitionInterface $fieldsDefinitionInterface = null) : self
    {
        if ($fieldsDefinitionInterface instanceof ViewFieldsDefinitionInterface) {
            $this->fieldsDefinitions = $fieldsDefinitionInterface;
        } else {
            $fieldsDefinitionsClass = DefaultResolver::getFieldDefinitions($this->classNamespace);
            try {
                $reflectionClass = new \ReflectionClass($fieldsDefinitionsClass);
                $this->fieldsDefinitions = $reflectionClass->newInstanceArgs([$this->classNamespace]);
            } catch (ReflectionException $exception) {
                throw $exception;
            }
        }
        return $this;
    }


    /**
     * @return array
     */
    protected function getViewables()
    {
        $result = $this->accessFilter->getViewables();
        return $result ?? [];
    }

    /**
     * @return array
     */
    protected function getWritables()
    {
        $result = array();
        if (isset($this->accessFilter)) {
            $result = $this->accessFilter->getWritables();
        }
        return $result;
    }

    protected function getSearchables()
    {
        $result = $this->accessFilter->getSearchables();
        return $result ?? [];
    }
}