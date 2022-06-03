<?php


namespace Ui\Widgets\Gantt;


use Ui\HTML\Element\Nested\Div;

class Lane extends Div
{
    private $resourceName = 'Test';
    private array $tasks = [];
    /**
     * @var int
     */
    private int $width;
    /**
     * @var \Ui\HTML\Element\Base\Base
     */
    private Div $container;

    private Div $lineContainer;
    /**
     * @var int
     */
    private int $spendTime;

    /**
     * Lane constructor.
     * @param mixed ...$tasks
     */
    public function __construct(...$tasks)
    {

        if (is_array($tasks)) {
            $this->tasks = $tasks;
        } else {
            foreach ($tasks as $task) {
                $this->tasks[] = $task;
            }
        }
        $this->spendTime = $this->tasks[0]->getStart();
        $this->header = (new Div())->setClass('flex-col justify-content-center pr-2 large-30');
        parent::__construct();
        $this->setClass('flex-row ');
        $this->add($this->header);
        $this->container = (new Div())->setClass('flex-col flex-grow-1 py-2');
        $this->add($this->container);
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width)
    {
        $this->width = $width;
    }

    /**
     * @param string $resourceName
     */
    public function setResourceName(string $resourceName): void
    {
        $this->resourceName = $resourceName;
    }



    public function getLane()
    {
        foreach ($this->tasks as $task) {
            $taskTimeRatio = round($task->getDelay() / $this->width * 100);
            $line = (new Div())->setClass('bg-white flex-row border-bottom py-1');
            $line->add((new Div())
                ->setAttribute('style' ,'width: 10%;')
                ->add($task->getName())
                ->setClass('flex-col bg-secondary text-white mr-1')
            );
            if($this->spendTime > 0 ) {
                $spendTimeRatio = round($this->spendTime / $this->width * 100);
                $prevCol = (new Div())
                    ->setAttribute('style' ,'width:' . $spendTimeRatio . '%;')
                    ->add($this->spendTime)
                    ->setClass('flex-col');
                $line->add($prevCol);
            }
            $taskCol = (new Div())->setAttribute('style' ,'width:' . $taskTimeRatio . '%;');
            $taskCol->setClass('flex-col bg-primary text-white text-center ');
            $line->add($taskCol);

            $this->container->add($line);
            $this->spendTime += $task->getDelay();


        }
       $this->header->add($this->resourceName);
        return $this;
    }
}