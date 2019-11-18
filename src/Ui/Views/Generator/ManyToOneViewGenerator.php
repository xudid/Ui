<?php


namespace Ui\Views\Generator;

use Ui\HTML\Elements\Nested\Form;
use Ui\Model\DefaultResolver;
use Ui\Views\EntityView;

/**
 * Class ManyToOneViewGenerator
 * @package Ui\Views\Generator
 * @author Didier Moindreau <dmoindreau@gmail.com> on 02/11/2019.
 */
class ManyToOneViewGenerator implements AssociationViewGenerator
{
    /**
     * ManyToOneViewGenerator constructor.
     * @param string $className
     */
    public function __construct(string $className)
    {
        $this->className = $className;
        $accessFilterName = DefaultResolver::getFilter($this->classname);
        $this->accessFilter = new $accessFilterName();
        $this->viewables = $this->accessFilter->getViewables();

        $this->fieldGenerator = new FormFieldGenerator($this->classname, $this->accessFilter);
    }

    /**
     * Return an EntityView
     * @param $datas
     * @param bool $clickable
     * @param string $baseURL
     * @return EntityView
     */
    public function getView($datas,bool $clickable = false,string $baseURL="")
    {
        $view = new EntityView();
        $view->add((new Form())->add($this->fieldGenerator->getPartialForm()));
        return $view;
        return $view;
    }
}