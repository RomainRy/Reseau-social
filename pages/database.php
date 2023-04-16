<?php
$host="localhost";
$db="blog;charset=utf8";
$user="root";
$pass="";

try {
    //$database = new mysqli($host, $user, $pass, $db);
    $database=new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4",$user,$pass);
}   catch (PDOException $ex) {
    die("Erreur:" . $ex->getMessage());
}