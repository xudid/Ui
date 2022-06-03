<?php


namespace Ui\Widgets\Toolbar;


use Ui\Widgets\Button\Add;
use Ui\Widgets\Button\Delete;
use Ui\Widgets\Button\Edit;
use Ui\Widgets\Button\Search;
use Ui\Widgets\Button\ListButton;
use Ui\Widgets\View\Row;

class Action extends Row
{
    /**
     * @var array
     */
    private array $actions;

    /**
     * Action constructor.
     * @param array $actions
     * @throws \Exception
     */
    public function __construct(array $actions)
    {
        parent::__construct();
        $this->actions = $actions;
        $this->setClass('bg-white justify-center p-2 shadow border-rounded-sm mx-auto');
        foreach ($actions as $action => $url) {
            $button = null;
            switch (strtoupper($action)) {
                case 'LIST':
                    $button = (new ListButton())->setClass('btn bg-primary mx-2');
                    break;
                case 'ADD':
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

                default:
                    throw new \Exception('Try to add undefined action to view');
            }
            $button->setOnClick("location.href='$url'");
            $this->add($button);
        }

    }
}
