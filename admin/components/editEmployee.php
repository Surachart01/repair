<?php  
    include("../../include/connect.php");

    $empId = $_POST['empId'];
    $sql = "SELECT * FROM employee WHERE empId = '$empId'";
    $qSql = $db->query($sql);

    $item = $qSql->fetch_object();
?>

<form id="formEditEmp" data-id="<?=$empId ?>">
<label for="">ชื่อจริง</label>
<input type="text" class="form-control" value="<?= $item->firstName ?>" required id="firstName">
<label for="">นามสกุล</label>
<input type="text" class="form-control" value="<?= $item->lastName ?>" required id="lastName">
<label for="">Username</label>
<input type="text" class="form-control" value="<?= $item->username ?>" required id="userName">
<label for="">แผนก</label>
<select name="" id="department" required class="form-select">
    <option selected>โปรดเลือกแผนก</option>
    <?php
    $departments = [
        "1" => "ศัลยกรรมหญิง",
        "2" => "ศัลยกรรมชาย",
        "3" => "การเงิน",
        "4" => "ห้องฉุกเฉิน"
    ];

    foreach ($departments as $value => $label) {
        $selected = ($item->department == $value) ? 'selected' : '';
        echo "<option value=\"$value\" $selected>$label</option>";
    }
    ?>
</select>
<label for="">อีเมล</label>
<input type="email" class="form-control" value="<?= $item->email ?>" required id="email">
<button type="submit" class="btn btn-success mt-2 form-control" id="btnEditEmp">เพิ่มพนักงาน</button>
</form>
