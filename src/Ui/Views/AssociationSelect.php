<?php


namespace Ui\Views;

use Entity\DefaultResolver;
use Entity\Metadata\Association;
use Entity\Model\ManagerInterface;
use Entity\Model\ModelManager;
use ReflectionException;
use Ui\Widgets\Input\SelectOption;
use Ui\Widgets\Views\NamedFieldset;

class AssociationSelect extends SelectOption
{
    public function __construct(ManagerInterface $modelManager,  $association,  $model = null)
    {
        // take a ManagerFactory as constructor parameter ?
        // need to change the FormFactory (ViewFactory parameter ) for a ManagerFactory
        // or permit to get a modelManager from an existing one
        // like modelManager->getManager($className);
        $associationType = $association->getType();
        $className = $association->getOutClassName();

        $holdingClassName = $association->getHoldingClassName();
        if($associationType == Association::OneToOne) {
            $models = $modelManager->findAssociationValuesBy($holdingClassName,$model);
            $associationModel = new $holdingClassName();
            $associationModel::getTableName();
            $fieldName = $associationModel::getTableName();
        }

        if($associationType == Association::OneToMany) {

        }

        if($associationType == Association::ManyToMany) {
            $models = $modelManager->findAll();
            $fieldName = $association->getName();
        }

        if($associationType == Association::ManyToOne) {

        }

        try {
            $fieldsDefinitions = DefaultResolver::getFieldDefinitions($className);
            $options = [];
            $selectKey = $fieldsDefinitions->getAssociationSelectKey();
            $selectValue = $fieldsDefinitions->getAssociationSelectField();
            if (strlen($selectKey) == 0 || strlen($selectValue) == 0) {
                throw new \Exception('No select key and select value in : ' . $className);
            }
            foreach ($models as $model) {

                $options[$model->getPropertyValue($selectKey)] = $model->getPropertyValue($selectValue);
            }
            parent::__construct($options);
            $this->setName($fieldName . '_' . $selectKey);
            $this->setClass('form-control');
        } catch (ReflectionException $exception) {
            throw $exception;
        }
    }


}