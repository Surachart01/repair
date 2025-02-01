<?php
include("../../include/connect.php");
$productId = $_POST['productId'];

$sqlProduct = "SELECT * FROM product WHERE productId = '$productId'";
$qProduct = $db->query($sqlProduct);
$item = $qProduct->fetch_object();
?>

<form id="formEdit" data-id="<?= $item->productId?>">
    <label for="">เลขครุภัณฑ์</label>
    <input type="text" class="mb-2 form-control" value="<?= $item->productId ?>" id="productId" 
        pattern="^\d{4}-\d{3}-\d{4}-\d{4}\/\d{2}$" 
        title="กรุณาใส่หมายเลขในรูปแบบ 0000-000-0000-0000/00" required/>

    <label for="">ชื่อครุภัณฑ์</label>
    <input type="text" class="mb-2 form-control" value="<?= $item->productName ?>" id="productName" required>

    <label for="">แบรน</label>
    <input type="text" id="brand" value="<?= $item->brand ?>" class="mb-2 form-control" required>

    <label for="">แผนก</label>
    <select class="mb-2 form-select" id="department">
        <option value="doctor" <?= ($item->department == 'doctor') ? 'selected' : '' ?>>หมอ</option>
        <option value="nurse" <?= ($item->department == 'nurse') ? 'selected' : '' ?>>พยาบาล</option>
        <option value="finance" <?= ($item->department == 'finance') ? 'selected' : '' ?>>การเงิน</option>
        <option value="accounting" <?= ($item->department == 'accounting') ? 'selected' : '' ?>>การบัญชี</option>
    </select>

    <label for="">ประเภท</label>
    <select class="mb-2 form-select" id="type">
        <option value="equipment" <?= ($item->type == 'equipment') ? 'selected' : '' ?>>อุปกรณ์สำนักงาน</option>
        <option value="electronic" <?= ($item->type == 'electronic') ? 'selected' : '' ?>>อุปกรณ์อิเล็กทรอนิกส์</option>
    </select>

    <button type="submit" class="mb-2 btn btn-success form-control">แก้ไข</button>
</form>
