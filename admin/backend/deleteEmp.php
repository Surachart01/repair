<?php  
try {
    include("../../include/connect.php");

    $empId = $_POST['empId'];

    $sqlDel = "DELETE FROM employee WHERE  empId = '$empId'";
    $qDel = $db->query($sqlDel);

    if($qDel){
        echo json_encode(['status' => '200' , 'message' => 'Delete Employee Success']);
    }else{
        echo json_encode(['status' => '400' , 'message' => 'cannot DELETE employee']);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500' , 'message' => "$th"]);
}
?>