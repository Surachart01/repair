<?php  
try {
    include("../../include/connect.php");
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sqlLogin = "SELECT * FROM admin WHERE email = '$email'";
    $qLogin = $db->query($sqlLogin);
    if($qLogin->num_rows == 1){
        $dataAdmin = $qLogin->fetch_object();
        if(password_verify($password,$dataAdmin->password)){
            $_SESSION['admin'] = $dataAdmin;
            echo json_encode(['status' => '200' , 'Login Success']);
        }else{
            echo json_encode(['status' => '400' , 'message' => "password is not match"]);
        }
    }else{
        echo json_encode(['status' => '400' , 'message' => "email is not defind"]);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500' , 'message' => "$th"]);
}
    
?>