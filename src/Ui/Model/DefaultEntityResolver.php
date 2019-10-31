<?php


namespace Ui\Model;


class DefaultEntityResolver
{
    public static function getEntityClassName(string $classname,bool $withNamespace = true)
    {
        try {
            /** @var string $fieldDefinitionName */
            $fieldDefinitionName = "";
            $fieldDefinitionName = DefaultResolver::resolv("Entity", "Entities",$classname, $withNamespace);
            return $fieldDefinitionName;
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException("DefaultEntityResolver can't resolve 
                                                                Entity without entity class name");
        }
    }
}