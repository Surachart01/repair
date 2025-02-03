<?php  
    try {
        session_start();
        // $dataUser = $_SESSION['auth'];
        include("../../include/connect.php");
        $id = $_POST['id'];
        $state = $_POST['state'];
        $state = $state == "0" ? "1" : ($state == "1" ? "2" : "0");
        $date = date('Y-m-d');
        $sqlUpdateProblem = "UPDATE repair SET state = '$state' WHERE repairId = '$id'";
        $qUpdateProblem = $db->query($sqlUpdateProblem);   
        if($state == 2){
            $sqlDateEnd = "UPDATE repair SET dateEnd = '$date' WHERE repairId = '$id'";
            $qDateEnd = $db->query($sqlDateEnd);
        }
        if($qUpdateProblem){
            $sqlProblem = "SELECT * FROM repair WHERE repairId = '$id'";
            $qProblem = $db->query($sqlProblem);
            $problem = $qProblem->fetch_object();
            $sqlEmp = "SELECT * FROM employee WHERE empId = '$problem->empId'";
            $qEmp = $db->query($sqlEmp);
            $dataUser = $qEmp->fetch_object();
            echo json_encode(["status" => "200", "message" => "แก้ไขสถานะปัญหาสำเร็จ", "dataProblem" => $problem, "dataUser" => $dataUser, "state" => $state]);
        }else{
            echo json_encode(["status" => "400", "message" => "แก้ไขสถานะปัญหาไม่สำเร็จ"]);
        }
    } catch (\Throwable $th) {
        echo json_encode(["status" => "500", "message" => "$th"]);
    }

?>