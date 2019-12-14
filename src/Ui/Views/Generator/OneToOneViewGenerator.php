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

    private $className;

    /**
     * Return an EntityView
     */
    public function __construct($className)
    {
        $this->className = $className;
        $accessFilterName = DefaultResolver::getFilter($this->className);
        $this->accessFilter = new $accessFilterName();
        $this->viewables = $this->accessFilter->getViewables();

        $this->fieldGenerator = new FormFieldGenerator($this->className, $this->accessFilter);

    }


    /**
     * Return an EntityView with a DivTable inside
     */
    public function getView($datas, bool $clickable = false, string $baseURL = "")
    {
        (new Form())->add($this->fieldGenerator->getPartialForm());
        return (new Form())->add($this->fieldGenerator->getPartialForm());
    }
}