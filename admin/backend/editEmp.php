<?php
try {
    include("../../include/connect.php");
    $empId = $_POST['empId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $department = $_POST['department'];
    $email = $_POST['email'];

    $sql = "UPDATE employee SET firstName = '$firstName' , lastName = '$lastName' , username = '$userName '
    ,department = '$department' , email = '$email' WHERE empId = '$empId'";
    $qSql = $db->query($sql);
    if ($qSql) {
        echo json_encode(['status' => '200', 'message' => 'edit employee success']);
    } else {
        echo json_encode(['status' => '402', 'message' => 'cannot edit']);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500', 'message' => "$th"]);
}
