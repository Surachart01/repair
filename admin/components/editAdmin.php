<?php 
    include("../../include/connect.php");

    $adminId = $_POST['adminId'];
    $sqlAdmin = "SELECT * FROM admin WHERE adminId = '$adminId'";
    $qAdmin = $db->query($sqlAdmin);
    $item = $qAdmin->fetch_object();
?>
<label for="">ชื่อจริง</label>
<input type="text" class="form-control" required value="<?= $item->firstName?>" id="firstName">
<label for="">นามสกุล</label>
<input type="text" class="form-control" required value="<?= $item->lastName  ?>" id="lastName">
<label for="">email</label>
<input type="email" class="form-control" required value="<?= $item->email?>" id="email">
<button type="submit" class="btn btn-success mt-2 form-control" id="btnEditAdmin" data-id="<?= $adminId ?>">แก้ไข Admin</button>