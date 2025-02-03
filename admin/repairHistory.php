<?php
include("./auth/auth.php");
include("../include/connect.php");

$sqlRepair = "SELECT * FROM repair INNER JOIN product ON product.productId = repair.productId WHERE state = '2' ";
$qRepair = $db->query($sqlRepair);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https:////cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <script src="https:////cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding: 10px 0;
            transition: ease-in-out 0.3s all;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            border-radius: 5px;
            width: 200px;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }

        .sidebar .active {
            background-color: rgb(37, 81, 128);
            color: white;
        }

        .navbar {
            background-color: #343a40;
            color: white;
        }

        #sidebarToggle:hover {
            color: rgb(253, 126, 0);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="d-flex ">
        <nav class="sidebar d-flex flex-column px-2">
            <div class="text-center my-3">
                <h4 class="text-white">ระบบแจ้งซ่อม</h4>
            </div>
            <a href="./"><i class="bi bi-house-door"></i> หน้าหลัก</a>
            <a href="./user.php"><i class="bi bi-person"></i> ผู้ใช้งาน</a>
            <a href="./repairHistory.php" class="active"><i class="bi bi-bar-chart"></i> ประวัติแจ้งซ่อม</a>
            <a href="./product.php"><i class="bi bi-gear"></i> ครุภัณฑ์</a>
            <a href="./backend/logout.php"><i class="bi bi-box-arrow-left"></i> ออกจากระบบ</a>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class=" text-light me-3 fs-4 fw-4" id="sidebarToggle"><i class="bi bi-list"></i></a>
                    <h5 class="mb-0 text-white">หน้าหลัก</h5>
                </div>
            </nav>

            <!-- Dashboard Content -->
            <div class="container px-5 my-4">
                <div class="row">
                    <div class="container">
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">วันที่</th>
                                    <th class="text-center">ชื่อวัสดุ</th>
                                    <th class="text-center">หมายเลขครุภัณฑ์</th>
                                    <th class="text-center">ประเภท</th>
                                    <th class="text-center">หน่วยงาน</th>
                                    <th class="text-center">สถานะ</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($qRepair->num_rows != 0) {
                                    while ($item = $qRepair->fetch_object()) {

                                        // $depart = $item->depart == 1 ? "ฝ่ายการเงิน" : ($item->depart == 2 ? "ฝ่ายธุรการ" : "ฝ่ายบัญชี");
                                        $state = $item->state == 0 ? "รับแจ้ง" : ($item->state == 1 ? "กำลังดำเนินการ" : "เสร็จสิ้น");
                                        $color = $item->state == 0 ? 'bg-danger' : ($item->state == 1 ? 'bg-warning' : 'bg-success');
                                ?>
                                        <tr>
                                            <td><?php echo date("d-m-Y", strtotime($item->date)); ?></td>
                                            <td><?php echo $item->productName ?></td>
                                            <td><?php echo $item->productId ?></td>
                                            <td>
                                                <?= ($item->type == "PC") ? "เครื่องคอมพิวเตอร์" : (($item->type == "Monitor") ? "หน้าจอคอมพิวเตอร์" : (($item->type == "UPS") ? "เครื่องสำรองไฟ" : (($item->type == "Printer") ? "เครื่องปริ้นเตอร์" : "ไม่ทราบประเภท"))); ?>
                                            </td>
                                            <td>
                                                <?= ($item->department == "doctor") ? "หมอ" : (($item->department == "nurse") ? "พยาบาล" : (($item->department == "finance") ? "การเงิน" : (($item->department == "accounting") ? "การบัญชี" : "ไม่ทราบแผนก"))); ?>
                                            </td>
                                            <td>
                                                <p class="text-center rounded py-1 text-light <?php echo $color ?>"><?php echo $state ?></p>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary me-2" data-id="<?php echo $item->repairId ?>" id="detail">รายละเอียด</button>
                                                <?php if ($item->state == 0) { ?>
                                                    <button class="btn btn-danger me-2" data-id="<?php echo $item->repairId ?>" id="delete">ลบ</button>
                                                    <button class="btn btn-warning" data-id="<?php echo $item->repairId ?>" id="edit">แก้ไข</button>
                                                <?php } ?>

                                                <?php
                                                if ($item->state != 2) {
                                                ?>
                                                    <button class="btn btn-success" data-id="<?php echo $item->repairId ?>" data-state="<?php echo $item->state ?>" id="state">Update State</button>

                                                <?php } ?>

                                                <a href="../pdf.php?Key=<?= $item->repairId ?>" class="btn btn-warning">
                                                    <i class="bi bi-printer"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('d-none');
        });
    </script>

    <script>
        let myTable = new DataTable("#myTable")

        $(document).on("click", "#detail", function() {
            let id = $(this).data('id');
            let formData = new FormData();
            formData.append("id", id);
            $.ajax({
                url: "./components/popupDetail.php",
                type: "POST",
                data: formData,
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        title: "รายละเอียด",
                        html: res,
                        showConfirmButton: false,
                        showCloseButton: true
                    })
                }
            })
        })
    </script>
</body>

</html>