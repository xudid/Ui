<?php
namespace Ui\Views;


use Psr\Container\ContainerInterface;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Section;
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

    public function __construct($entity, $accessFilter = "default",$router = null)
    {
        $this->view = new EntityView();

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
    public function getView(bool $subview = false)
    {
        $title = "";

        if (isset($this->viewTitle)) {
            $title = $this->viewTitle;
        } else {
            $title = $this->shortClassName;
        }
        $this->entityView = new EntityView($subview);
        $this->view->setTitle($title);
        $this->view->setClass("bg-light text-dark shadow-lg py-3 m-4");

        $epvf = new EntityPartialViewFactory($this->entity, $this->accessFilter, $subview);
        $epvf->setCurrentPath($this->path);

        if ($this->iscollapsible) {
            $this->collapsiblelist = new CollapsibleList();
            $epvf->setCollapsible();
            $this->collapsiblelist->addItem($epvf->getPartialView());
            $this->view->add($this->collapsiblelist);

        } else {
            $this->view->add(($epvf->getPartialView($subview)));
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
    	$section = (new Section())->setClass('row d-flex justify-content-center m-3');
    	$this->view->add($section);
        foreach ($fields as $key => $field) {
            $associationType = $field->getAssociationType();
            $className = $field->getType();
            if ($this->informationHolder->hasEntity()) {

                $value = $this->informationHolder->getEntityFieldValue($field->getName());
                $view = null;
                if ($value != null) {
                    //ManyToOne Association
                    if ($associationType == "ManyToOne") {
						$view = (new EntityViewFactory($value))->getView(true);

                    }
                    if ($associationType == "ManyToMany") {
                       $view = (new ManyToManyViewGenerator($className))->getView($value);

                    }

                    if ($associationType == "OneToMany") {
                        $view = (new OneToManyViewGenerator($className))->getView($value);

                    }
                    if ($associationType == "OneToOne") {
						$view = (new ManyToManyViewGenerator($className))->getView($value);
						//$view->setTitle( $field->getShortType());

                    }
                } else {

                }
               $section->add($view);
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

