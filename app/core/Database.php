<?php
trait Database
{
  private function connect()
  {
    $string = 'mysql:hostname=' . DB_HOST . ';dbname=' . DB_NAME;
    $con = new PDO($string, DB_USER, DB_PASSWORD);
    return $con;
  }

  public function query($query, $data = [])
  {

    $con = $this->connect();
    $stm = $con->prepare($query);

    $check = $stm->execute($data);

    if ($check) {
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      if (is_array($result) && count($result) > 0) {
        return $result;
      }
    }


    return false;
  }

  public function getRow($query, $data = [])
  {
    $con = $this->connect();
    $stm = $con->prepare($query);

    $check = $stm->execute($data);

    if ($check) {
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      if (is_array($result) && count($result) > 0) {
        return $result[0];
      }
    }


    return false;
  }

}