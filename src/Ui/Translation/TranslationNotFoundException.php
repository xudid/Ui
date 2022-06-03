<?php

namespace Ui\Translation;

use Exception;

class TranslationNotFoundException extends Exception
{
    public function __construct(SourceInterface $source)
    {
        parent::__construct('Translation not found ' . get_class($source));
    }
}