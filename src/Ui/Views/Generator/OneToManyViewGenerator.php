<?php


namespace Ui\Views\Generator;

use Ui\Model\DefaultResolver;
use Ui\Views\EntityView;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;

/**
 * Class OneToManyViewGenerator
 * @package Ui\Views\Generator
 * @author Didier Moindreau <dmoindreau@gmail.com> on 02/11/2019.
 */
class OneToManyViewGenerator implements AssociationViewGenerator
{
    private $viewables;
    private $className;

    /**
     * OneToManyViewGenerator constructor.
     * @param $className
     */
    public function __construct($className)
    {
        $this->className = $className;
        $accessFilterName = DefaultResolver::getFilter($this->className);
        $this->accessFilter = new $accessFilterName();
        $this->viewables = $this->accessFilter->getViewables();
    }


    /**
     * Return an EntityView with a DivTable inside
     */
    public function getView($datas,bool $clickable = false,string $baseURL="")
    {
        $view = new EntityView();
        $fieldsDefinitionClassName = DefaultResolver::getFieldDefinitions($this->className);
        $fieldsDefinition = new $fieldsDefinitionClassName();
        $legendTitle = $fieldsDefinition->getDisplayFor($this->className);
        $columns = [];

        foreach ($this->viewables as $key => $value) {
            $display =  $fieldsDefinition->getDisplayFor($value);
            $column = new TableColumn($value, $display);
            $columns[] = $column;
        }
        $table = new DivTable([new TableLegend($legendTitle,TableLegend::TOP_RIGHT)],$columns,$datas);
        $view->add($table);
        return $view;
    }
}