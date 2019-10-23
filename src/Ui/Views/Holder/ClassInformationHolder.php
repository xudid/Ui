<?php

namespace Xudid\MetaData\Holder;

use Exception;
use Xudid\MetaData\Field\Field;

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

    private $className;

    /**
     * @var array $fieldnames
     */
    private $fieldnames;

    private $fields = [];

    /**
     * ClassInformationHolder constructor.
     * @param string $className
     * @throws \ReflectionException
     */

    public function __construct(string $className)
    {
        $this->setClassName($className);
        $this->reflectionClass = new \ReflectionClass($className);
        $this->findFields($this->getClassName());
        $this->findAssociations();
    }

    private function setClassName($className)
    {
        if (is_string($className)) {
            $this->className = $className;
            $s = \str_replace('\\', '/', $className);
            $c = \explode("/", $s);
            $this->shortClassName = \end($c);
        }

    }

    /**
     * @return array
     */
    private function findFields(): array
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

    private function findAssociations()
    {
        $isassociation = false;
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
                        if (preg_match("#^@var#", $comment, $parts)) {
                            //TODO process @var to get the var Type
                        } else {
                            if (preg_match("#^@(ManyToMany)\([\w]+=\"([a-zA-Z]*)\"|
                                                   (ManyToOne)\([\w]+=\"([a-zA-Z]*)\"|
                                                    OneToMany\([\w]+=\"([a-zA-Z]*)\"#",
                                                    $comment, $parts)) {
                                if (array_key_exists(1, $parts) && array_key_exists(2, $parts)) {
                                    $associationType = $parts[1];
                                    $associationClass = $parts[2];
                                    $field->setIsAssociation();
                                    $field->setAssociationClass($associationClass);
                                    $field->setAssociationType($associationType);
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
        return $isassociation;
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
