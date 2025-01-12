<?php 
    try {
        session_start();
        include("../include/connect.php");
        $id = $_POST['id'];
        $accessory = $_POST['accessory'];
        $code = $_POST['code'];
        $type = $_POST['type'];
        $department = $_POST['department'];
        $description = $_POST['description'];
        $userId = $_SESSION['auth']->id;

        $updateProblem = "UPDATE problems SET itemName = '$accessory', itemCode = '$code', type = '$type', depart = '$department', description = '$description', userId = '$userId' WHERE id = '$id'";
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