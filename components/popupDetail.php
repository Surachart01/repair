<?php
try {
    session_start();
    include("../include/connect.php");
    $id = $_POST['id'];
    $sqlProblem = "SELECT * FROM repair INNER JOIN employee ON employee.empId = repair.empId INNER JOIN product ON product.productId = repair.productId  WHERE repair.repairId = '$id'";
    $qProblem = $db->query($sqlProblem);
    $item = $qProblem->fetch_object();
    // $type = $item->type == 1 ? "อุปกรณ์อิเล็กทรอนิก" : "อุปกรณ์สำนักงาน";
    // $depart = $item->depart == 1 ? "ฝ่ายการเงิน" : ($item->depart == 2 ? "ฝ่ายธุรการ" : "ฝ่ายบัญชี");
    $state = $item->state == 0 ? "รับแจ้ง" : ($item->state == 1 ? "กำลังดำเนินการ" : "เสร็จสิ้น");
} catch (\Throwable $th) {
    echo $th;
}

?>
<hr>
<p class="text-start">เลขที่แจ้ง : <?php echo $item->repairId ?> </p>
<p class="text-start">วันที่แจ้ง : <?php echo date("d-m-Y", strtotime($item->date)); ?> </p>
<p class="text-start">ชื่อผู้แจ้งซ่อม : <?php echo $item->firstName ?> <?php echo $item->lastName ?></p>
<p class="text-start">หมายเลขครุภัณฑ์ : <?php echo $item->productId ?> </p>
<p class="text-start">วัสดุ : <?php echo $item->productName ?> </p>
<p class="text-start">ประเภท : <?php echo $item->type ?> </p>
<p class="text-start">แผนก : <?php echo ($item->department == '1')?'ศัลยกรรมหญิง':(($item->department == '2')?'ศัลยกรรมชาย':(($item->department == '3')?'การเงิน':'ห้องฉุกเฉิน')) ?> </p>
<p class="text-start">สถานะ : <?php echo $state ?> </p>
<p class="text-start">รายละเอียด : <?php echo $item->description ?> </p>
<p class="text-start">อีเมลที่แจ้งเตือน : <?php echo $item->email ?> </p>