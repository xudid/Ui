<?php
//require_once __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;

/**
 *
 */
class ButtonTest extends TestCase
{
    public function testCanConstruct()
    {
        $path  = "../../src/Ui/Widgets/Button/*.php";
        $files = glob($path);
        $object = null;
        foreach ($files as $key => $file) {
            preg_match("#src/([/\w]+)\.php$#", $file, $matches);
            if (array_key_exists("1", $matches)) {
                $className = preg_replace("#/#", '\\', $matches[1]);
                try {
                    $class = new ReflectionClass($className);
                    $parameters = ($class->getConstructor())->getParameters();
                    $count = count($parameters);
                    $i=0;
                    $params = [];
                    while ($i<$count) {
                        $param = $parameters[$i];
                        $name = $param->getName();
                        $param->isArray()?$params[$i] = ["test1","test2"] : $params[$i] = $name;
                        $i++;
                    }

                    $object = $class->newInstanceArgs($params);

                } catch (ReflectionException $e) {
                }
                $this->assertInstanceOf(($className), $object);
            }
        }
    }
}
