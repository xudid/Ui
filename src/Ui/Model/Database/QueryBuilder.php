<?php
namespace Ui\Model\Database;

/**
 *Construct a sql request
 */
class QueryBuilder
{
  /**
   * @var array $select
   */
  private $select = [];

  /**
   * @var $insert
   */
   private $insert="";
   /**
    * @var array fields
    */

    private $update="";
    private $fields=[];
/**
 * @var array $values
 */
    private $values=[];

  /**
   * @var array $from
   */
  private $from = [];
  /**
   * @var array $where
   */
  private $where = [];
  /**
   * @var array $groupby
   */
  private $groupby = [];
  /**
   * @var array $orderby
   */
  private $orderby = [];
  /**
   * @var array $limit
   */
  private $limit = [];

  /**
   * @var array $set
   */
  private $set=[];

   /**
    * Construct a new QueryBuilder
    */
  function __construct()
  {

  }
/**
 * @param string $fields
 * fields to select on a table
 */
  public function select(... $fields){
  $this->select =  array_merge($this->select, $fields);
  return $this;
  }
  /**
   * @param string $table : table to insert data in
   * @return self
   */
   public function insert($table){
     $this->insert=$table;
     return $this;
   }

   /**
    * @param  $fields
    * @return self
    */
    public function fields(... $fields){
      $this->fields =  array_merge($this->fields, $fields);
      return $this;
    }

    /**
     * @param  $values
     * @return self
     */
     public function values(... $values){
       $this->values =  array_merge($this->values, $values);
       return $this;
     }
/**
 * @param string $table
 * table to update
 */
  public function update($table){
    $this->update = $table;
    return $this;
  }
/**
 * @param string $fields
 * fields to update
 */
  public function set(...$fields){
    $this->set = \array_merge($this->set,$fields);

    return $this;
  }
/**
 * @param string $tables
 * tables from which we select fields
 */
  public function from(... $tables){

      $this->from = array_merge($this->from, $tables);

    return $this;
  }
/**
 * @param string $conditions
 */
  public function where(...$conditions){


      $this->where = array_merge($this->where, $conditions);


    return $this;
  }

  
/**
 * @param array $values
 */
  public function groupBy(array $values){
    $this->groupby[] = $values;
    return $this;
  }

  /**
   * @param array $values
   */
  public function orderBy(array $values){
    $this->orderBy[] = $values;
    return $this;
  }
/**
 * @param int $limit
 * @param int $offset
 */
  public function withLimit( int $limit ,$offset = "0"){
    $this->limit["limit"] = $limit;
    $this->limit["offset"] = $offset;
    return $this;
  }

/**
 * Build the sql request
 * @param $requetetype
 */
 public function build($requetetype){
   //\var_dump($requetetype);
   switch ($requetetype) {

     case 'select':
       return $this->buildSelect();
       break;

    case 'insert':
      return $this->buildInsert();
      break;

      case 'update':
        return $this->buildUpdate();
        break;

      case 'delete':
        return $this->buildDelete();
        break;

     default:

       break;
   }
 }
 /**
  *
  */
  private function buildSelect(){
    $query ='';
     if($this->select){$query ='select';}
     else{$query ="select * ";}
     $query= $query." ".join(',',$this->select);
     $query.=" from ";
     $query=$query." ".join(',',$this->from);
     if($this->where)
     {
       $query.=" where ";
       $keys =array_keys($this->where) ;
       $last_key = end($keys);
       foreach($this->where as $w=>$value)
       {
         $query=" ".$query.$value." ";
         if($w != $last_key)
         {
           $query=" ".$query."and ";
         }
       }
     }

     if($this->limit)
     {
       $query.=" limit ".$this->limit["limit"]." offset "
                        .$this->limit["offset"];
     }

     return $query;
  }

  /**
   * @return string  : An Insert SQL request
   */
  public function buildInsert(){
    $query ='';
     if($this->insert){$query ='insert into '.$this->insert.' (';}
     $query= $query." ".join(',',$this->fields);
     $query.=") values(";
     $query= $query." ".join(',',$this->values);
     $query.=");";
     //echo "<br>".$query."<br>";
     return $query;
  }

  public function buildUpdate()
  {
    $query='';
    if($this->update){$query = 'update '.$this->update;}
    $query = $query." set ";
    $query=$query." ".join(',',$this->set);

    $query = $query." where ";
    $keys =array_keys($this->where) ;
    $last_key = end($keys);
    foreach($this->where as $w=>$value)
    {
      $query=" ".$query.$value." ";
      if($w != $last_key)
      {
        $query=" ".$query."and ";
      }
    }

    return $query;
  }

/**
 * Build a delete sql request
 */
  public function buildDelete()
  {
    $query='';
    $query ='delete';
    $query.=" from ";
    $query=$query." ".join(',',$this->from);
    if($this->where)
    {
      $query.=" where ";
      $keys =array_keys($this->where) ;
      $last_key = end($keys);
      foreach($this->where as $w=>$value)
      {
        $query=" ".$query.$value." ";
        if($w != $last_key)
        {
          $query=" ".$query."and ";
        }
      }
    }
    return $query;
  }

  public function selectFromClass($relation){
    $type = $relation->getType();
    switch ($type) {
      case 'OneToOne':
        $this->selectFromOnetoOne($relation);
        break;

        case 'OneToMany':
          $this->selectFromOnetoMany($relation);
          break;
        case 'ManyToMany':
          $this->selectFromManytoMany($relation);
          break;

      default:
        # code...
        break;
    }

  }
  private function selectFromOnetoOne($relation){
    $query;

    ((new QueryBuilder())->select()->from($tableowner,$tableowned)->build("select"));


  }
  private function selectFromOneToMany($relation){

  }
  private function selectFromManytoMany($relation){

  }
}


?>
