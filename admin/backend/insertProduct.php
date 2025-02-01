<?php  
try {
    include("../../include/connect.php");
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $brand = $_POST['brand'];
    $department = $_POST['department'];
    $type = $_POST['type'];

    $sqlCheck = "SELECT * FROM product WHERE productId = '$productId'";
    $qCheck = $db->query($sqlCheck);
    $rCheck = $qCheck->num_rows;
    if($rCheck > 0){
        echo json_encode(['status' => '402' , 'message' => 'Primary id Duplicate']);
    }else{
        $sqlInsert = "INSERT INTO product (productId,productName,brand,department,type) VALUES ('$productId','$productName','$brand','$department','$type')";
        $qInsert = $db->query($sqlInsert);
        if($qInsert){
            echo json_encode(['status' => '200' , 'message' => 'Insert Success']);
        }else{
            echo json_encode(['status' => '400' , 'message' => 'Cannot Insert Product']);
        }
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500' , 'message' => "$th"]);
}
    
?>