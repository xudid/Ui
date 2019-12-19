<?php
namespace Ui\Model\Database;

/**
 *
 */
interface DaoInterface
{
  /**
   * [save description]
   * @return [type] [description]
   */
  public function save($object);

  /**
   * [update description]
   * @return [type] [description]
   */
  public function update($object);

  /**
   * [delete description]
   * @param  int    $id [description]
   * @return [type]     [description]
   */
  public function delete(int $id);

  /**
   * [findAll description]
   * @return [type] [description]
   */
  public function findAll();

  /**
   * [findById description]
   * @param  int    $id [description]
   * @return [type]     [description]
   */
  public function findById(int $id);

  /**
   * [findBy description]
   * @param array $params
   * @return [type] [description]
   */
  public function findBy(array $params);

}

