<?php

namespace Ui\Views;


use Entity\DefaultResolver;
use Entity\Model\ManagerInterface;
use Entity\Model\Model;
use Entity\Model\ModelManager;
use ReflectionException;
use Ui\HTML\Elements\Bases\Span;
use Ui\HTML\Elements\Nested\A;
use Ui\HTML\Elements\Nested\Div;
use Ui\Views\Generator\CellValueGenerator;
use Ui\Widgets\Icons\MaterialIcon;
use Ui\Widgets\Table\ColumnsFactory;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;
use Ui\Widgets\Views\Modal;
use Router\Router;


class DataTableView extends ViewFactory
{

    private $title = "";
    private $legends = [];
    private $data = [];
    private $drt = null;
    private $viewables;
    private $whereparams = [];
    private $rowsclickable = false;
    private $baseurl = "";
    private ?Router $router = null;
    private array $columns;

    /**
     * @var ModelManager
     */
    private ManagerInterface $manager;

    /**
     * DataTableView constructor.
     * @param string $className the classname of the Entiy we want to retrieve values
     * @param $accessFilter
     * @param ModelManager $manager
     * @throws ReflectionException
     */
    public function __construct($model, ManagerInterface $manager)
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
        $view = new Div();

        //Retrieve data
        $this->retrieveData();
        //Prepare Data to display
        $rows = $this->processData();
        if (!$rows) {
            $view->add('No data found');
        }
        //Generate TableColumns
        $columns = ColumnsFactory::make($this->classNamespace);
        if ($columns) {
            //Create the Table with Data
            $this->drt = new DivTable($this->legends, $columns, $rows, $this->rowsclickable, $this->baseurl);
            //Init div container to return the table
            $view->setClass("d-flex ");
            $view->add($this->drt);
            return $view->__toString();
        } else {
            throw new \Exception('Failed to generate table');
        }
    }

    private function retrieveData()
    {
        if (is_null($this->manager)) {
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
        $row = [];
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
                    $row[$key][$column->getName()] = $value;
                }
                $this->processAssociations($object, $key, $row);
            } else {
                // make TableRow From Array
                $row[$key] = $this->data[$key];
            }
        }
        return $row;
    }

    private function processAssociations(Model $object, $key, array &$row)
    {
        $associations = $object::getAssociations();
        foreach ($associations as $association) {
            if ($association->getType() == "OneToMany" || $association->getType() == "ManyToMany") {
                $view = $this->getManyAssociationView($object, $association, $key);
            }

            if ($association->getType() == "ManyToOne" || $association->getType() == "OneToOne") {
                $view = $this->getOneAssociationView($object, $association);
            }
            if ($view) {
                $row[$key][$association->getName()] = $view;
            }
        }
    }
    
    private function associationGetter($outClassName)
    {
        $associationModel = Model::model($outClassName);
        return 'get' . ucfirst($associationModel::getTableName());
    }

    private function getManyAssociationView($object, $association, $key)
    {
        //$row[$key][$association->getName()] = (new A($app->getRoute($association->getName(),index))
        //   ->add('<i class="material-icons md-36">group</i>' . $association->getName())->setClass('btn btn-primary');
        $outClassName = $association->getOutClassName();
        
        $getter = $this->associationGetter($outClassName);
        $collection = $object->$getter();
        $viewFieldDefinitions = DefaultResolver::getFieldDefinitions($outClassName);
        $associationClassName = $association->getName();
        $title = $viewFieldDefinitions->getDisplayFor($associationClassName);
        $columns = ColumnsFactory::make($outClassName);
        $view = null;
        if ($columns) {
            if ($collection) {
                $drt = new DivTable(
                    [new TableLegend($title, TableLegend::TOP_LEFT)],
                    $columns,
                    $collection,
                    false,
                    " "
                );
                // generate id with association name _$key  ? replace key by object Id
                $modal = new Modal(strtolower($associationClassName) . '_' . $key, $drt);
                $modal->setHeaderText($associationClassName);
                $modal->setTriggerText($associationClassName);
                $view = $modal;

            } else {
                $routeName = $this->model::getTableName() . '_' . $association->getName() . '_new';
                $url = $this->router->generateUrl($routeName, ['id' => $object->getId()],);
                $icon = new MaterialIcon('add');
                $icon->color('white')->size('xs');
                $span = new Span($association->getName());
                $span->setAttribute('style', 'vertical-align:bottom;');
                $view = (new A($icon . ' ' . $span, $url))->setClass('btn btn-xs btn-primary');
            }
        }
        return $view;
    }

    public function getOneAssociationView($object, $association)
    {
        $associationClassName = $association->getOutClassName();
        dump($object, $association);
        $outClassName = $association->getOutClassName();
        $getter = $this->associationGetter($outClassName);
        $value = $object->$getter();
        dump($value, $object);
        if ($value) {
            $cellValueGenerator = new CellValueGenerator($value, "default");
            return $cellValueGenerator->getValue();
        }

        return false;
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

    public function setRouter(Router $router)
    {
        $this->router = $router;
        return $this;
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
