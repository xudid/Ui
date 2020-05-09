<?php
namespace Ui\Views;


use Entity\DefaultResolver;
use Entity\Metadata\Holder\EntityInformationHolder;
use Entity\Model\Model;
use Entity\Model\ModelManager;
use ReflectionException;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Section;
use Ui\Views\Holder\TraitInformationHolder;
use Ui\Widgets\Accordeon\CollapsibleItem;
use Ui\Widgets\Accordeon\CollapsibleList;
use Ui\Widgets\Table\ColumnsFactory;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;
use Ui\Widgets\Views\Modal;

/**
 * EntityViewFactory
 * Construct the view for an Entity with data from database
 */
class EntityViewFactory extends ViewFactory
{

    /**
     * [private description]
     * @var [type]
     */
    private $view = null;
    private array $associationViews = [];
    private $enableActionBar = false;
    private $actions = [];

    private CollapsibleList $collapsiblelist ;

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
     * @param ModelManager $manager
     * @param $id
     * @param string $accessFilter
     */

    public function __construct(ModelManager $manager, $id)
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
        return $this->model?:false;
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
            $this->view->setClass("bg-light text-dark shadow-lg py-3 m-4");
            $this->view->add(($factory->getPartialView($subview)));
        }
            $this->processAssociations();
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
    	$id=0;
        foreach ($associations as $key => $association) {
            $type = $association->getType();
            if ($type == "OneToMany" || $type == "ManyToMany") {
                $vfdClassName = DefaultResolver::getFieldDefinitions($association->getOutClassName());
                $viewFieldDefinitions = new $vfdClassName();
                $title =  $viewFieldDefinitions->getDisplayFor($association->getName());
                $columns = ColumnsFactory::make($association->getOutClassName());
                //($columns);
                $collection = $this->manager->findAssociationValuesBy($association->getOutClassName(),$this->model);
                //$dataToDisplay[$key][$association->getName()] = (new A($app->getRoute($association->getName(),index))
                //   ->add('<i class="material-icons md-36">group</i>' . $association->getName())->setClass('btn btn-primary');
                $drt = new DivTable(
                    [new TableLegend($title, TableLegend::TOP_LEFT)],
                    $columns,
                    $collection ,
                    false,
                    " "
                );
                $modal = new Modal($id, $drt);
                $modal->setHeaderText($association->getName());
                $modal->setTriggerText($association->getName());
                $section->add($modal);
                $drt = null;$id++;
            }

            if ($type == "ManyToOne" || $type == "OneToOne") {
                $view = new Section();
            }
        }
    }

    /**
     * Add the view to this collabsiblelist or to this entityview
     * @param mixed $view the view to add
     * @param string $display that we see in collapsible header
     * @return
     */
    public function addAssociationView($view, $display='')
    {
        if ($this->iscollapsible) {
            $item = new CollapsibleItem();
            $item->setHeader($display);
            $item->setContent($view);
            $this->collapsiblelist->addItem($item);
        } else {
            $container = (new Div)->setClass('view');
            $container->add($view);
            $this->associationViews[] = $container;

        }
    }
}
