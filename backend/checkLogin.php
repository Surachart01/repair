<?php  
    session_start();
    include("../include/connect.php");
    $email = $_POST['email'];
    $password = $_POST['password'];

    $passwordEncrypt = md5($password);
    $sqlCheckLogin = "SELECT * FROM users WHERE email = '$email' AND password = '$passwordEncrypt'";
    $qCheckLogin = $db->query($sqlCheckLogin);
    if($qCheckLogin->num_rows != 1){
        echo json_encode(['status' => '500', 'message' => 'Internal Error']);
    }else{
        $dataUser = $qCheckLogin->fetch_object();
        $_SESSION['auth'] = $dataUser;
        echo json_encode(['status' => '200', 'message' => 'login Succesfully']);
        
    }
?>