<?php
include("../../include/connect.php");
$sqlEmp = "SELECT * FROM employee";
$qEmp = $db->query($sqlEmp);
?>

    <thead>
        <tr>
            <th>รหัสพนักงาน</th>
            <th>Username</th>
            <th>ชื่อจริง</th>
            <th>นามสกุล</th>
            <th>แผนก</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($item = $qEmp->fetch_object()) {
        ?>
            <tr>
                <td><?= $item->empId ?></td>
                <td><?= $item->username ?></td>
                <td><?= $item->firstName ?></td>
                <td><?= $item->lastName ?></td>
                <td><?php echo ($item->department == '1')?'ศัลยกรรมหญิง':(($item->department == '2')?'ศัลยกรรมชาย':(($item->department == '3')?'การเงิน':'ห้องฉุกเฉิน')) ?></td>
                <td>
                <button class="btn btn-warning bt-edit-emp" data-id="<?= $item->empId?>">แก้ไข</button>
                <button class="btn btn-danger bt-del-emp" data-id="<?= $item->empId?>">ลบ</button>
            </td>
            </tr>
        <?php
        }
        ?>
    </tbody>