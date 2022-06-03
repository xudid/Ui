<?php

namespace Ui\Widget\View;

use Ui\HTML\Element\Nested\Section;
use Ui\Widget\Button\Add;
use Ui\Widget\Button\Delete;
use Ui\Widget\Button\Details;
use Ui\Widget\Button\Edit;
use Ui\Widget\Button\ListButton;
use Ui\Widget\Button\Search;

/**
 * Class Entity
 * @package X\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Entity extends Section
{

    private string $title = "";
    private string $subTitle = "";
    private string $name = "";
    private $titleElement = null;
    private $actionBar = null;
    private $subView;

    public function __construct(bool $subView = false)
    {
        parent::__construct();
        $this->actionBar = new Row();

        //$this->childs = [];
        $this->subView = $subView;
    }

    public function setSubTitle(string $title):self
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
                    $button = (new Add())->setClass('btn bg-success mx-2');

                    break;
                case 'DELETE':
                    $button = (new Delete())->setClass('btn bg-danger mx-2');
                    break;

                case 'MODIFY':
                    $button = (new Edit())->setClass('btn bg-primary mx-2');
                    break;
                case 'SEARCH':
                    $button = (new Search())->setClass('btn bg-primary mx-2');
                    break;
                case 'SHOW':
                    $button = (new Details())->setClass('btn bg-primary mx-2');
                    break;
                default:
                    throw new \Exception('Try to add illegal acttion to view, legal Actions are LIST NEW DELETE MODIFY SEARCH ' . $action);
            }
            $button->setOnClick("location.href='$url'");
            $this->actionBar->add($button);
        }
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function __toString(): string
    {
        return parent::__toString();
    }
}
