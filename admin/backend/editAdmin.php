<?php
try {
    include("../../include/connect.php");

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $adminId = $_POST['adminId'];

    $sqlEdit = "UPDATE admin SET firstName = '$firstName' , lastName = '$lastName' , email = '$email' WHERE adminId = '$adminId'";
    $qEdit = $db->query($sqlEdit);
    if ($qEdit) {
        echo json_encode(['status' => '200', 'message' => 'edit admin success']);
    } else {
        echo json_encode(['status' => '400', 'message' => 'cannot edit admin']);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500', 'message' => "$th"]);
}
?>