<?php

namespace Ui\Views;


use Prophecy\Exception\Doubler\ClassNotFoundException;
use ReflectionClass;
use ReflectionException;
use Ui\HTML\Elements\Nested\Div;
use Ui\Model\Database\DaoInterface;
use Ui\Model\DefaultResolver;
use Ui\Model\Entity;
use Ui\Model\EntityFactory;
use Ui\Views\Generator\CellValueGenerator;
use Ui\Views\Generator\FormFieldGenerator;
use Ui\Views\Generator\ManyToManyViewGenerator;
use Ui\Views\Generator\OneToManyViewGenerator;
use Ui\Views\Holder\EntityInformationHolder;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;

class DataTableView
{

    private $title = "";
    private $legends = [];
    private $classname = "";
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
	 * @var EntityFactory
	 */
	private $entityFactory;

	/**
	 * DataTableView constructor.
	 * @param string $className the classname of the Entiy we want to retrieve values
	 * @param $accessFilter
	 * @param EntityFactory $entityFactory
	 * @throws ReflectionException
	 */
    public function __construct(string $className, $accessFilter, EntityFactory $entityFactory)
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
        //Initilize database access
		$this->entityFactory = $entityFactory;
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
        return $result??[];
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
        if ($this->Entity ===null) {
            try{

            } catch (\Exception $exception){
                print_r($exception->getMessage()."\n");
            }
            $this->initWithDefaultEntity();
        }
        //Rettrieve data with filters
        if (count($this->whereparams) > 0) {
            $this->data = $this->Entity->findBy($this->whereparams);
            $dataToDisplay = $this->data;
        }
        else {
			//Rettrieve data without filters
            $this->data = $this->Entity->findAll();
            foreach ($this->data as $key => $object) {
                //If $value is an object
                if (\is_object($object)) {

                    //Get Object Metadata
                    $eih1 = new EntityInformationHolder($object);

                    //Get Fields
					$fields = $eih1->getFields();

					foreach ($fields as $field) {
							//Field is not an association
						if ($field && !$field->isAssociation()) {
							$dataToDisplay[$key][$field->getName()] = $eih1->getEntityFieldValue($field->getName());
						} else {
							//Field is an association getting it"s type
							$associationType = $field->getAssociationType();
							$className = $field->getType();
							$value = $eih1->getEntityFieldValue($field->getName());
							if ($value != null) {
								//ManyToOne Association display a form
								if ($associationType == "ManyToOne") {
									//Display a clickable label with significative information
									$cellValueGenerator = new CellValueGenerator($value, "default");
									$dataToDisplay[$key][$field->getName()] = $cellValueGenerator->getValue();

								}
								//ManyToMany Association if "new" display a form if "edit" display a table
								if ($associationType == "ManyToMany") {
									//Display a button witch target the page who display information for that relation
									//$view = (new ManyToManyViewGenerator($className))->getView($value,true);

								}
								//OneToMany Association if "new" display a form if "edit" display a table
								if ($associationType == "OneToMany") {
									//Display a button witch target the page who display information for that relation
									//$view = (new OneToManyViewGenerator($className))->getView($value,true);

								}
								//OneToOne Association display a form
								if ($associationType == "OneToOne") {
									//Display a clickable label with significative information
									$cellValueGenerator = new CellValueGenerator($className);
									$dataToDisplay[$key][$field->getName()] = $cellValueGenerator->getView($value, true  );
								}
							} else {

							}
						}
					}
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
     * @throws ReflectionException
     */
    private function initWithDefaultEntity()
    {
    	$this->Entity = $this->entityFactory->getEntity($this->classname);

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

