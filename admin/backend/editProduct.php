<?php
try {
    include("../../include/connect.php");

    $key = $_POST['key'];
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $brand = $_POST['brand'];
    $department = $_POST['department'];
    $type = $_POST['type'];

    $sqlCheck = "SELECT * FROM product WHERE productId = '$productId'";
    $qCheck = $db->query($sqlCheck);
    $item = $qCheck->fetch_object();
    if ($qCheck->num_rows > 0 && $item->productId != $key) {
        echo json_encode(['status' => '402', 'message' => 'ProductId is duplicate']);
    } else {
        $sqlUpdate = "UPDATE product SET productId = '$productId' , productName = '$productName' , brand = '$brand' , department = '$department' , type = '$type' WHERE productId = '$key'";
        $qUpdate = $db->query($sqlUpdate);
        if ($qUpdate) {
            echo json_encode(['status' => '200', 'message' => 'edit Product success']);
        } else {
            echo json_encode(['status' => '400', 'message' => 'cannot Edit Product']);
        }
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => '500', 'message' => "$th"]);
}
