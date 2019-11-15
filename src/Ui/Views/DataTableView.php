<?php

namespace Ui\Views;


use Prophecy\Exception\Doubler\ClassNotFoundException;
use ReflectionClass;
use ReflectionException;
use Ui\HTML\Elements\Nested\Div;
use Ui\Model\DefaultResolver;
use Ui\Model\Entity;
use Ui\Views\Holder\EntityInformationHolder;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;

class DataTableView
{

    private $title = "";
    private $legends = [];
    private $classname = "";
    private $entityClassname = "";
    private $Entity = null;
    private $data = [];
    private $fields = null;
    private $drt = null;
    private $accessFilter = null;
    private $viewables;
    private $whereparams = [];
    private $rowsclickable = false;
    private $baseurl = "";
    private $eih = null;
    private array $columns;

    /**
     * DataTableView constructor.
     * @param null $container
     * @param string $className the classname of the Entiy we want to retrieve values
     * @param $accessFilter
     * @throws \ReflectionException
     */
    public function __construct($container = null, string $className, $accessFilter)
    {

        //Initialize Metadata Holder
        $this->eih = new EntityInformationHolder($className);

        //Set this class name
        $this->classname = $className;

        //Initialize this AccessFilter
        $this->setAccessFilter($accessFilter);

        //Initialize fields to display
        $this->fields = $this->eih->getFields();
        $this->viewables = $this->getViewables();

        //Initialize columns
        $this->columns = $this->generateColumns();
    }

    public function setEntity(Entity $entity)
    {
        $this->Entity = $entity;
    }

    public function where($params)
    {
        $this->whereparams = array_merge($this->whereparams, $params);
        return $this;
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


    private function getViewables()
    {
        $result = array();
        $result = $this->accessFilter->getViewables();
        return $result;

    }

    public function __toString()
    {
            $this->drt = new DivTable($this->legends,
            $this->columns,
            $this->data,
            $this->rowsclickable,
            $this->baseurl);
        return $this->drt->__toString();
    }

    public function getView()
    {
        //Todo Here we use Database access via the Entity class
        // make possible to Inject the class in relation with database it will implements
        // an interface with  findAll() findBy(array whereparams)

        //Retrieve data to display
        $dataToDisplay =  $this->retrieveData();

        //Generate TableColumns
        $columns = $this->generateColumns();

        //Create the Table with Data

        $this->drt = new DivTable($this->legends, $columns, $dataToDisplay, $this->rowsclickable, $this->baseurl);

        //Init container to return the table
        $view = new Div();
        $view->setClass("form");
        $view->add($this->drt);
        return $view->__toString();
    }

    //don't recursivly call
    private function retrieveData()
    {
        $dataToDisplay = [];
        if ($this->Entity ===null) {
            try{

            } catch (\Exception $exception){
                print_r($exception->getMessage()."\n");
            }
            $this->initWithDefaultEntity(null);
        }
        //Rettrieve data with filters
        if (count($this->whereparams) > 0) {
            $this->data = $this->Entity->findBy($this->whereparams);
            $dataToDisplay = $this->data;
        } //Rettrieve data without filters
        else {
            $this->data = $this->Entity->findAll();
            foreach ($this->data as $key => $object) {
                //If $value is an object
                if (\is_object($object)) {

                    //Get Object Metadata
                    $eih1 = new EntityInformationHolder($object);

                    //Get object Getters
                    $getMethods = $eih1->getGettersName();

                    //Foreach getter  get object value
                    /*foreach ($getMethods as $key1 => $methodName) {
                        $method = new \ReflectionMethod($object, $methodName);
                        $val = $method->invoke($object);

                        //If $val is not a \Doctrine\ORM\PersistentCollection
                        if (!($val instanceof \Doctrine\ORM\PersistentCollection)) {
                            $method = new \ReflectionMethod($object, $methodName);
                            $val = $val = $method->invoke($object);
                            $setmethod = str_replace("get", "set", $methodName);
                            $method = new \ReflectionMethod($object, $setmethod);
                            $v = $method->invokeArgs($object, [$val]);
                            //If Doctrine Collection get values
                        } else {
                            $collection = $val->getValues();
                            if (count($collection) == 0) {
                                $collection[] = " ";
                            }
                            $setmethod = str_replace("get", "set", $methodName);
                            $method = new \ReflectionMethod($object, $setmethod);
                            $v = $method->invokeArgs($object, [$collection]);
                        }

                    }*/
                    //$dataToDisplay[$key] = $object;
                    $dataToDisplay = $this->data;
                } else {
                    //If it is an array
                    $dataToDisplay[$key] = $this->data[$key];
                }

            }

        }
        return $dataToDisplay;
    }

    private function generateColumns()
    {
        $columns = [];
        //Todo use FieldDefinitionResolverInterface
        $formfilterClassName = DefaultResolver::getFieldDefinitions($this->classname);
        $formfilter = new $formfilterClassName();
        foreach ($this->viewables as $key => $value) {
            $colname = $value;
            $display = $formfilter->getDisplayFor($value);
            $column = new TableColumn($value, $display);
            $columns[] = $column;
        }
        return $columns;
    }

    /**
     * @param $container
     * @throws ReflectionException
     */
    private function initWithDefaultEntity($container)
    {
        //Resolve entity classname to access to Database
        $this->entityClassname = DefaultResolver::getEntityClassName($this->classname);
        try {
            $r = new ReflectionClass($this->entityClassname);
            $this->Entity = $r->newInstanceArgs([$container]);
        } catch (ReflectionException $e) {
            throw new ClassNotFoundException($e->getMessage(),$this->entityClassname);
        }

    }

    public function setTitle($title)
    {
        if (isset($title)) {
            $this->title = $title;
            $this->legends[] = new TableLegend($this->title, TableLegend::TOP_LEFT);
        }

    }

    public function addALegend(TableLegend $legend)
    {
        $this->legends[] = $legend;
    }

    /**
     * Make rows clickable , but object that the row represents must
     * have a gettable Id to allow this
     * @param $baseurl
     * @return $this
     */
    public function withClickableRows($baseurl)
    {
        $this->rowsclickable = true;
        $this->baseurl = $baseurl;
        return $this;
    }
}

