<?php
$host="localhost";
$db="blog;charset=utf8";
$user="root";
$pass="";

try {
    
    $database=new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4",$user,$pass);
}   catch (PDOException $ex) {
    die("Erreur:" . $ex->getMessage());
}