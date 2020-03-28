<?php

namespace Ui\Views;


use Entity\DefaultResolver;
use Entity\Model\Model;
use Entity\Model\ModelManager;
use ReflectionException;
use Ui\HTML\Elements\Nested\Div;
use Ui\Views\Generator\CellValueGenerator;
use Ui\Widgets\Table\ColumnsFactory;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;
use Ui\Widgets\Views\Modal;


class DataTableView extends ViewFactory
{

    private $title = "";
    private $legends = [];
    private $classname = "";
    private $data = [];
    private $drt = null;
    private $viewables;
    private $whereparams = [];
    private $rowsclickable = false;
    private $baseurl = "";
    //private $informationHolder = null;
    private array $columns;

    /**
     * @var ModelManager
     */
    private ModelManager $manager;

    /**
     * DataTableView constructor.
     * @param string $className the classname of the Entiy we want to retrieve values
     * @param $accessFilter
     * @param ModelManager $manager
     * @throws ReflectionException
     */
    public function __construct( $model, ModelManager $manager)
    {
        parent::__construct($model);

        $this->viewables = $this->getViewables();

        //Initialize columns
        $this->columns = $this->generateColumns($this->classNamespace);
        //Initilize database access
        $this->manager = $manager;
        return $this;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function where($params)
    {
        $this->whereparams = array_merge($this->whereparams, $params);
        return $this;
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
    public function getView($app)
    {
        //Retrieve data
        $this->retrieveData();

        //Generate TableColumns
        $columns = ColumnsFactory::make($this->classNamespace);

        //Prepare Data to display
        $dataToDisplay = $this->processData();

        //Create the Table with Data

        $this->drt = new DivTable($this->legends, $columns, $dataToDisplay, $this->rowsclickable, $this->baseurl);
        //Init div container to return the table
        $view = new Div();
        $view->setClass("d-flex justify-content-center row-lg m-4");
        $view->add($this->drt);
        return $view->__toString();
    }

    private function retrieveData()
    {
        if(is_null($this->manager)) {
            throw new \Exception("Can't retrieve data without ModelManager in : " . __CLASS__);
        } else {
            //Rettrieve data with filters
            if (count($this->whereparams) > 0) {
                $this->data = $this->manager->findBy($this->whereparams);
            } else {
                //Rettrieve data without filters
                $this->data = $this->manager->findAll();
            }
        }

    }
    //don't recursivly call
     private function processData()
    {
        $dataToDisplay = [];

        // on parcours les données récupérées
        //pour chaque enregistrement on traite les columns et les association
        // on contruit ici les Rows d'une table avec les données de l'objet et les données
        //des associations on pourait imaginer une class RowFactory a qui on délégue la
        //construction de la Row et ajouter les rows au Table au fil de l'eau
        foreach ($this->data as $key => $object) {
            // make TableRow from Model
            if (\is_object($object) && $object instanceof Model) {
                //Get Object Metadata
                $columns = $object::getColumns();

                // process DataColumns
                foreach ($columns as $column) {
                    $value = $object->getPropertyValue($column->getName());
                    $dataToDisplay[$key][$column->getName()] = $value;
                }
                $this->processAssociations($object, $key, $dataToDisplay);
            } else {
                // make TableRow From Array
                $dataToDisplay[$key] = $this->data[$key];
            }
        }
        return $dataToDisplay;
    }

    private function processAssociations($object, $key, array &$dataToDisplay)
    {
        $associations = $object::getAssociations();
        foreach ($associations as $association) {
            if ($association->getType() == "OneToMany" || $association->getType() == "ManyToMany") {
                $view = $this->getManyAssociationView($object, $association, $key);
                $dataToDisplay[$key][$association->getName()] = $view;
            }

            if ($association->getType() == "ManyToOne" || $association->getType() == "OneToOne") {
                $view = $this->getOneAssociationView($object, $association);
                $dataToDisplay[$key][$association->getName()] = $view;
            }
        }
    }

    private function getManyAssociationView($object, $association, $key)
    {
        //$dataToDisplay[$key][$association->getName()] = (new A($app->getRoute($association->getName(),index))
        //   ->add('<i class="material-icons md-36">group</i>' . $association->getName())->setClass('btn btn-primary');
        $associationClassName = $association->getName();
        $outClassName = $association->getOutClassName();
        $collection = $this->manager->findAssociationValuesBy($outClassName, $object);
        $vfdClassName = DefaultResolver::getFieldDefinitions($outClassName);
        $viewFieldDefinitions = new $vfdClassName();
        $title =  $viewFieldDefinitions->getDisplayFor($associationClassName);
        $columns = ColumnsFactory::make($outClassName);
        $drt = new DivTable(
            [new TableLegend($title, TableLegend::TOP_LEFT)],
            $columns,
            $collection ,
            false,
            " "
        );
        // generate id with association name _$key  ? replace key by object Id
        $modal = new Modal(strtolower($associationClassName) . '_' . $key, $drt);
        $modal->setHeaderText($associationClassName);
        $modal->setTriggerText($associationClassName);
        return $modal;
    }

    public function getOneAssociationView($object, $association)
    {
        $associationClassName = $association->getName();
        $value = $object->getPropertyValue($associationClassName);
        $cellValueGenerator = new CellValueGenerator($value, "default");
        return $cellValueGenerator->getValue();
    }
    private function generateColumns(string $className)
    {
        $columns = [];
        $fieldsDefinitions = DefaultResolver::getFieldDefinitions($className);
        $fieldsDefinitions = new $fieldsDefinitions();
        $fieldFilter = DefaultResolver::getFilter($className);
        $fieldFilter = new $fieldFilter();
        foreach ($fieldFilter->getViewables() as $key => $value) {
            $display = $fieldsDefinitions->getDisplayFor($value);
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

    public function withBaseUrl(string $baseUrl)
    {
        $this->baseurl = $baseUrl;
        return $this;
    }
}

