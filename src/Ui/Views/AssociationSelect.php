<?php


namespace Ui\Views;


use Entity\DefaultResolver;
use Entity\Metadata\Association;
use Entity\Model\ModelManager;
use ReflectionException;
use Ui\Widgets\Input\SelectOption;
use Ui\Widgets\Views\NamedFieldset;

class AssociationSelect extends SelectOption
{
    public function __construct(ModelManager $modelManager,  $association)
    {
        // take a ManagerFactory as constructor parameter ?
        // need to change the FormFactory (ViewFactory parameter ) for a ManagerFactory
        // or permit to get a modelManager from an existing one
        // like modelManager->getManager($className);
        $className = $association->getOutClassName();
        $holdingClassName = $association->getHoldingClassName();
        $models = $modelManager->findAll();
        $fieldsDefinitionsClass = DefaultResolver::getFieldDefinitions($className);
        try {
            $reflectionClass = new \ReflectionClass($fieldsDefinitionsClass);

            $fieldsDefinitions = $reflectionClass->newInstanceArgs([$holdingClassName]);
            $options = [];
            $selectKey = $fieldsDefinitions->getAssociationSelectKey();
            $selectValue = $fieldsDefinitions->getAssociationSelectField();
            foreach ($models as $model) {

                $options[$model->getPropertyValue($selectKey)] = $model->getPropertyValue($selectValue);
            }
            parent::__construct($options);
            $this->setName($association->getName() . '_' . $selectKey);
            $this->setClass('form-control');
        } catch (ReflectionException $exception) {
            throw $exception;
        }
    }


}