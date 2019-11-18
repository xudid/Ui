<?php


namespace Ui\Views\Generator;

use Ui\HTML\Elements\Nested\Form;
use Ui\Model\DefaultResolver;
use Ui\Views\EntityView;

/**
 * Class OneToOneViewGenerator
 * @package Ui\Views\Generator
 * @author Didier Moindreau <dmoindreau@gmail.com> on 02/11/2019.
 */
class OneToOneViewGenerator implements AssociationViewGenerator
{
    private $fieldsDefinitions;
    /**
     * @var FormFieldGenerator
     */
    private $fieldGenerator;

    /**
     * Return an EntityView
     */
    public function __construct($className)
    {
        $this->className = $className;
        $accessFilterName = DefaultResolver::getFilter($this->classname);
        $this->accessFilter = new $accessFilterName();
        $this->viewables = $this->accessFilter->getViewables();

        $this->fieldGenerator = new FormFieldGenerator($this->classname, $this->accessFilter);

    }


    /**
     * Return an EntityView with a DivTable inside
     */
    public function getView($datas, bool $clickable = false, string $baseURL = "")
    {
        $view = new EntityView();
        $view->add((new Form())->add($this->fieldGenerator->getPartialForm()));
        return $view;
    }
}