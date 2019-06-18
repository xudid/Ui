<?php
namespace Brick\Utils;

/**
 * BString class offers utils function on string
 */
class BString
{
  /**
  * @param string $string :a string
  * @param string $start : the string start to test if exists
  */
    public static function startsWith($string, $start)
    {
        $res = false;
        if (strpos($string, $start) === 0) {
            $res = true;
        }
        return $res;
    }
  /**
   * @param string $string :a string
   * @param string $end : the string end to test if exists
   */
    public static function endsWith($string, $end)
    {



          $res = false;
        if (((strrpos($string, $end) + strlen($end)) ===
             strlen($string))) {
            $res = true;
        }
            return $res;
    }
}
