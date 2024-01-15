<?php

/** 
 * User Model
 */
final class User
{
  use Model;

  protected $table = "user";
  protected $allowedColumns = [
    "username",
    "password",
    "role_id"
  ];
  public function fetchAll()
  {
    $query = "SELECT * FROM $this->table WHERE role_id != 1 ORDER BY $this->order_column $this->orderBy LIMIT $this->limit OFFSET $this->offset";

    return $this->query($query);
  }


  public function fetchData($search)
  {
    $query = "SELECT $this->table. *  FROM $this->table
                WHERE $this->table.role_id != 1 AND $this->table.username LIKE '%$search%'  ORDER BY $this->order_column $this->orderBy LIMIT $this->limit OFFSET $this->offset";



    $result = $this->query($query);
    return $result;
  }



  public function getCount($search)
  {
    $query = "SELECT COUNT(*) AS count FROM $this->table  WHERE $this->table.role_id != 1 AND  $this->table.username LIKE '%$search%'";

    $result = $this->query($query);

    return $result[0]['count'];
  }

  public function usernameExists($username)
  {
    $query = "SELECT COUNT(*) as count FROM  $this->table WHERE username = :username";
    $result = $this->query($query, ['username' => $username]);

    return $result[0]['count'] > 0;
  }


  public function getRole(int $id)
  {
    $query = "SELECT role.name
    FROM $this->table
    JOIN role ON  $this->table.role_id = role.id
    WHERE  $this->table.id = :id";

    $params = [':id' => $id];
    $result = $this->query($query, $params);

    $role = $result[0]["name"];
    return $role;
  }






}