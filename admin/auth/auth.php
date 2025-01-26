<?php  
    // include("../../include/connect.php");
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location:./login.php");
    }else{
        $empData = $_SESSION['admin'];
    }
?>