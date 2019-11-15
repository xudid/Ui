<?php


namespace Ui\Model;


use InvalidArgumentException;

class DefaultResolver
{
    public static function resolv(string $typeToResolv, string $subpackage, string $entiyClassName, bool $withNamespace = true): string
    {
        if (!empty($entiyClassName) && !empty($subpackage)) {
            $path_parts = explode('\\', $entiyClassName);
            $classname = array_pop($path_parts) . $typeToResolv;
            if ($withNamespace) {
                $parts_count = count($path_parts);
                if ($parts_count <= 1) {
                    $path_parts[] = $subpackage;
                } else {
                    $path_parts[$parts_count - 1] = $subpackage;
                }
                $classname = implode('\\', [implode('\\', $path_parts), $classname]);
            }
            return $classname;
        } else {
            throw new InvalidArgumentException();
        }
    }

    public static function getEntityClassName(string $classname, bool $withNamespace = true)
    {
        try {
            /** @var string $fieldDefinitionName */
            $fieldDefinitionName = "";
            $fieldDefinitionName = self::resolv("Entity", "Entities", $classname, $withNamespace);
            return $fieldDefinitionName;
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException("DefaultEntityResolver can't resolve 
                                                                Entity without entity class name");
        }
    }

    /**
     * @param string $classname
     * @return array
     */
    public static function getFieldDefinitions(string $classname, bool $withNamespace = true): string
    {
        try {
            /** @var string $fieldDefinitionName */
            $fieldDefinitionName = "";
            $fieldDefinitionName = self::resolv("FormFieldDefinition", "Views", $classname, $withNamespace);
            return $fieldDefinitionName;
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException("DefaultFieldDefinitionResolver can't resolve 
                                                                FormFilter without entity class name");
        }
    }
    public static function getFilter(string $classname,bool $withNamespace = true):string
    {
        try {
            /** @var string $fieldDefinitionName */
            $fieldDefinitionName = "";
            $fieldDefinitionName = self::resolv("FormFilter","Views", $classname, $withNamespace);
            return $fieldDefinitionName;
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException("DefaultFormFilterResolver can't resolve 
                                                    FormFilter without entity class name");
        }
    }
}