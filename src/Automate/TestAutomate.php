<?php
namespace Automate;

require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
/**
 * 
 */
class TestAutomate 
{
	/**
	 * @param  string $rootdir
	 * @return self
	 */
	public function __construct(string $rootdir)
	{
		return $this;
	}

	/**
	 * @param  string $class 
	 * @param  string $method
	 * @return array
	 */
	public function getMethodParams(string $class, string $method)
	{
		var_dump("Running test automate \n");
		$rcm = (new \ReflectionClass($class))->getMethod($method);
		$comment = $rcm->getDocComment();
		var_dump($comment);
		
		preg_match_all("#@param\s+([a-zA-Z]+)\s*([a-zA-Z0-9, ()_].*)#", $comment, $matches);
		return $matches;
	}
}