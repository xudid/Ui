<?php


namespace Ui\Views\Holder;


use Entity\Metadata\Holder\ClassInformationHolder;
use Entity\Metadata\Holder\EntityInformationHolder;

trait InformationHolderFactory
{
    public static function getInformationHolder($entity)
    {
        if (is_string($entity)) {
            return new ClassInformationHolder($entity);
        } else {
            return new EntityInformationHolder($entity);
        }
    }
}