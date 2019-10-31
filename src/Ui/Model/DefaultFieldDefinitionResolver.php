<?php


namespace Ui\Model;



use InvalidArgumentException;

/**
 * Class DefaultFieldDefinitionResolver
 * @package Ui\Model
 * @author Didier Moindreau <dmoindreau@gmail.com> on 24/10/2019.
 * Assert that the class is in a namespace
 * Generate the FormFieldDefinition classname like this:
 * if entity class is Example\Model\User its FormFieldDefinition will be Example\Views\UserFormFieldDefinition
 * if entity class is Example\User its FormFieldDefinition will be Example\Views\UserFormFieldDefinition
 */
class DefaultFieldDefinitionResolver implements FieldDefinitionResolverInterface
{
     /**
     * @param string $classname
     * @return array
     */
    public static function getFieldDefinitions(string $classname,bool $withNamespace = true): string
    {
        try {
            /** @var string $fieldDefinitionName */
            $fieldDefinitionName = "";
            $fieldDefinitionName = DefaultResolver::resolv("FormFieldDefinition","Views" ,$classname, $withNamespace);
            return $fieldDefinitionName;
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException("DefaultFieldDefinitionResolver can't resolve 
                                                                FormFilter without entity class name");
        }
    }
}