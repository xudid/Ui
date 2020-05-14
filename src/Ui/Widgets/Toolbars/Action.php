<?php


namespace Ui\Widgets\Toolbars;


use Ui\Widgets\Button\AddButton;
use Ui\Widgets\Button\DelButton;
use Ui\Widgets\Button\EditButton;
use Ui\Widgets\Button\SearchButton;
use Ui\Widgets\Button\ViewListButton;
use Ui\Widgets\Views\Row;

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
                    $button = (new ViewListButton())->setClass('btn bg-primary mx-2');
                    break;
                case 'ADD':
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

                default:
                    throw new \Exception('Try to add undefined action to view');
            }
            $button->setOnClick("location.href='$url'");
            $this->add($button);
        }

    }
}
