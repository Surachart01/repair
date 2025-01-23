<?php
try {
    include("../include/connect.php");
    $id = $_POST['id'];
    $deleteProblem = "DELETE FROM repair WHERE repairId = '$id'";
    $qDeleteProblem = $db->query($deleteProblem);
    if ($qDeleteProblem) {
        echo json_encode(['status' => '200', 'message' => 'Delete Problem Successfully']);
    } else {
        echo json_encode(['status' => '400', 'message' => 'Internal Error']);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500', 'message' => "$th"]);
}
