<?php
try {
session_start();
include("../include/connect.php");
$id = $_POST['id'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$userName = $_POST['userName'];
$sqlUpdateProfile = "UPDATE employee SET firstName = '$firstName', lastName = '$lastName', username = '$userName' WHERE empId = '$id'";
$qUpdateProfile = $db->query($sqlUpdateProfile);
if ($qUpdateProfile) {
    $sqlGetUser = "SELECT * FROM employee WHERE empId = '$id'";
    $qUpdateProfile = $db->query($sqlGetUser);
    $dataUser = $qUpdateProfile->fetch_object();
    $_SESSION['auth'] = $dataUser;
    echo json_encode(["status" => "200", "message" => "แก้ไขข้อมูลสำเร็จ"]);
} else {
    echo json_encode(["status" => "400", "message" => "แก้ไขข้อมูลไม่สำเร็จ"]);
}

} catch (\Throwable $th) {
echo json_encode(["status" => "500", "message" => "$th"]);
}

?>
