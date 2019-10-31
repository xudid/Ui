<?php


namespace Ui\Model;


use InvalidArgumentException;

class DefaultResolver
{
  public static function resolv(string $typeToResolv,string $subpackage, string $entiyClassName,bool $withNamespace = true ):string
  {
      if (!empty($entiyClassName)&&!empty($subpackage)) {
          $path_parts = explode('\\', $entiyClassName);
          $classname = array_pop($path_parts).$typeToResolv;
          if($withNamespace) {
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
}