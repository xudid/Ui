<?php
namespace Ui\Model;

/**
 * Interface FieldDefinitionResolverInterface
 * @package Ui\Model
 * @author Didier Moindreau <dmoindreau@gmail.com> on 24/10/2019.
 */
interface  FieldDefinitionResolverInterface{
    /**
     * @param string $classname
     * @return array
     */
    public static function getFieldDefinitions(string $classname,bool $withNamespace = true):string ;

}
