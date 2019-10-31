<?php
namespace Ui\Views\Holder;

interface InformationHolderInterface
{
    public function getClassName();
    public function getShortClassName();
    public function getGettersName();
    public function getSettersName();
    public function hasAssociation();
    public function getAssociations();
    public function getFields():array;
}
