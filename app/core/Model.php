<?php

/**
 * Main Model Trait 
 **/
trait Model
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $orderBy = "desc";
    protected $order_column = "id";


    public function setOrderColumn(string $column)
    {
        $this->order_column = $column;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }

    public function setOrderBy($nouvelOrdre)
    {
        $this->orderBy = $nouvelOrdre;
    }

    public function fetchAll()
    {
        $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->orderBy LIMIT $this->limit OFFSET $this->offset";

        return $this->query($query);
    }


    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "SELECT * FROM $this->table WHERE  ";
        foreach ($keys as $key) {
            $query .= "$key = :$key AND ";
        }
        foreach ($keys_not as $key) {
            $query .= "$key != :$key AND ";
        }

        $query = rtrim($query, ' AND ') . " ORDER BY $this->order_column $this->orderBy LIMIT $this->limit OFFSET $this->offset ";

        $data = array_merge($data, $data_not);


        return $this->query($query, $data);
    }



    public function count($data = [])
    {
        $query = "SELECT COUNT(*) AS count FROM $this->table ";

        if (!empty($data)) {
            $keys = array_keys($data);

            $query .= " WHERE ";

            foreach ($keys as $key) {
                $query .= "$key = :$key AND ";
            }
        }

        $query = rtrim($query, ' AND ');

        $result = $this->query($query, $data);

        return $result[0]['count'];
    }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "SELECT * FROM $this->table WHERE ";
        foreach ($keys as $key) {
            $query .= "$key = :$key AND ";
        }
        foreach ($keys_not as $key) {
            $query .= "$key != :$key AND ";
        }

        $query = rtrim($query, ' AND ') . " LIMIT $this->limit OFFSET $this->offset";

        $data = array_merge($data, $data_not);

        $result = $this->query($query, $data);

        if ($result) {
            return $result[0];
        }

        return false;
    }

    public function insert($data)
    {
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (:" . implode(", :", $keys) . ")";
        $this->query($query, $data);

        return false;
    }

    public function update($id, $data, $id_column = "id")
    {
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";
        foreach ($keys as $key) {
            $query .= "$key = :$key, ";
        }

        $query = rtrim($query, ', ') . " WHERE $id_column = :$id_column";

        $data[$id_column] = $id;
        $this->query($query, $data);

        return false;
    }

    public function delete($id, $id_column = 'id')
    {
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
        $data[$id_column] = $id;

        $this->query($query, $data);

        return false;
    }
}