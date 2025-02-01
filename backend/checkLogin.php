<?php  
try {
    session_start();
    include("../include/connect.php");
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $passwordEncrypt = md5($password);
    $sqlCheckLogin = "SELECT * FROM employee WHERE username = '$userName' AND password = '$passwordEncrypt'";
    $qCheckLogin = $db->query($sqlCheckLogin);
    if($qCheckLogin->num_rows != 1){
        echo json_encode(['status' => '400', 'message' => 'Unknow User']);
    }else{
        $dataUser = $qCheckLogin->fetch_object();
        $_SESSION['auth'] = $dataUser;
        echo json_encode(['status' => '200', 'message' => 'login Succesfully']);
        
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500', 'message' => "$th"]);
}
    
?>