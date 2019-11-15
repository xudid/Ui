<?php
namespace Ui\Views;


use Psr\Container\ContainerInterface;
use Ui\HTML\Elements\Nested\Div;
use Ui\Model\Association;
use Ui\Model\DefaultResolver;
use Ui\Views\Generator\ManyToManyViewGenerator;
use Ui\Views\Generator\ManyToOneViewGenerator;
use Ui\Views\Generator\OneToManyViewGenerator;
use Ui\Views\Generator\OneToOneViewGenerator;
use Ui\Views\Holder\ClassInformationHolder;
use Ui\Views\Holder\EntityInformationHolder;
use Ui\Widgets\Accordeon\CollapsibleItem;
use Ui\Widgets\Accordeon\CollapsibleList;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;

/**
 * EntityViewFactory
 * Construct the view for an Entity with data from database
 */
class EntityViewFactory
{

    /**
     * [private description]
     * @var [type]
     */
    private $view = null;

    private CollapsibleList $collapsiblelist ;
    /**
     * [private description]
     * @var [type]
     */
    private $entityView = null;

    /**
     * [private description]
     * @var [type]
     */
    private $classname = "";

    /**
     * [private description]
     * @var [type]
     */
    private $shortClassName = "";


    /**
     * [private description]
     * @var [type]
     */
    private $accessFilter = null;

    /**
     * [private description]
     * @var [type]
     */
    private $viewTitle = null;

    /**
     * [private description]
     * @var [type]
     */
    private $iscollapsible = false;
    /**
     * [private description]
     * @var [type]
     */
    private $viewables = null;

    /**
     * [private description]
     * @var [type]
     */
    private $informationHolder = null;

    /**
     * [private description]
     * @var [type]
     */
    private $path = "";

    /**
     * [__construct description]
     * @param [type] $entity       [description]
     * @param [type] $accessFilter [description]
     */

    public function __construct($entity, $accessFilter = "default", ContainerInterface $container = null)
    {
        $this->view = new EntityView($container);

        try {
            if (is_string($entity)) {
                $this->informationHolder = new ClassInformationHolder($entity);
            } else {
                $this->informationHolder = new EntityInformationHolder($entity);
                $this->entity = $entity;
            }
            //Init class names
            $this->classname = $this->informationHolder->getClassName();
            $this->shortClassName = $this->informationHolder->getShortClassName();
            $this->setAccessFilter($accessFilter);

        } catch (\ReflectionException $e) {
        }


    }

    /**
     * [getView description]
     * @return string [description]
     */
    public function getView()
    {
        $title = "";

        if (isset($this->viewTitle)) {
            $title = $this->viewTitle;
        } else {
            $title = $this->shortClassName;
        }

        $this->entityView = new EntityView();
        $this->view->setTitle($title);
        $this->view->setClass("view");

        $epvf = new EntityPartialViewFactory($this->entity, $this->accessFilter);
        $epvf->setCurrentPath($this->path);

        if ($this->iscollapsible) {
            $this->collapsiblelist = new CollapsibleList();
            $epvf->setCollapsible();
            $this->collapsiblelist->addItem($epvf->getPartialView());
            $this->view->add($this->collapsiblelist);

        } else {
            $this->view->add($epvf->getPartialView());
        }

        if ($this->informationHolder->hasAssociation()) {
            $associations = $this->informationHolder->getAssociations();
            $this->processAssociations($associations);

        }
        return $this->view;
    }


    /**
     * [setViewTitle description]
     * @param [type] $title [description]
     */
    public function setViewTitle($title)
    {
        if (isset($title)) {
            $this->viewTitle = $title;
        }
    }

    public function setCurrentPath($path)
    {
        $this->path = $path;
    }

