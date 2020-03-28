<?php


namespace Ui\Views\Generator;

use Entity\DefaultResolver;
use Entity\Metadata\Field;
use Entity\Metadata\Holder\ClassInformationHolder;
use Entity\Metadata\Holder\EntityInformationHolder;
use Entity\Metadata\Holder\InformationHolderInterface;
use Ui\Views\Generator\FormFieldGenerator;
use Ui\Views\ViewFieldsDefinitionInterface;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableColumn;
use Ui\Widgets\Table\TableLegend;

class ManyAssociationProcessor
{

    private InformationHolderInterface $informationHolder;
    private $classname;
    private $entity;
    /**
     * @var string
     */
    private $shortClassName;

    /**
     * ManyAssociationProcessor constructor.
     * @param $classname
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
        if (is_string($entity)) {
            $this->informationHolder = new ClassInformationHolder($entity);
        } else {
            $this->informationHolder = new EntityInformationHolderAlias($entity);
        }
        //Init class names
        $this->classname = $this->informationHolder->getClassName();
        $this->shortClassName = $this->informationHolder->getShortClassName();
    }


    /**
     * @param Field $association
     */
    public function getPartial(Field $association)
    {

        //print_r(__FILE__.__LINE__." association is ".$association->getType()."<br>");
        $this->classname = $association->getClassname();
        //We want to Edit Something
        if($this->informationHolder->hasEntity())
        {
            $val = $this->informationHolder->getEntityFieldValue($association->getFieldname());
            if(!($val instanceof \Doctrine\ORM\PersistentCollection))
            {
                $ffg1 = new FormFieldGenerator($val, "default", null);

                //Get partial Form
                $fields1 = $ffg1->getPartialForm();
                //Add partiel Form to form
                $this->frm->add($fields1);
            }
            else
            {
                $collection = $val->getValues();
                $ei = new EntityInformationHolder($this->classname);
                $vfdClassName = DefaultResolver::getFieldDefinitions($this->classname);
                $viewFieldDefinitions = new $vfdClassName();
                $title =  $viewFieldDefinitions->getDisplayFor($ei->getShortClassName());

                //Todo Use DataTableView here
                $drt = new DivTable(
                    [new TableLegend($title, TableLegend::TOP_LEFT)],
                    [new TableColumn("name", "Roles")],
                    $collection ,false," ");
                $this->frm->add($drt);
            }

        }
        //We want to create something
        else
        {
            $ffg1 = new FormFieldGenerator($this->classname,"default");
            //Get partial Form
            $ffg1->getPartialForm($this->frm);
        }
    }
}
