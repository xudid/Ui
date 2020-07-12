<?php

namespace Ui\Views;

use Ui\HTML\Elements\Bases\Base;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Section;
use Ui\Widgets\Accordeon\CollapsibleItem as CollapsibleItem;
use Ui\Widgets\FieldInfo;

/**
 * Class EntityPartialViewFactory
 * @package Ui\Views
 */
class EntityPartialViewFactory extends ViewFactory
{
    private $iscollapsible = false;
    /**
     * [private description]
     * @var [type]
     */
    private string $path = "";
    /**
     * @var bool
     */
    private $subView;
    private $viewables;

    private  $entityView;

    /**
     * EntityPartialViewFactory constructor.
     * @param $model
     * @param string $accessFilter
     * @param bool $subView
     */
    public function __construct($model, bool $subView = false)
    {
        parent::__construct($model);
        $this->setFieldsDefinitions();
        $this->subView = $subView;
    }

    /**
     * @param bool $subView
     * @return Base|CollapsibleItem
     */
    public function getPartialView(bool $subView = false)
    {
        $this->viewables = $this->accessFilter->getViewables();

        if ($this->iscollapsible) {
            $this->entityView = new CollapsibleItem();
            $display = $this->fieldsDefinitions->getDisplayFor($this->shortClassName);
            $this->entityView->setHeader($display);
            $content = $this->generateCollapsibleContent();
            $this->entityView->setContent($content);

        } else {
            $this->entityView = (new Section())->setClass('row d-flex m-3 justify-content-center');
            $this->generateContent();
        }

        return $this->entityView;
    }

    /**
     * [generateContent description]
     *
     */
    private function generateContent()
    {
        foreach ($this->fields as $column) {
            if (in_array($column->getName(), $this->viewables)) {
               $val = $this->model->getPropertyValue($column->getName());
                $display = $this->fieldsDefinitions->getDisplayFor($column->getName());
                $fieldInfo = new FieldInfo($display, $val);
                $this->entityView->add($fieldInfo);
            }
        }
    }

    function generateCollapsibleContent()
    {
        $div = new Div();
        foreach ($this->fields as $column) {
            if (in_array($column->getName(), $this->viewables)) {
                $val = $this->model->getPropertyValue($column->getName());
                $display = $this->fieldsDefinitions->getDisplayFor($column->getName());
                $fieldInfo = new FieldInfo($display, $val);
                $div->add($fieldInfo);
            }
        }
        return $div;
    }

    /**
     * [setCollapsible description]
     */
    public function setCollapsible()
    {
        $this->iscollapsible = true;
    }

    public
    function setCurrentPath($path)
    {
        $this->path = $path;
    }
}
