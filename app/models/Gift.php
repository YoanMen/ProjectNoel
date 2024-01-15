<?php

/** 
 * Gift Model
 */
final class Gift
{
  use Model;

  protected $table = "gift";
  protected $allowedColumns = [
    "id",
    "name",
    "description",
    "recommended_age",
    "category_id",
  ];




  public function GiftExists($name = null)
  {
    $query = "SELECT COUNT(name) FROM $this->table where name = :name;";

    $result = $this->query($query, ['name' => $name]);

    return $result[0]['COUNT(name)'] > 0;
  }


  public function fetchData($name = null)
  {
    $query = "SELECT $this->table. * , category.name as category_name, image_gift.path as image_path  FROM $this->table
              LEFT JOIN  image_gift ON image_gift.gift_id = gift.id
              JOIN category ON category.id = $this->table.category_id 
              WHERE gift.name LIKE '%$name%'  
              ORDER BY $this->order_column $this->orderBy 
              LIMIT $this->limit 
              OFFSET $this->offset";

    $result = $this->query($query);
    return $result;
  }


  public function getCount($name)
  {
    $query = "SELECT COUNT(*) AS count FROM $this->table  WHERE  gift.name LIKE '%$name%'";

    $result = $this->query($query);

    return $result[0]['count'];
  }



  public function fetchWithCategory($category, $name)
  {
    $query = "SELECT $this->table. *, category.name as category_name, image_gift.path as image_path   FROM $this->table
              LEFT JOIN  image_gift ON image_gift.gift_id = gift.id
              JOIN category
              ON category.id = $this->table.category_id   
              WHERE category.name = '$category' &&  gift.name LIKE '%$name%'  
              ORDER BY $this->order_column $this->orderBy 
              LIMIT $this->limit 
              OFFSET $this->offset";

    $result = $this->query($query);
    return $result;
  }



  public function getCountCategory($category, $name)
  {


    $query = "SELECT COUNT(*) as total 
            FROM (
                SELECT gift.*, category.name as category_name 
                FROM gift 
                JOIN category ON category.id = gift.category_id
                WHERE category.name = '$category' && gift.name LIKE '%$name%'
            ) AS total_count;";



    $result = $this->query($query);

    return $result[0]['total'];
  }

}