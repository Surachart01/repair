<?php
include("../../include/connect.php");
$sqlEmp = "SELECT * FROM admin";
$qEmp = $db->query($sqlEmp);
?>

<thead>
    <tr>
        <th>รหัสพนักงาน</th>
        <th>ชื่อจริง</th>
        <th>นามสกุล</th>
        <th>email</th>
        <th></th>
    </tr>
</thead>
<tbody>
    <?php
    while ($item = $qEmp->fetch_object()) {
    ?>
        <tr>
            <td><?= $item->adminId ?></td>
            <td><?= $item->firstName ?></td>
            <td><?= $item->lastName ?></td>
            <td><?= $item->email ?></td>
            <td>
                <button class="btn btn-warning bt-edit-admin" data-id="<?= $item->adminId?>">แก้ไข</button>
                <button class="btn btn-danger bt-del-admin" data-id="<?= $item->adminId?>">ลบ</button>
            </td>
        </tr>
    <?php
    }
    ?>
</tbody>