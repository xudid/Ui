<?php

namespace Ui\Utils;

/**
 * BString class offers utils function on string
 */
class BString
{
	/**
	 * @param string $string :a string
	 * @param string $start : the string start to test if exists
	 * @return bool
	 */
	public static function startsWith(string $string, string $start): bool
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
	 * @return bool
	 */
	public static function endsWith(string $string, string $end): bool
	{
		$res = false;
		if (((strrpos($string, $end) + strlen($end)) ===
			strlen($string))) {
			$res = true;
		}
		return $res;
	}
}
