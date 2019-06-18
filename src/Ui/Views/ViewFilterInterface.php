<?php
namespace Ui\Views;

/**
 *
 */
interface ViewFilterInterface
{
  /**
   * getViewables
   * Return an array with names of field we want to see
   * in generated views
   * @return array
   */
  public function getViewables():array;

  /**
   * getViewablesFor
   * @param  string $path the template path
   *                of the view we want to
   *                build by example : "/articles/:id"
   * @return array   return an array with
   *                 names of field that
   *                 we want to see in generated views
   */
  public function getViewablesFor(string $path):array;

  /**
   * getWritables description
   * @return array return an array with
   *                 names of field that
   *                 we want to modify in
   *                 generated views
   */
  public function getWritables():array;

  /**
   * getWritablesFor description
   * @param  string $path the template path
   *                of the view we want to
   *                build by example : "/articles/:id"
   * @return array return an array with
   *                 names of field that
   *                 we want to modify in
   *                 generated views
   */
  public function getWritablesFor($path):array;

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
  public function getConfirmables():array;

  /**
   * getSearchables description
   * @return array   return an array with
   *                 names of field that
   *                 we want touse in
   *                 generated search views
   *
   *
   */
  public function getSearchables():array;
}
 ?>
