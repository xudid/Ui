<?php

namespace Ui\Views;

use Ui\HTML\Elements\Nested\Section;
use Ui\Widgets\Button\AddButton;
use Ui\Widgets\Button\Button;
use Ui\Widgets\Button\DelButton;
use Ui\Widgets\Button\DetailsButton;
use Ui\Widgets\Button\EditButton;
use Ui\Widgets\Button\ListButton;
use Ui\Widgets\Button\SearchButton;
use Ui\Widgets\Views\Row;
use Ui\Widgets\Views\Title;

/**
 * Class EntityView
 * @package Ui\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class EntityView extends Section
{

    private string $title = "";
    private string $subTitle = "";
    private string $name = "";
    private $titleElement = null;
    private $actionBar = null;
    /**
     * @var bool
     */
    private $subView;

    /**
     * EntityView constructor.
     */
    public function __construct(bool $subView = false)
    {
        parent::__construct();
        $this->actionBar = new Row();

        //$this->childs = [];
        $this->subView = $subView;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setSubTitle(string $title)
    {
        $this->subTitle = $title;
        $this->subTitleElement = (new Title(6, $this->subTitle));
        $this->subTitleElement->setClass("bg-secondary text-white text-center py-2 mb-0");
        $this->offsetSet(2, $this->subTitleElement);
        return $this;
    }

    public function setTitle(string $title)
    {
        $size = $this->subView ? 6 : 5;
        $this->title = $title;
        $this->titleElement = (new Title($size, $this->title));
        $this->titleElement->setClass("bg-primary text-white text-center py-2 mb-0 rounded-top");
        $this->setFirst($this->titleElement);
        return $this;
    }

    public function withActions(array $actions)
    {
        $this->actionBar->setClass('bg-white justify-center large-30 p-2 shadow border-rounded-sm mx-auto');
        $this->add($this->actionBar);
        foreach ($actions as $action => $url) {
            $button = null;
            switch (strtoupper($action)) {
                case 'LIST':
                    $button = (new ListButton())->setClass('btn bg-primary mx-2');
                    break;
                case 'NEW':
                    $button = (new AddButton())->setClass('btn bg-success mx-2');

                    break;
                case 'DELETE':
                    $button = (new DelButton())->setClass('btn bg-danger mx-2');
                    break;

                case 'MODIFY':
                    $button = (new EditButton())->setClass('btn bg-primary mx-2');
                    break;
                case 'SEARCH':
                    $button = (new SearchButton())->setClass('btn bg-primary mx-2');
                    break;
                case 'SHOW':
                    $button = (new DetailsButton())->setClass('btn bg-primary mx-2');
                    break;
                default:
                    throw new \Exception('Try to add illegal acttion to view, legal Actions are LIST NEW DELETE MODIFY SEARCH ' . $action);
            }
            $button->setOnClick("location.href='$url'");
            $this->actionBar->add($button);
        }


    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return parent::__toString();
    }
}
