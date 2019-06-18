<?php
//require_once __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use Ui\Widgets\Input\TextInput;
use Automate\TestAutomate;

/**
 * 
 */
class ButtonTest extends TestCase
{
	
	public function testCanConstruct()
	{
		
		$basedir = "src/";
		$path  = "src/Ui/Widgets/Button/*.php";
		$files = glob($path);
		foreach ($files as $key => $file) {
			preg_match("#src/([/\w]+)\.php$#", $file, $matches);
			if (array_key_exists("1", $matches)) {
				$class = $matches[1];
				$class = preg_replace("#/#",'\\', $class);
				$class1 = new ReflectionClass($class);
				$constructor = $class1->getConstructor();
				$parameters = $constructor->getParameters();
				//var_dump($class);
				$count = count($parameters);
				//var_dump($count);
				$i=0;
				$params = [];
				while ( $i<$count) {
					$param = $parameters[$i];
					$name = $param->getName();
					$param->isArray()?$params[$i] = ["test1","test2"] : $params[$i] = $name;
					
					//echo $name. "\n"	;
					$i++;
				}
				
				
				
				
				$reflection_class = new ReflectionClass($class);
    			$object = $reflection_class->newInstanceArgs($params);
				

				$this->assertInstanceOf(($class),$object);
			}
			
		}
		
		
	}
}