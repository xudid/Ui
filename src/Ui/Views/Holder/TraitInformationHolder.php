<?php

namespace Ui\Views\Holder;

use Entity\Metadata\Holder\ClassInformationHolder;
use Entity\Metadata\Holder\EntityInformationHolder;

/**
 * Trait TraitInformationHolder
 * @package Ui\Views\Holder
 */
trait TraitInformationHolder
{
    /**
     * @param $entity
     * @throws \ReflectionException
     */
    public function getInformationHolder($entity)
    {
        try {
            if (is_string($entity)) {

                $this->informationHolder = new ClassInformationHolder($entity);
            } else {
                $this->informationHolder = new EntityInformationHolder($entity);
                $this->entity = $entity;
            }
        } catch (ReflectionException $e) {
            var_dump($e->getMessage().''.__FILE__);
        }
    }
}
