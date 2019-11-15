<?php


namespace Usage\Views;


use Ui\Views\ViewFilterInterface;

class UserFormFilter implements ViewFilterInterface
{
    private array $viewables = [];
    private array $writables = [];

    /**
     * UserFormFilter constructor.
     * @param array $viewables
     * @param array $writables
     */
    public function __construct()
    {
        $this->writables = [
            "firstName",
            "lastName",
            "token",
            "role"

        ];

        $this->viewables = $this->writables;
    }


    /**
     * getViewables
     * Return an array with names of field we want to see
     * in generated views
     * @return array
     *
     */
    public function getViewables(): array
    {
        return $this->viewables;
    }

    /**
     * getViewablesFor
     * @param string $path the template path
     *                of the view we want to
     *                build by example : "/articles/:id"
     * @return array   return an array with
     *                 names of field that
     *                 we want to see in generated views
     */
    public function getViewablesFor(string $path): array
    {
        return $this->viewables;
    }

    /**
     * getWritables description
     * @return array return an array with
     *                 names of field that
     *                 we want to modify in
     *                 generated views
     */
    public function getWritables(): array
    {
       return $this->writables;
    }

    /**
     * getWritablesFor description
     * @param string $path the template path
     *                of the view we want to
     *                build by example : "/articles/:id"
     * @return array return an array with
     *                 names of field that
     *                 we want to modify in
     *                 generated views
     */
    public function getWritablesFor($path): array
    {
        // TODO: Implement getWritablesFor() method.
    }

    /**
     * getConfirmables description
     * @return array return an array with
     *                 names of field that
     *                 we want to modify in
     *                 generated views
     *                 and the modification
     *                 must be confirmed by
     *                 the user
     */
    public function getConfirmables(): array
    {
        // TODO: Implement getConfirmables() method.
    }

    /**
     * getSearchables description
     * @return array   return an array with
     *                 names of field that
     *                 we want touse in
     *                 generated search views
     *
     *
     */
    public function getSearchables(): array
    {
        // TODO: Implement getSearchables() method.
    }
}