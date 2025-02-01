<?php  
    try {
        session_start();
        $emp = $_SESSION['auth'];
        include("../include/connect.php");
        $productId = $_POST['productId'];
        $sql = "SELECT * FROM product WHERE productId = '$productId' AND department = '$emp->department'";
        $qSql = $db->query($sql);
        if($qSql->num_rows > 0){
            $sqlCheck = "SELECT * FROM repair WHERE productId = '$productId' AND state != 3";
            $qCheck = $db->query($sqlCheck);
            if($qCheck->num_rows <= 0){
                $data = $qSql->fetch_object();
                echo json_encode(['status' => '200' , 'data' => [$data]]);
            }else{
                echo json_encode(['status' => '400' , 'message' => "Product is repairing"]);
            }
            
        }else{
            echo json_encode(['status' => '400' , 'message' => "Not found"]);
        }
        

    } catch (\Throwable $th) {
        echo json_encode(['status' => '500' , 'message' => "$th"]);
    }
?>