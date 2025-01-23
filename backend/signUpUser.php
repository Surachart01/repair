<?php  
try {
    include("../include/connect.php");
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $department = $_POST['department'];

    $sqlCheckEmail = "SELECT * FROM employee WHERE username = '$userName'";
    $qCheckEmail = $db->query($sqlCheckEmail);
    if($qCheckEmail->num_rows != 0){
        echo json_encode(['status' => '403' , 'message' => 'Username is match in database']);
    }else{
        
        $sqlGetMaxEmpId = "SELECT MAX(empId) as maxEmpId FROM employee";
        $qGetMaxEmpId = $db->query($sqlGetMaxEmpId);
        $row = $qGetMaxEmpId->fetch_assoc();
        $maxEmpId = $row['maxEmpId'];
        
        if ($maxEmpId) {
            $newEmpIdNum = (int)substr($maxEmpId, 1) + 1;
            $newEmpId = 'E' . str_pad($newEmpIdNum, 3, '0', STR_PAD_LEFT);
        } else {
            $newEmpId = 'E001';
        }
        $passwordEncrypt = md5($password);
        $sqlAddUser = "INSERT INTO employee (empId ,firstName , lastName , username , password , department) VALUES ('$newEmpId','$firstName','$lastName','$userName','$passwordEncrypt','$department')";
        $qAddUser = $db->query($sqlAddUser);
        if($qAddUser){
            echo json_encode(['status' => '200' , 'message' => 'Insert User complate']);
        }else{
            echo json_encode(['status' => '400' , 'message' => 'connot Insert User']);
        }
        
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500' , 'message' => "$th"]);
}
    
?>