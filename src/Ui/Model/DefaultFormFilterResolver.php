<?php


namespace Ui\Model;


class DefaultFormFilterResolver
{
    public static function getFilter(string $classname,bool $withNamespace = true):string
    {
        try {
            /** @var string $fieldDefinitionName */
            $fieldDefinitionName = "";
            $fieldDefinitionName = DefaultResolver::resolv("FormFilter","Views", $classname, $withNamespace);
            return $fieldDefinitionName;
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException("DefaultFormFilterResolver can't resolve 
                                                    FormFilter without entity class name");
        }
    }
}