<?php

//namespace Controllers;

//use Models\DB;

class HomeController
{
    public function index($r)
    {
//        $con = new DB();
//        $r = $con->select('SELECT * FROM books');
//        var_dump($r);die;
        $host = 'localhost';
        $dbname = 'mvc';
        $username = 'root';
        $password = '1234';
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $stmt = $pdo->prepare('SELECT * FROM books');
        $r = $stmt->execute();
        $r = $stmt->fetchAll();



        View::load('home', ['name' => 'Home Page', 'data' => $r, 'title' => 'Home Page']);

    }

}