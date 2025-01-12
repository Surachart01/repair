<?php
try {
session_start();
include("../include/connect.php");
$id = $_POST['id'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$sqlUpdateProfile = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', email = '$email', tel = '$phone' WHERE id = $id";
$qUpdateProfile = $db->query($sqlUpdateProfile);
if ($qUpdateProfile) {
    $sqlGetUser = "SELECT * FROM users WHERE id = $id";
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
