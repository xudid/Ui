<?php
namespace Xudid\MetaData\Holder;

class EntityInformationHolder extends ClassInformationHolder
{
    private $className;

    /**
     * EntityInformationHolder constructor.
     * @param $className
     */
    public function __construct($className)
    {
        $this->className = setClassName($className);
    }

    private function setClassName($className)
    {
        if (is_string($className)) {
            $this->classname = $className;
            $s = \str_replace('\\', '/', $className);
            $c = \explode("/", $s);
            $this->shortClassName = \end($c);
        } else {
            $this->classname = $this->reflectionClass->getName();
            $this->shortClassName = $this->reflectionClass->getShortName();
            $this->entity = $className;
        }

    }
}