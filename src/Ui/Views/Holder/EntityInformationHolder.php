<?php
namespace Ui\Views\Holder;

use ReflectionException;
use ReflectionMethod;

class EntityInformationHolder extends ClassInformationHolder
{
    protected $entity;


    /**
     * EntityInformationHolder constructor.
     * @param $className
     * @throws ReflectionException
     */
    public function __construct($entity)
    {
            try {
                parent::__construct($entity);
            } catch (ReflectionException $e) {
                throw new \InvalidArgumentException("EntityInformationHolder can't find medata on null Entity\n");
            }
    }

    public function hasEntity(){
        return true;
    }

    public function getEntityFieldValue($fieldName)
    {
        $methodName = "get" . ucfirst($fieldName);

        if(in_array($methodName, $this->getGettersName()))
        {
            try {
                $method = new ReflectionMethod($this->entity, $methodName);
                $val = $method->invoke($this->entity);
                return $val;
            } catch (ReflectionException $e) {
            }

        }
    }

    public function getEntity()
    {
        return $this->entity;
    }


}