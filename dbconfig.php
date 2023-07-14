<?php
include  "constant.php";

$servername = servername;
$username = username;
$password =passwd;
$db =  dbname;

try{
$conn = new PDO("mysql:host=".$servername.";dbname=".$db, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    echo "Connection err: ". $e->getMessage();
}