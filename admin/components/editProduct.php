<?php
include("../../include/connect.php");
$productId = $_POST['productId'];

$sqlProduct = "SELECT * FROM product WHERE productId = '$productId'";
$qProduct = $db->query($sqlProduct);
$item = $qProduct->fetch_object();
?>

<form id="formEdit" data-id="<?= $item->productId ?>">
    <label for="">เลขครุภัณฑ์</label>
    <input type="text" class="mb-2 form-control" value="<?= $item->productId ?>" id="productId"
        pattern="^\d{4}-\d{3}-\d{4}-\d{4}\/\d{2}$"
        title="กรุณาใส่หมายเลขในรูปแบบ 0000-000-0000-0000/00" required />

    <label for="">ชื่อครุภัณฑ์</label>
    <input type="text" class="mb-2 form-control" value="<?= $item->productName ?>" id="productName" required>

    <label for="">แบรน</label>
    <input type="text" id="brand" value="<?= $item->brand ?>" class="mb-2 form-control" required>

    <label for="">แผนก</label>
    <select class="mb-2 form-select" id="department">
        <option value="1" <?php echo ($dataProblem->department == 1) ? 'selected' : ''; ?>>ศัลยกรรมหญิง</option>
        <option value="2" <?php echo ($dataProblem->department == 2) ? 'selected' : ''; ?>>ศัลยกรรมชาย</option>
        <option value="3" <?php echo ($dataProblem->department == 3) ? 'selected' : ''; ?>>การเงิน</option>
        <option value="4" <?php echo ($dataProblem->department == 4) ? 'selected' : ''; ?>>ห้องฉุกเฉิน</option>
    </select>

    <label for="">ประเภท</label>
    <select class=" mb-2 form-select" id="type">
        <option value="PC" <?= ($item->department == 'PC') ? 'selected' : '' ?>>เครื่องคอมพิวเตอร์</option>
        <option value="Monitor" <?= ($item->department == 'Monitor') ? 'selected' : '' ?>>หน้าจอคอมพิวเตอร์</option>
        <option value="UPS" <?= ($item->department == 'UPS') ? 'selected' : '' ?>>เครื่องสำรองไฟ</option>
        <option value="Printer" <?= ($item->department == 'Printer') ? 'selected' : '' ?>>เครื่องปริ้นเตอร์</option>
    </select>

    <button type="submit" class="mb-2 btn btn-success form-control">แก้ไข</button>
</form>