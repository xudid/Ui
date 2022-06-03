<?php

namespace Ui\Translation;

interface TranslatorInterface
{
    public function __construct(SourceInterface $source);
    public function translate($fieldName):string;
}