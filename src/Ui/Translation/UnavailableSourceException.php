<?php

namespace Ui\Translation;

use Exception;

class UnavailableSourceException extends Exception
{
    public function __construct($source)
    {
        parent::__construct('Unavailable source ' . get_class($source));
    }
}