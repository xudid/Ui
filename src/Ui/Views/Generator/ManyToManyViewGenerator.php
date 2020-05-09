<?php


namespace Ui\Views\Generator;

use Entity\DefaultResolver;
use Ui\HTML\Elements\Nested\Div;
use Ui\Widgets\Views\FieldButton;

/**
 * Class ManyToManyViewGenerator
 * @package Ui\Views\Generator
 * @author Didier Moindreau <dmoindreau@gmail.com> on 02/11/2019.
 */
class ManyToManyViewGenerator
{
    private $viewables;
    private $className;

    /**
     * ManyToManyViewGenerator constructor.
     * @param $className
     */
    public function __construct(string $className)
    {
        $this->className = $className;
        $accessFilterName = DefaultResolver::getFilter($this->className);
        $this->accessFilter = new $accessFilterName();
        $this->viewables = $this->accessFilter->getViewables();
    }

    /**
     * Return an EntityView with a DivTable inside
     *
     * @param $datas
     * @param bool $clickable
     * @param string $baseURL
     * @return FieldButton
     */
    public function getView(string $baseURL="")
    {
    	$fieldsDefinitionClassName = DefaultResolver::getFieldDefinitions($this->className);
		$fieldsDefinition = new $fieldsDefinitionClassName();
		$fieldTitle = $fieldsDefinition->getDisplayFor($this->getShortClassname($this->className));
        return (new FieldButton($fieldTitle, $baseURL));
    }

    /**
     * @param string $classname
     * @return mixed
     */
    private function getShortClassname(string $classname)
    {
        $s = str_replace('\\', '/', $classname);
        $c = explode("/", $s);
        return  end($c);
    }
}
