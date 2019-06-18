<?php
require_once __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use Automate\TestAutomate;

/**
 * 
 */
class AutomateTest extends TestCase
{
	
	function testAutomate()
	{
		$automate = new TestAutomate("Ui");
		$params = $automate->getMethodParams("Ui\Widgets\Input\ClickableImage", "__construct");
		$paramCount = count($params);
		$i = 0;
		while ($i < $paramCount) {
			
		}
	}
}