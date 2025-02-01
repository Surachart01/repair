<?php
try {
    session_start();
    include("../include/connect.php");
    $productId = $_POST['productId'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $userId = $_SESSION['auth']->empId;
    $date = date("Y-m-d");

    $sqlGetMaxrepairId = "SELECT MAX(repairId) as repairId FROM repair";
    $qGetrepairId = $db->query($sqlGetMaxrepairId);
    $row = $qGetrepairId->fetch_assoc();
    $maxRepairId = $row['repairId'];

    if ($maxRepairId) {
        $newRepairIdNum = (int)substr($maxRepairId, 1) + 1;
        $newRepairId = 'N' . str_pad($newRepairIdNum, 3, '0', STR_PAD_LEFT);
    } else {
        $newRepairId = 'N0001';
    }
    $insertProblem = "INSERT INTO repair (repairId,empId,productId,description,date,state,email) VALUES ('$newRepairId','$userId','$productId','$description','$date','0','$email')";
    $qInsertProblem = $db->query($insertProblem);
    if ($qInsertProblem) {
        echo json_encode(['status' => '200', 'message' => 'Add Problem Successfully']);
    } else {
        echo json_encode(['status' => '500', 'message' => 'Internal Error']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => '500', 'message' => "$e"]);
}
