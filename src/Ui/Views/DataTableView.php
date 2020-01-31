<?php

namespace Ui\Views;


use Entity\DefaultResolver;
use Entity\Entity;
use Entity\EntityFactory;
use Entity\Metadata\Holder\ClassInformationHolder;
use Entity\Metadata\Holder\EntityInformationHolder;
use ReflectionException;
use Ui\HTML\Elements\Nested\A;
use Ui\HTML\Elements\Nested\Div;
use Ui\Views\Generator\CellValueGenerator;
use Ui\Views\Generator\ManyToManyViewGenerator;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;


class DataTableView
{

    private $title = "";
    private $legends = [];
    private $classname = "";
    private $data = [];
    private $fields = null;
    private $drt = null;
    private $accessFilter = null;
    private $viewables;
    private $whereparams = [];
    private $rowsclickable = false;
    private $baseurl = "";
    private $informationHolder = null;
    private array $columns;

    /**
     * @var EntityFactory
     */
    private $entity;

    /**
     * DataTableView constructor.
     * @param string $className the classname of the Entiy we want to retrieve values
     * @param $accessFilter
     * @param Entity $entity
     * @throws ReflectionException
     */
    public function __construct(string $className, $accessFilter, Entity $entity)
    {

        //Initialize Metadata Holder
        //Init InformationHolderInterface
        if (is_string($className)) {
            $this->informationHolder = new ClassInformationHolder($className);
        } else {
            $this->informationHolder = new EntityInformationHolder($className);
        }

        //Set this class name
        $this->classname = $className;

        //Initialize this AccessFilter
        $this->setAccessFilter($accessFilter);

        //Initialize fields to display
        $this->fields = $this->informationHolder->getFields();
        $this->viewables = $this->getViewables();

        //Initialize columns
        $this->columns = $this->generateColumns();
        //Initilize database access
        $this->entity = $entity;
        return $this;
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
        $result = $this->accessFilter->getViewables();
        return $result ?? [];
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

    // Todo pass a base URL to Get view and use Router to generate url foreach link
    public function getView()
    {
        //Todo Here we use Database access via the Entity class
        // make possible to Inject the class in relation with database it will implements
        // an interface with  findAll() findBy(array whereparams)

        //Retrieve data to display
        $dataToDisplay = $this->retrieveData();

        //Generate TableColumns
        $columns = $this->generateColumns();

        //Create the Table with Data

        $this->drt = new DivTable($this->legends, $columns, $dataToDisplay, $this->rowsclickable, $this->baseurl);

        //Init div container to return the table
        $view = new Div();
        $view->setClass("d-flex justify-content-center row-lg m-4");
        $view->add($this->drt);
        return $view->__toString();
    }

    //don't recursivly call
    private function retrieveData()
    {
        $dataToDisplay = [];
        if ($this->entity === null) {
            try {

            } catch (\Exception $exception) {
                print_r($exception->getMessage() . "\n");
            }
        }
        //Rettrieve data with filters
        if (count($this->whereparams) > 0) {
            $this->data = $this->entity->findBy($this->whereparams);
            // $dataToDisplay = $this->data;
        } else {
            //Rettrieve data without filters
            $this->data = $this->entity->findAll();
        }
        foreach ($this->data as $key => $object) {
            //If $value is an object
            if (\is_object($object)) {

                //Get Object Metadata
                $informationHolder = new EntityInformationHolder($object);

                //Get Fields
                $fields = $informationHolder->getFields();

                foreach ($fields as $field) {
                    //Field is not an association
                    if ($field && !$field->isAssociation()) {
                        $dataToDisplay[$key][$field->getName()] = $informationHolder->getEntityFieldValue($field->getName());
                    } else {
                        // if field is OneToOne or ManyToOne add value to
                        //$dataToDisplay with $key = fieldName
                        // if field is OneToMany or ManyToMany add a
                        //FieldButton to $dataToDisplay with fieldName
                        //Field is an association getting it"s type
                        $associationType = $field->getAssociationType();
                        $fieldName = $field->getName();
                        $className = $field->getAssociationClass();
                        $value = $informationHolder->getEntityFieldValue($field->getName());
                        if ($associationType == "ManyToOne" || $associationType == "OneToOne") {
                            //Display a clickable label with significative information
                            $cellValueGenerator = new CellValueGenerator($value, "default");
                            $dataToDisplay[$key][$field->getName()] = $cellValueGenerator->getValue();

                        }
                        //ManyToMany Association if "new" display a form if "edit" display a table
                        if ($associationType == "OneToMany" || $associationType == "ManyToMany") {
                            //Display a button witch target the page who display information for that relation
                            $view = (new ManyToManyViewGenerator($className))->getView($value, true);
                            $dataToDisplay[$key][$field->getName()] = (new A("/users/users/roles/31"))
                                ->add('<i class="material-icons md-36">group</i>' . $field->getName())->setClass('btn btn-primary');
                        }
                    }
                }
            } else {
                //If it is an array
                $dataToDisplay[$key] = $this->data[$key];
            }

        }


        return $dataToDisplay;
    }

    private function generateColumns()
    {
        $columns = [];
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