    public function setCollapsible()
    {
        $this->iscollapsible = true;
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

    /**
     * [processAssociations description]
     * @param array $associations [description]
     */
    private function processAssociations(array $fields)
    {
        foreach ($fields as $key => $field) {
            $associationType = $field->getAssociationType();
            $className = $field->getType();
            if ($this->informationHolder->hasEntity()) {

                $value = $this->informationHolder->getEntityFieldValue($field->getName());
                $view = null;
                if ($value != null) {
                    //ManyToOne Association
                    if ($associationType == "ManyToOne") {
                        $view = (new ManyToOneViewGenerator($className))->getView($value);

                    }
                    if ($associationType == "ManyToMany") {
                       $view = (new ManyToManyViewGenerator($className))->getView($value);

                    }

                    if ($associationType == "OneToMany") {
                        $view = (new OneToManyViewGenerator($className))->getView($value);

                    }
                    if ($associationType == "OneToOne") {
                        $view = (new OneToOneViewGenerator($className))->getView($value);

                    }
                } else {

                }
                $this->view->add($view);
            }

        }

    }


    /**
     * [processManyTypeAssociations description]
     * @param Association $association [description]
     */
    private function processManyTypeAssociations(Association $association)
    {
        $classname = $association->getClassname();
        //we work on an object to generate the view
        if ($this->informationHolder->hasEntity()) {

            $epvf1 = null;
            $val = $this->informationHolder->getEntityFieldValue($association->getFieldname());
            //Association Many Has entity is not instance of \Doctrine\ORM\PersistentCollection
            if (!($val instanceof \Doctrine\ORM\PersistentCollection)) {
                $epvf1 = new EntityPartialViewFactory($val, "default");
                if ($epvf1 != null) {
                    if ($this->iscollapsible) {
                        $epvf1->setCollapsible();
                        $epvf1->setCurrentPath($this->path);
                        $view1 = $epvf1->getPartialView();
                        $this->collapsiblelist->addItem($view1);
                    } else {
                        $epvf1->setCurrentPath($this->path);
                        $view1 = $epvf1->getPartialView();
                        $this->view->add($view1);
                    }

                }

            } //Association Many Has entity is  instance of \Doctrine\ORM\PersistentCollection
            else {
                $collection = $val->getValues();
                $ei = new EntityInformationHolder($classname);
                $shortClassName = $ei->getShortClassName();

                $display = $this->informationHolder->getDisplayFor($shortClassName);
                $title = ($ei->getDisplayFor($shortClassName)) . "s";
                $columns = $this->generateTableColumns($ei);

                $drt = new DivTable([new TableLegend($title, TableLegend::TOP_LEFT)],
                    $columns,
                    $collection, false, " ");

                $this->addAssociationView($drt, $display);

            }
        }
        //else We don't work on an object
    }

    /**
     * [processOneTypeAssociations description]
     * @param Association $association [description]
     */
    private function processOneTypeAssociations(Association $association)
    {
        $classname = $association->getClassname();
        //print_r("<br>".__FILE__.__LINE__.$classname."<br>");
        $shortClassName = $association->getShortClassname();
        $eih1 = new EntityInformationHolder($classname);

        $getMethods = $eih1->getGetMethodNames();
        $columns = $this->generateTableColumns($eih1);
        //we work on an object to generate the view
        if ($this->informationHolder->hasEntity()) {
            $vals = $this->informationHolder->getEntityFieldValue(lcfirst($shortClassName));
            $data = [];
            //  print_r("<br>".__FILE__.__LINE__.get_class($vals)."<br>");
            if ($vals instanceof \Doctrine\ORM\PersistentCollection) {
                $class = "";
                foreach ($vals as $key => $v) {
                    $class = get_class($v);
                    $dpart = [];

                    foreach ($getMethods as $key => $method) {
                        $m = new \ReflectionMethod($v, $method);
                        $d = $m->invoke($v);
                        $fieldname = str_replace("get", "", $method);
                        $fieldname = lcfirst($fieldname);
                        if (is_object($d)) {
                            $dpart[$fieldname] = $d->__toString();
                        } else {
                            $dpart[$fieldname] = $d;
                        }

                    }
                    $data[] = $dpart;
                }
                $drt = new DivTable([new TableLegend($eih1->getDisplayFor($class), TableLegend::TOP_LEFT)], $columns, $data, false, "");
                $display = $eih1->getDisplayFor($eih1->getShortClassName());
                $this->addAssociationView($drt, $display);

            }

        }

    }

    /**
     * Add the view to this collabsiblelist or to this entityview
     * @param mixed $view the view to add
     * @param string $display that we see in collapsible header
     * @return
     */
    private function addAssociationView($view, $display)
    {
        if ($this->iscollapsible) {
            $item = new CollapsibleItem();
            $item->setHeader($display);
            $item->setContent($view);
            $this->collapsiblelist->addItem($item);
        } else {

            $div = new Div();
            $div->setClass("view");
            $div->add($view);
            $this->view->add($div);
        }
    }

    /**
     * [generateTableColumns description]
     * @param EntityInformationHolder $eih [description]
     *
     * @return array           [description]
     */
    private function generateTableColumns(EntityInformationHolder $eih): array
    {
        $columns = [];
        $accessFilter = $eih->getEntityAccessFilter();
        $viewables = $accessFilter->getViewablesFor($this->path);
        $methods = $eih->getGetMethodNames();
        foreach ($methods as $key => $method) {
            $colname = str_replace("get", "", $method);
            $colname = lcfirst($colname);
            if (in_array($colname, $viewables)) {
                $display = $eih->getDisplayFor($colname);
                $columns[] = new TableColumn($colname, $display);
            }
        }
        return $columns;
    }
}

?>
