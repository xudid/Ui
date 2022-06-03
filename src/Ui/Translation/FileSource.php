<?php

namespace Ui\Translation;

use Exception;

class FileSource implements SourceInterface
{
    static $translations = [];
    private string $path;

    /**
     * @throws Exception
     */
    public function __construct($path)
    {
        $this->path = $path;


    }
    public function get($field): string
    {
        if (!file_exists($this->path)) {
            throw new UnavailableSourceException($this);
        }

        if (!static::$translations) {
            static::$translations = require($this->path);
        }

        if (!is_array(static::$translations)) {
            throw new InvalidSourceException($this);
        }

        if (empty(static::$translations)) {
            throw new EmptySourceException($this);
        }

        if(!array_key_exists($field, static::$translations)) {
            throw new TranslationNotFoundException($this);
        }

        return static::$translations[$field];
    }

    public static function reset()
    {
        static::$translations = [];
    }
}