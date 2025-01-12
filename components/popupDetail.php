<?php
try {
    session_start();
    include("../include/connect.php");
    $id = $_POST['id'];
    $sqlProblem = "SELECT problems.* , users.firstName , users.lastName , users.tel FROM problems INNER JOIN users ON users.id = problems.userId WHERE problems.id = $id";
    $qProblem = $db->query($sqlProblem);
    $item = $qProblem->fetch_object();
    $type = $item->type == 1 ? "อุปกรณ์อิเล็กทรอนิก" : "อุปกรณ์สำนักงาน";
    $depart = $item->depart == 1 ? "ฝ่ายการเงิน" : ($item->depart == 2 ? "ฝ่ายธุรการ" : "ฝ่ายบัญชี");
    $state = $item->state == 1 ? "รับแจ้ง" : ($item->state == 2 ? "กำลังดำเนินการ" : "เสร็จสิ้น");
} catch (\Throwable $th) {
    echo $th;
}

?>
<hr>
<p class="text-start">วันที่แจ้ง : <?php echo date("d-m-Y", strtotime($item->date)); ?> </p>
<p class="text-start">ชื่อผู้แจ้งซ่อม : <?php echo $item->firstName ?> <?php echo $item->lastName ?></p>
<p class="text-start">หมายเลขครุภัณฑ์ : <?php echo $item->itemCode ?> </p>
<p class="text-start">วัสดุ : <?php echo $item->itemName ?> </p>
<p class="text-start">ประเภท : <?php echo $type ?> </p>
<p class="text-start">ฝ่าย : <?php echo $depart ?> </p>
<p class="text-start">สถานะ : <?php echo $state ?> </p>
<p class="text-start">รายละเอียด : <?php echo $item->description ?> </p>