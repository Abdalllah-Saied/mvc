<?php

class DB
{
    public $con;

    public function __construct($database, $host, $dbname, $username, $password)
    {
        $this->con = new PDO("$database:host=$host;dbname=$dbname", "$username", "$password");
    }

//todo select
    public function select($table)
    {
        $query = "SELECT * from $table";
        $sql = $this->con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

//todo delete


    public function delete($table, $cond)
    {
        $key = array_keys($cond)[0];
        $value = $cond[$key];
        $query = "DELETE FROM $table WHERE $key = $value";
        echo $query;
        $sql = $this->con->prepare($query);
        return $sql->execute();
    }

//todo insert

    public function insert($table, $data)
    {
// $query = "INSERT INTO $table(name, email, password, age, GPA, image) VALUES ('[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
        $query = "INSERT INTO $table(";
        foreach ($data as $key => $value) {
            $query .= "$key ,";
        }
//? substr
        $query = substr($query, 0, -1);
        $query .= ") VALUES (";

        foreach ($data as $key => $value) {
            $query .= "'$value' ,";
        }
        $query = substr($query, 0, -1);
        $query .= ")";


        $sql = $this->con->prepare($query);
        return $sql->execute();
    }

    public function update($table, $data, $id)
    {

        $query = "UPDATE $table SET  ";
        foreach ($data as $key => $value) {
            $query .= "$key= '$value' ,";
        }
//? substr
        $query = substr($query, 0, -1);
        $query .= "WHERE id=$id";
        echo $query;

        $sql = $this->con->prepare($query);

        return $sql->execute();
    }


}