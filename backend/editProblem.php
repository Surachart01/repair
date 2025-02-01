<?php 
    try {
        session_start();
        include("../include/connect.php");
        $id = $_POST['id'];
        $email = $_POST['email'];
        $description = $_POST['description'];

        $updateProblem = "UPDATE repair SET description = '$description' , email = '$email' WHERE repairId = '$id'";
        $qUpdateProblem = $db->query($updateProblem);
        if($qUpdateProblem){
            echo json_encode(['status' => '200', 'message' => 'Update Problem Successfully']);
        }else{
            echo json_encode(['status' => '400', 'message' => 'Update Problem Unsuccessfully']);
        }
    } catch (\Throwable $th) {
        echo json_encode(['status' => '500', 'message' => "$th"]);
    }
?>