<?php

namespace Ui\Views;


/**
 *Give getters to access viewables .....
 */
class ViewFilter implements ViewFilterInterface
{
    /**
     * Readable fileds
     * @var array $viewables
     */
    protected $viewables = [];

    /**
     * Readable fileds for a specific page
     * @var array $viewablesfor
     */
    protected $viewablesfor = [];


    /**
     * Writable fileds
     * @var array $writables
     */
    protected $writables = [];

    /**
     * Writable fileds for a specific page
     * @var array $writablesfor
     */
    protected $writablesfor = [];

    /**
     * Writable fileds for a specific page
     * that must be confirmed
     * @var array $confirmables
     */
    protected $confirmables = [];

    /**
     * Fileds for a specific page
     * from which we want search data
     * @var array $searchables
     */
    protected $searchables = [];

    /**
     * [__construct description]
     */
    function __construct()
    {

    }

    public function getViewables(): array
    {
        return $this->viewables;
    }

    public function getViewablesFor(string $path): array
    {
        if (array_key_exists($path, $this->viewablesfor)) {
            return $this->viewablesfor[$path];
        } else {
            return [];
        }

    }

    public function getWritables(): array
    {
        return $this->writables;
    }

    public function getWritablesFor($path): array
    {
        return $this->writablesfor[$path];
    }

    public function getConfirmables(): array
    {
        return $this->confirmables;
    }

    public function getSearchables(): array
    {
        return $this->searchables;
    }

  /**
   * @param array $viewables
   * @return ViewFilter
   */
  public function setViewables(array $viewables): ViewFilter
  {
    $this->viewables = $viewables;
    return $this;
  }

  /**
   * @param array $writables
   * @return ViewFilter
   */
  public function setWritables(array $writables): ViewFilter
  {
    $this->writables = $writables;
    return $this;
  }

  /**
   * @param array $searchables
   * @return ViewFilter
   */
  public function setSearchables(array $searchables): ViewFilter
  {
    $this->searchables = $searchables;
    return $this;
  }


}

