<?php
namespace Ui\Model;

interface Entity{

  public function findById($id);
  public function findBy(array $fields);
  public function findAll();
  public function create($object);
  public function update($object);
  public function delete($object);


}
?>
