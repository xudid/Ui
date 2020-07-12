<?php

namespace Ui\Views;

use App\App;
use Ui\HTML\Elements\Bases\Span;
use Ui\HTML\Elements\Empties\Br;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Form;
use Ui\HTML\Elements\Nested\P;
use Ui\Widgets\Accordeon\CollapsibleItem;
use Ui\Widgets\Accordeon\CollapsibleList;
use Ui\Widgets\Button\CheckBox;
use Ui\Widgets\Button\SubmitButton;
use Ui\Widgets\Button\Toggle;
use Ui\Widgets\Factory\WidgetFactory;
use Ui\Widgets\Input\SelectOption;

class SearchViewFactory extends ViewFactory
{

    private ?Form $form;
    private string $formAction = '';
    private string $formMethod = 'POST';

    /**
     * SearchViewFactory constructor.
     */
    public function __construct($model)
    {
        try {
            parent::__construct($model);
            $this->setFieldsDefinitions();
        } catch (\ReflectionException $e) {
            dump($e);
        } catch (\Exception $e) {
            dump($e);

        }
    }

    public function withAction(string $action)
    {
        $this->formAction = $action;
        return $this;
    }

    public function withMethod(string $method)
    {
        $this->formMethod = $method;
        return $this;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function getView(App $app)
    {
        $this->form = new Form();
        $this->form->setClass("form")
            ->setAction($this->formAction)
            ->setMethod($this->formMethod)
            ->setName($this->classNamespace);
        $t = "Search :" . $this->shortClassName;
        if (isset($this->title)) {
            $t = $this->title;
        }
        $this->form->add(new P($t));
        $choose = new Div();
        $collapsiblelist = new CollapsibleList();
        $item = new CollapsibleItem();
        $item->setHeader("Search parameters");
        $item->setContent($choose);
        $collapsiblelist->addItem($item);

        $this->form->add($collapsiblelist);
        $fieldAdder = new FormFieldAdder($this->model, $this->form);
        foreach ($this->fields as $key => $value) {
            if (in_array($key, $this->getSearchables())) {
                $toggle = new Toggle($key);
                $choose->add(new Span($key . ' '));
                $choose->add($toggle);
                $fieldAdder->add($key);
            }

        }
        $submitButton = new SubmitButton('Chercher');
        $submitButton->setClass('btn btn-primary');
        return $this->form->add($submitButton);
    }
}