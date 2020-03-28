<?php
namespace Ui\Views;


use Entity\DefaultResolver;
use Entity\Metadata\Holder\ClassInformationHolder;
use Entity\Metadata\Holder\EntityInformationHolder;
use ReflectionException;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Section;
use Ui\Views\Generator\ManyToManyViewGenerator;
use Ui\Views\Generator\OneToManyViewGenerator;
use Ui\Views\Holder\TraitInformationHolder;
use Ui\Widgets\Accordeon\CollapsibleItem;
use Ui\Widgets\Accordeon\CollapsibleList;
use Ui\Widgets\Table\TableColumn;

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
    private string $path = "";
    private $fieldDefinitions;

    use TraitInformationHolder;
    /**
     * [__construct description]
     * @param [type] $entity       [description]
     * @param [type] $accessFilter [description]
     */

    public function __construct($entity, $accessFilter = "default")
    {

        $this->view = new EntityView();
        $this->getInformationHolder($entity);
        //Init class names
        $this->classname = $this->informationHolder->getClassName();
        $this->shortClassName = $this->informationHolder->getShortClassName();
        $this->setAccessFilter($accessFilter);
        $fieldDefinitions = DefaultResolver::getFieldDefinitions($this->classname);
        $this->fieldDefinitions = new $fieldDefinitions($this->classname);
    }

    /**
     * [getView description]
     * @return string [description]
     */
    public function getView(bool $subview = false)
    {
        if (isset($this->viewTitle)) {
            $title = $this->viewTitle;
        } else {
        }
        $this->view->setTitle($this->fieldDefinitions->getDisplayFor($this->shortClassName));
        $this->view->setClass("bg-light text-dark shadow-lg py-3 m-4");

        $factory = new EntityPartialViewFactory($this->entity, 'default', $subview);
        $factory->setCurrentPath($this->path);

        if ($this->iscollapsible) {
            $this->collapsiblelist = new CollapsibleList();
            $factory->setCollapsible();
            $this->collapsiblelist->addItem($factory->getPartialView($subview));
            $this->view->add($this->collapsiblelist);

        } else {
            $this->view->add(($factory->getPartialView($subview)));
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
