<?php

namespace Ui\Translation;

class Translator implements TranslatorInterface
{
    private SourceInterface $source;

    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    public function translate($fieldName): string
    {
        try {
            return $this->source->get($fieldName);
        } catch (TranslationNotFoundException $exception) {
            return '';
        } catch (EmptySourceException $exception) {
            return '';
        }
    }
}