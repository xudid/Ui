<?php
namespace Automate;

require_once __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
/**
 * 
 */
class Automate 
{
	/**
	 * @param  string $rootdir
	 * @return self
	 */
	public function __contruct(string $rootdir)
	{
		$this->getMethodParams($this, '__contruct');
		$this->getMethodParams($this, 'getMethodParams');

		return $this;
	}

	/**
	 * @param  string $class
	 * @param  a $method
	 * @return array
	 */
	private function getMethodParams(string $class, string $method)
	{
		$rcm = new ReflectionClass($class)->getMethod($method);
		var_dump($rc->getDocComment());
		return [];
	}
}