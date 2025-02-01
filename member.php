<?php
session_start();
include("./include/connect.php");
if (!isset($_SESSION['auth'])) {
    if ($_SESSION['auth']->role != '9') {
        header('Location: ./send.php');
    }
}
$sqlUser = "SELECT * FROM users ";
$qUser = $db->query($sqlUser);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/member.css">
    <link rel="stylesheet" href="https:////cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
</head>

<body>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-start py-4 navbar px-5">
                <a href="send.php" class="mx-3 itemNav ">แจ้งซ่อม</a>
                <a href="report.php" class="mx-3 itemNav">รายการส่งซ่อม</a>
                <a href="profile.php" class="mx-3 itemNav ">โปรไฟล์</a>
                <?php
                if ($_SESSION['auth']->role == '9') { ?>
                    <a href="member.php" class="mx-3 itemNav navActive">ผู้ใช้งาน</a>
                <?php  }
                ?>
                <a href="./backend/signOut.php" class="mx-3 itemNav">ออกจากระบบ</a>
            </div>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <div class="container">
                    <table class="table table-responsive table-hover  " id="myTable">
                    <thead>
                        <tr>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>อีเมล</th>
                            <th>เบอร์โทร</th>
                            <th>สถานะ</th>
                            <th>แก้ไข</th>
                        </tr>
                        <tbody>
                            <?php 
                                while($item = $qUser->fetch_object()){
                                    if($item->role == 1){
                                        $state = "User";
                                        $color = "bg-success";
                                    }else if($item->role == 9){
                                        $state = "Admin";
                                        $color = "bg-warning";
                                    }else{
                                        $state = "Banned";
                                        $color = "bg-secondary";
                                    }
                            ?>
                            <tr>
                                <td><?= $item->firstName ?></td>
                                <td><?= $item->lastName ?></td>
                                <td><?= $item->email ?></td>
                                <td><?= $item->tel ?></td>
                                <td><p class="text-center rounded py-1  <?php echo $color ?>"><?php echo $state ?></p></td>
                                <td>
                                    <button class="btn btn-secondary " id="password" data-id="<?= $item->id ?>" >รหัสผ่าน</button>
                                    <button class="btn btn-warning" id="edit" data-id="<?= $item->id ?>">ข้อมูล</button>
                                    <button class="btn btn-primary" id="role" data-id="<?= $item->id ?>">สถานะ</button>
                                    <button class="btn btn-danger" id="delete" data-id="<?= $item->id ?>">ลบ</button>
                                </td>
                            </tr>
                            <?php  
                                }
                            ?>
                        </tbody>
                    </thead>
                </table>
                </div>
                
            </div>
        </div>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https:////cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            let table = new DataTable('#myTable');
            $(document).on("click","#password",function(){
                let id = $(this).data('id');
                Swal.fire({
                    icon: 'info',
                    title: 'แก้ไขรหัสผ่าน',
                    text: 'รหัสผ่านของผู้ใช้งาน',
                    input: 'password',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'ตกลง',
                    showLoaderOnConfirm: true,
                    preConfirm: (password) => {
                        $.ajax({
                            url: './backend/editPassword.php',
                            type: 'POST',
                            data: {
                                password: password,
                                userId : id
                                
                            },
                            success: function(res) {
                                console.log(res)
                                    Swal.fire({
                                        title: `รหัสผ่านของคุณคือ ${password}`,
                                        icon: 'success',
                                        timer : 2000,
                                        showConfirmButton: false
                                    })
                            }
                        })
                    },
                })
            })
        </script>

</body>

</html>