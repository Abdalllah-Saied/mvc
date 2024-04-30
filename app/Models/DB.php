<?php

//namespace Models;

class DB extends PDO
{

    public function __construct()
    {
        parent::__construct('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    public function select($sql, $data = array())
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetchAll();
    }

    public function insert($table, $data)
    {
        $keys = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        $stmt = $this->prepare($sql);
        $stmt->execute(array_values($data));
        return $this->lastInsertId();
    }

    public function update($table, $data, $where)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key=?,";
        }
        $set = rtrim($set, ',');
        $sql = "UPDATE $table SET $set WHERE $where";
        $stmt = $this->prepare($sql);
        $stmt->execute(array_values($data));
        return $stmt->rowCount();
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function query($sql, $data = array())
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function count($table, $where = '')
    {
        $sql = "SELECT COUNT(*) FROM $table";
        if ($where) {
            $sql .= " WHERE $where";
        }
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function lastId()
    {
        return $this->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->beginTransaction();
    }

    public function endTransaction()
    {
        return $this->commit();
    }

    public function cancelTransaction()
    {
        return $this->rollBack();
    }

}