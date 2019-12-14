<?php


namespace Ui\Views\Generator;

use Ui\HTML\Elements\Bases\Span;
use Ui\HTML\Elements\Nested\A;
use Ui\HTML\Elements\Nested\Div;
use Ui\Model\DefaultResolver;
use Ui\Views\EntityView;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;
use Ui\Widgets\Views\FieldButton;

/**
 * Class ManyToManyViewGenerator
 * @package Ui\Views\Generator
 * @author Didier Moindreau <dmoindreau@gmail.com> on 02/11/2019.
 */
class ManyToManyViewGenerator implements AssociationViewGenerator
{
    private $viewables;
    private $className;

    /**
     * ManyToManyViewGenerator constructor.
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
    	$fieldsDefinitionClassName = DefaultResolver::getFieldDefinitions($this->className);
		$fieldsDefinition = new $fieldsDefinitionClassName();
		$fieldTitle = $fieldsDefinition->getDisplayFor($this->className);
        return new FieldButton($fieldTitle, $baseURL);
    }
}