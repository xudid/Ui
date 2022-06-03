<?php

namespace Ui\Widget\Table\Column;

use Ui\Translation\TranslatorInterface;

interface FactoryInterface
{
    public function from($value):FactoryInterface;
    public function withTranslator(TranslatorInterface $translator):FactoryInterface;
    public function filter(...$fields):FactoryInterface;
    public function make(): array;
}