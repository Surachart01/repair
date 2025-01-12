<?php 
try {
    include("../include/connect.php");
    $userId = $_POST['userId'];
    $password = $_POST['password'];
    $encryptPassword = md5($password);
    $sql = "UPDATE users SET password = '$encryptPassword' WHERE id = $userId";
    $q = $db->query($sql);
    if ($q) {
        echo json_encode(['status' => '200', 'message' => 'success']);
    } else {
        echo json_encode(['status' => '400', 'message' => 'fail']);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500', 'message' => "Internal Server Error : $th"]); 
}

?>