<?php

//namespace Controllers;

//use Models\DB;

class HomeController
{
    public function index($r)
    {
        $con = new DB('mysql','localhost','mvc','root','1234');
        $r = $con->select('books');
//        var_dump($r);
//        $host = 'localhost';
//        $dbname = 'mvc';
//        $username = 'root';
//        $password = '1234';
//        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//        $stmt = $pdo->prepare('SELECT * FROM books');
//        $r = $stmt->execute();
//        $r = $stmt->fetchAll();



        View::load('home', ['name' => 'Home Page', 'data' => $r, 'title' => 'Home Page']);

    }

}