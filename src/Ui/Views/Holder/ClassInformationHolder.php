<?php

namespace Ui\Views\Holder;

use Exception;
use phpDocumentor\Reflection\Types\Object_;
use Ui\Model\Field;

/**
 * Class ClassInformationHolder
 * @package Xudid\MetaData\Holder
 * @author Didier Moindreau <dmoindreau@gmail.com> on 22/10/2019.
 */
class ClassInformationHolder implements InformationHolderInterface
{
    /**
     * @var string $shortClassName
     */
    protected $shortClassName;
    protected $reflectionClass;
    protected $hasAssociation;
    protected $associations = [];
    /**
     * @var array
     */

    protected $getters;
    /**
     * @var string $className
     */

    protected  string $className;

    /**
     * @var array $fieldnames
     */
    private $fieldnames;

    private $fields = [];

    /**
     * ClassInformationHolder constructor.
     * @param string|Object_ $className
     * @throws \ReflectionException
     */

    public function __construct($className)
    {
        $this->reflectionClass = new \ReflectionClass($className);
        $this->setClassName($className);

        $this->findFields();
        $this->hasAssociation = false;
        try {
            $this->hasAssociation= $this->findAssociations();
        } catch (Exception $e) {
            //TODO manage Exception
        }
    }

    public function hasEntity(){
        return false;
    }

    private function setClassName($className)
    {

        if (is_string($className)) {
            $this->className = $className;
            $s = \str_replace('\\', '/', $className);
            $c = \explode("/", $s);
            $this->shortClassName = \end($c);
        } else {
            $this->className = $this->reflectionClass->getName();
            $this->shortClassName = $this->reflectionClass->getShortName();
            $this->entity = $className;
        }

    }

    /**
     * @return array
     */
    protected function findFields(): array
    {
        $filednames = [];
        if ($this->className != "Doctrine\ORM\PersistentCollection") {

            foreach ($this->reflectionClass->getMethods() as $method) {
                $methodName = $method->getName();
                $matched = preg_match("#^get[\w]+|is[\w]+|has[\w]+#", $methodName, $matches);
                if ($matched) {
                    $getter = $matches[0];
                    $this->getters[] = $getter;
                    if ($this->reflectionClass->hasProperty($getter)) {
                        $filedname = $getter;
                    } else {
                        $filedname = lcfirst(preg_replace(["#get#", "#is#", "#has#"], [""], $methodName));
                    }


                    if (array_key_exists($filedname, $this->fields)) {
                        ($this->fields[$filedname])->setReadable();
                    } else {
                        $field = (new Field($filedname))->setReadable();
                        $this->fields[$filedname] = $field;
                    }
                }
                $matched = preg_match("#^set[\w]+#", $methodName, $matches);
                if ($matched) {
                    $this->setters[] = $matches[0];
                    $filedname = lcfirst(preg_replace(["#set#"], [""], $methodName));
                    if (array_key_exists($filedname, $this->fields)) {
                        ($this->fields[$filedname])->setWritable();

                    } else {
                        $field = (new Field($filedname))->setWritable();
                        $this->fields[$filedname] = $field;
                    }
                }
            }
            return $filednames;
        }
    }

    public function getClassName()
    {
        return $this->className;
    }



    protected function findAssociations()
    {
        $hasAsociation = false;
        foreach ($this->fields as $field) {
            $fieldname = $field->getName();
            try {
                $property = $this->reflectionClass->getProperty($fieldname);
                $docComment = ($property->getDocComment());
                $field->setDocComment($docComment);
                $pattern = "#@[a-zA-Z0-9, ()_].*#";
                preg_match_all($pattern, $docComment, $matches, PREG_PATTERN_ORDER);

                foreach ($matches as $key => $comments) {
                    foreach ($comments as $key => $comment) {
                        if (preg_match("#^@var[\s]+([\w\\\\]+)[\s]+[$\w]+#", $comment, $parts)) {
                            $field->setType($parts[1]);
                        } else {
                            if (preg_match('#^@(ManyToOne)\([\w]+="([\w\\\\]+)#',$comment, $parts)) {

                                if (array_key_exists(1, $parts) && array_key_exists(2, $parts)) {
                                    $hasAsociation = true;
                                    $this->addAssociation($field, $parts[1], $parts[2]);
                                } else {
                                    throw new Exception("Malformed Association annotation in : " .
                                                                    $this->className . " for field :" . $fieldname);
                                }
                            }

                            if (preg_match('#^@(ManyToMany)\([\w]+="([\w\\\\]+)#',$comment, $parts)) {

                                if (array_key_exists(1, $parts) && array_key_exists(2, $parts)) {
                                    $hasAsociation = true;
                                    $this->addAssociation($field, $parts[1], $parts[2]);

                                } else {
                                    throw new Exception("Malformed Association annotation in : " .
                                        $this->className . " for field :" . $fieldname);
                                }
                            }

                            if (preg_match('#^@(OneToMany)\([\w]+="([\w\\\\]+)#',$comment, $parts)) {

                                if (array_key_exists(1, $parts) && array_key_exists(2, $parts)) {
                                    $hasAsociation = true;
                                    $this->addAssociation($field, $parts[1], $parts[2]);

                                } else {
                                    throw new Exception("Malformed Association annotation in : " .
                                        $this->className . " for field :" . $fieldname);
                                }
                            }

                            if (preg_match('#^@(OneToOne)\([\w]+="([\w\\\\]+)#',$comment, $parts)) {

                                if (array_key_exists(1, $parts) && array_key_exists(2, $parts)) {
                                    $hasAsociation = true;
                                    $this->addAssociation($field, $parts[1], $parts[2]);

                                } else {
                                    throw new Exception("Malformed Association annotation in : " .
                                        $this->className . " for field :" . $fieldname);
                                }
                            }

                        }

                    }
                }
            } catch (\ReflectionException $exception) {
                //Property doesn't exist
            }
        }
        return $hasAsociation;
    }

    private function addAssociation(Field $field, string $associationType, string $associationClass)
    {
        $field->setIsAssociation();
        $field->setAssociationClass($associationClass);
        $field->setAssociationType($associationType);
        $this->associations[] = $field;
    }

    public function getShortClassName()
    {
        return $this->shortClassName;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Getters name must start with "get" "has" or "is"
     * @return array
     */
    public function getGettersName()
    {
        return $this->getters;
    }

    /**
     * Setters name must start with set
     * @return array
     */
    public function getSettersName()
    {
        return $this->setters;
    }

    //Todo ? rewrite with reflectionClass->getProperties reflectionClass->hasMethod() get is has set

    public function hasAssociation()
    {
        return count($this->associations) > 0 ? true : false;
    }

    public function getAssociations()
    {
        return $this->associations;
    }
}
