<?php

namespace Ui\Views;
/**
 * [ViewFieldsDefinition description]
 */
class ViewFieldsDefinition implements ViewFieldsDefinitionInterface
{
    /**
     * An associative array that contains fields definitions
     * by example a definition can be : "name"=>"input"
     * @var array $fieldsDefinition
     */
    protected $fieldsDefinition = [];

    /**
     * An associative array that contains single arrays of
     * data to display in an input like SelectOption
     * by example : "role"=>["sysadmin","ceo","DBA","PA"]
     * @var array $dataForListInput
     */
    protected $dataForListInput = [];


    protected $associationSelectField = '';
    protected $associationSelectKey = '';
    /**
     * An associative array that contains string
     * to display to user
     * @var array $displays
     */
    protected $displays = [];

    /**
     * [protected description]
     * @var array
     */
    protected $templateForAction = [];

    /**
     * [__construct description]
     */
    function __construct()
    {

    }


    public function getInputTypeFor(string $fieldname): string
    {
        if ($this->exists($fieldname)) {
            return $this->fieldsDefinition[$fieldname];
        }
       return 'input';
    }

    public function getDataForListInput(string $fieldname): array
    {
        return $this->dataForListInput[$fieldname];
    }

    public function getAssociationSelectField()
    {
        return $this->associationSelectField;
    }

    public function getAssociationSelectKey()
    {
        return $this->associationSelectKey;
    }

    public function getDisplayFor(string $value): string
    {
        if (array_key_exists($value, $this->displays)) {
            return $this->displays[$value];
        }
        return $value;
    }


    public function getPathTemplateForAction(string $action): string
    {
        return $this->templateForAction[$action];
    }

    private function exists($field)
    {
        return array_key_exists($field, $this->fieldsDefinition);
    }
}
