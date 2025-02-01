<?php  
    try {
        session_start();
        $dataUser = $_SESSION['auth'];
        include("../include/connect.php");
        $id = $_POST['id'];
        $state = $_POST['state'];
        $state = $state == "1" ? "2" : ($state == "2" ? "3" : "0");
        $sqlUpdateProblem = "UPDATE problems SET state = '$state' WHERE id = $id";
        $qUpdateProblem = $db->query($sqlUpdateProblem);   
        if($qUpdateProblem){
            $sqlProblem = "SELECT * FROM problems WHERE id = $id";
            $qProblem = $db->query($sqlProblem);
            $problem = $qProblem->fetch_object();
            echo json_encode(["status" => "200", "message" => "แก้ไขสถานะปัญหาสำเร็จ", "dataProblem" => $problem, "dataUser" => $dataUser, "state" => $state]);
        }else{
            echo json_encode(["status" => "400", "message" => "แก้ไขสถานะปัญหาไม่สำเร็จ"]);
        }
    } catch (\Throwable $th) {
        echo json_encode(["status" => "500", "message" => "$th"]);
    }

?>