<?php
try {
    include("../../include/connect.php");

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sqlEmail = "SELECT * FROM admin WHERE email = '$email'";
    $qEmail = $db->query($sqlEmail);
    if ($qEmail->num_rows == 0) {

        $newPassword = password_hash($password, PASSWORD_DEFAULT);

        $sqlGetMaxAdminId = "SELECT MAX(adminId) as maxAdminId FROM admin";
        $qGetMaxAdminId = $db->query($sqlGetMaxAdminId);
        $row = $qGetMaxAdminId->fetch_assoc();
        $maxAdminId = $row['maxAdminId'];

        if ($maxAdminId) {
            $newAdminIdNum = (int)substr($maxAdminId, 1) + 1;
            $newAdminId = 'A' . str_pad($newAdminIdNum, 3, '0', STR_PAD_LEFT);
        } else {
            $newAdminId = 'A001';
        }
        $sqlInsert = "INSERT INTO admin (adminId,firstName,lastName,email,password) VALUES ('$newAdminId','$firstName','$lastName','$email','$newPassword')";
        $qInsert = $db->query($sqlInsert);
        if ($qInsert) {
            echo json_encode(['status' => '200', 'message' => 'add Admin success']);
        } else {
            echo json_encode(['status' => '400', 'message' => 'cannot add Admin']);
        }
    }else{
        echo json_encode(['status' => '402', 'message' => 'email is already']);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500', 'message' => "$th"]);
}
