<?php 
$host = "localhost";
$userName = "root";
$password = "";
$dbName = "repairManagement";

$db = new mysqli($host,$userName,$password,$dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 
?>
