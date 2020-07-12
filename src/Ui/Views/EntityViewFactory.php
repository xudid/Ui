<?php

namespace Ui\Views;


use Entity\DefaultResolver;
use Entity\Model\ManagerInterface;
use Router\Router;
use Ui\HTML\Elements\Bases\Span;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Section;
use Ui\HTML\Elements\Nested\A;
use Ui\Widgets\Accordeon\CollapsibleItem;
use Ui\Widgets\Accordeon\CollapsibleList;
use Ui\Widgets\Icons\MaterialIcon;
use Ui\Widgets\Table\ColumnsFactory;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableLegend;
use Ui\Widgets\Views\FieldButton;
use Ui\Widgets\Views\Modal;
use Ui\Widgets\Views\Title;

/**
 * EntityViewFactory
 * Construct the view for an Entity with data from database
 */
class EntityViewFactory extends ViewFactory
{
    private $view = null;
    private array $associationViews = [];
    private $enableActionBar = false;
    private $actions = [];
    private ?Router $router = null;
    private ?ManagerInterface $manager = null;
    private bool $basic = false;
    private CollapsibleList $collapsiblelist;

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
    private string $path = "";
    private $id;


    /**
     * EntityViewFactory constructor.
     * @param ManagerInterface $manager
     * @param $id
     * @param string $accessFilter
     */

    public function __construct(ManagerInterface $manager, $id)
    {
        $this->view = new EntityView();
        $this->manager = $manager;
        $this->id = $id;
        if ($this->retrieveData()) {
            parent::__construct($this->model);
            $this->setFieldsDefinitions();
        }
    }

    private function retrieveData()
    {
        $this->model = $this->manager->findById($this->id);
        return $this->model ?: false;
    }

    /**
     * [getView description]
     * @return string [description]
     */
    public function getView(bool $subview = false)
    {
        if ($this->enableActionBar) {
            $this->view->withActions($this->actions);
        }
        if (!$this->model) {
            return 'information not found';
        }

        $factory = new EntityPartialViewFactory($this->model, $subview);
        $factory->setCurrentPath($this->path);
        if ($this->iscollapsible) {
            $this->view = new CollapsibleList();
            $factory->setCollapsible();
            $this->view->addItem($factory->getPartialView($subview));
        } else {
            $this->view->setTitle($this->fieldsDefinitions->getDisplayFor($this->shortClassName));

            $this->view->setClass("bg-light text-dark shadow-lg py-3");
            $this->view->add(($factory->getPartialView($subview)));
        }
        if(!$this->basic) {
            $this->processAssociations();
        }

        foreach ($this->associationViews as $associationView) {
            $this->view->add($associationView);

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

    public function setRouter(Router $router)
    {
        $this->router = $router;
    }

    public function setCurrentPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function setCollapsible()
    {
        $this->iscollapsible = true;
        return $this;
    }


    public function useAction(string $actionType, string $url)
    {
        $this->enableActionBar = true;
        $this->actions[$actionType] = $url;
        return $this;
    }

    /**
     * [processAssociations description]
     * @param array $associations [description]
     */
    private function processAssociations()
    {
        $associations = $this->model::getAssociations();
        $section = (new Section())->setClass('row d-flex justify-content-center m-3');
        $this->view->add($section);
        $id = 0;
        foreach ($associations as $key => $association) {
            $type = $association->getType();
            if ($type == "OneToMany" || $type == "ManyToMany") {
                $viewFieldDefinitions = DefaultResolver::getFieldDefinitions($association->getOutClassName());
                $title = $viewFieldDefinitions->getDisplayFor($association->getName());
                $columns = ColumnsFactory::make($association->getOutClassName());
                $collection = $this->manager->findAssociationValuesBy($association->getOutClassName(), $this->model);
                $routeName = $this->model::getTableName() . '_' . $association->getName();
                try {
                    $url = $this->router->generateUrl($routeName,['id'=> $this->model->getId()]);
                } catch (\Exception $exception) {
                    dump($exception);
                }

                if ($collection) {
                    //$dataTableView = new DataTableView($association->getOutClassName(),$this->manager);
                    //$view = $dataTableView->getView($this->app);
                    $icon = new MaterialIcon('add');
                    $icon->color('white')->size('xs');
                    $span = new Span($association->getName());
                    $span->setAttribute('style', 'vertical-align:bottom;');
                    $legendA = (new A($icon . ' ' . $span, $url))->setClass('btn btn-xs btn-success mb-1');
                    $view = new DivTable(
                    [new TableLegend($legendA)],
                    $columns,
                    $collection,
                    false,
                    " "
                );
                } else {

                   $view = new FieldButton($association->getName(), $url);
                }


                $section->add($view);

                // $a = new A($url);
                //$dataToDisplay[$key][$association->getName()] = (
                // $a->add('<i class="material-icons md-36">group</i>' . $association->getName())
                //  ->setClass('btn btn-primary');
                /*$collapsible = new CollapsibleList();
                $collapsible->setClass('m-3');
                $item = new CollapsibleItem();
                $item->setHeader((new Title(5, ucfirst($title)))->setClass('text-white text-center'));
                $item->setContent($drt);
                $collapsible->addItem($item);
                $this->view->add($collapsible);*/
                /*$modal = new Modal($id, $drt);
                $modal->setHeaderText($association->getName());
                $modal->setTriggerText($association->getName());
                $section->add($modal);*/
                $drt = null;
                $id++;
            }

            if ($type == "ManyToOne" || $type == "OneToOne") {
                $value = $this->manager->findAssociationValuesBy($association->getOutClassName(), $this->model);
                $partialViewFactory = new EntityPartialViewFactory($value);
                $view = $partialViewFactory->getPartialView();
                $this->view->add($view);
            }
        }
    }

    /**
     * Add the view to this collabsiblelist or to this entityview
     * @param mixed $view the view to add
     * @param string $display that we see in collapsible header
     * @return
     */
    public function addAssociationView($view, $display = '')
    {
        if ($this->iscollapsible) {
            $item = new CollapsibleItem();
            $item->setHeader($display);
            $item->setContent($view);
            $this->collapsiblelist->addItem($item);
        } else {
            $container = (new Div)->setClass('m-2');
            $container->add($view);
            $this->associationViews[] = $container;

        }
    }

    public function basic()
    {
        $this->basic = true;
    }
}
