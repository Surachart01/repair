<?php  
try{
    session_start();
    include("../include/connect.php");
    $accessory = $_POST['accessory'];
    $code = $_POST['code'];
    $type = $_POST['type'];
    $department = $_POST['department'];
    $description = $_POST['description'];
    $userId = $_SESSION['auth']->id;
    $date = date("Y-m-d");

    $insertProblem = "INSERT INTO problems (itemName, itemCode, type, depart, description,userId,date) VALUES ('$accessory', '$code', '$type', '$department', '$description','$userId','$date')";
    $qInsertProblem = $db->query($insertProblem);
    if($qInsertProblem){
        echo json_encode(['status' => '200', 'message' => 'Add Problem Successfully']);
    }else{
        echo json_encode(['status' => '500', 'message' => 'Internal Error']);
    }
}catch(Exception $e){
    echo json_encode(['status' => '500', 'message' => "$e"]);
}
    
   
?>