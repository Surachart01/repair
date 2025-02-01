<?php
try {
    include("../../include/connect.php");

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $department = $_POST['department'];

    $sql = "UPDATE employee SET firstName = '$firstName' , lastName = '$lastName' , username = '$userName'
    ,department = '$department'";
    $qSql = $db->query($sql);
    if ($qSql) {
        echo json_encode(['status' => '200', 'message' => 'edit employee success']);
    } else {
        echo json_encode(['status' => '402', 'message' => 'cannot edit']);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500', 'message' => "$th"]);
}
