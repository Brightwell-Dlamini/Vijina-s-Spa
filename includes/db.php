<?php 
//$DSN="mysql:host=localhost; dbname=musicwetfu";
//$connectingDB = new PDO($DSN, 'root','');
$connectingDB = new mysqli("localhost", "root", "", "cartsystem");
if($connectingDB->connect_error){
    die("connection failed!".$connectingDB->connect_error);
}
?>