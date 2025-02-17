<?php
include("./auth/auth.php");
include("../include/connect.php");

$sqlProduct = "SELECT * FROM product ";
$qProduct = $db->query($sqlProduct);

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
            <a href="./repairHistory.php"><i class="bi bi-bar-chart"></i> ประวัติแจ้งซ่อม</a>
            <a href="./product.php" class="active"><i class="bi bi-gear"></i> ครุภัณฑ์</a>
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
                    <button class="btn btn-primary form-control" id="insert">เพิ่มครุภัณฑ์</button>
                    <hr />
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>หมายเลขครุภัณฑ์</th>
                                <th>ชื่อครุภัณฑ์</th>
                                <th>ยี่ห้อ</th>
                                <th>แผนก</th>
                                <th>ประเภท</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($item = $qProduct->fetch_object()) {
                            ?>
                                <tr>
                                    <td><?= $item->productId ?></td>
                                    <td><?= $item->productName ?></td>
                                    <td><?= $item->brand ?></td>
                                    <td>
                                    <?php echo ($item->department == '1')?'ศัลยกรรมหญิง':(($item->department == '2')?'ศัลยกรรมชาย':(($item->department == '3')?'การเงิน':'ห้องฉุกเฉิน')) ?>
                                    </td>

                                    <td>
                                        <?= ($item->type == "PC") ? "เครื่องคอมพิวเตอร์" : (($item->type == "Monitor") ? "หน้าจอคอมพิวเตอร์" : (($item->type == "UPS") ? "เครื่องสำรองไฟ" : (($item->type == "Printer") ? "เครื่องปริ้นเตอร์" : "ไม่ทราบประเภท"))); ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" data-id="<?= $item->productId ?>" id="edit">แก้ไข</button>
                                        <button class="btn btn-danger" data-id="<?= $item->productId ?>" id="delete">ลบ</button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
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

        $(document).on("click", "#insert", function() {
            $.ajax({
                url: "./components/insertProduct.php",

                dataType: 'html',
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        title: "เพิ่มครุภัณฑ์",
                        showConfirmButton: false,
                        html: res
                    })
                }
            })
        })

        $(document).on("click", "#edit", function() {
            let productId = $(this).data("id")
            let formData = new FormData()
            formData.append("productId", productId)
            $.ajax({
                url: "./components/editProduct.php",
                type: "POST",
                data: formData,
                dataType: 'html',
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        title: "แก้ไขครุภัณฑ์",
                        showConfirmButton: false,
                        html: res
                    })
                }
            })
        })

        $(document).on("submit", "#formEdit", function(e) {
            e.preventDefault()
            let key = $(this).data("id");
            let productId = $('#productId').val()
            let productName = $('#productName').val()
            let brand = $('#brand').val()
            let department = $('#department').val()
            let type = $('#type').val()
            let formData = new FormData()

            formData.append("key", key)
            formData.append("productId", productId)
            formData.append("productName", productName)
            formData.append("brand", brand)
            formData.append("department", department)
            formData.append("type", type)

            $.ajax({
                url: "./backend/editProduct.php",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == '200') {
                        Swal.fire({
                            title: "แก้ไขครุภัณฑ์เสร็จสิ้น",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload()
                        })
                    } else {
                        console.log(res)
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // window.location.reload()
                        })
                    }
                }
            })

            $.ajax({
                url: "./backend/editProduct.php",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == '200') {
                        Swal.fire({
                            title: "เพิ่มครุภัณฑ์เสร็จสิ้น",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload()
                        })
                    } else if (res.status == '402') {
                        Swal.fire({
                            title: "มีเลขครุภัณฑ์ในระบบอยู่แล้ว",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload()
                        })
                    } else {
                        console.log(res)
                        Swal.fire({
                            title: "เกิดข้อผิดพลาดโปรดลองอีกครั้ง",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // window.location.reload()
                        })
                    }
                }
            })
        })

        $(document).on("submit", "#formInsert", function(e) {
            e.preventDefault()
            let productId = $('#productId').val()
            let productName = $('#productName').val()
            let brand = $('#brand').val()
            let department = $('#department').val()
            let type = $('#type').val()
            let formData = new FormData()
            formData.append("productId", productId)
            formData.append("productName", productName)
            formData.append("brand", brand)
            formData.append("department", department)
            formData.append("type", type)

            $.ajax({
                url: "./backend/insertProduct.php",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == '200') {
                        Swal.fire({
                            title: "เพิ่มครุภัณฑ์เสร็จสิ้น",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload()
                        })
                    } else if (res.status == '402') {
                        Swal.fire({
                            title: "มีเลขครุภัณฑ์ในระบบอยู่แล้ว",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload()
                        })
                    } else {
                        console.log(res)
                        Swal.fire({
                            title: "เกิดข้อผิดพลาดโปรดลองอีกครั้ง",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // window.location.reload()
                        })
                    }
                }
            })

        })

        $(document).on("click", "#delete", function() {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณจะไม่สามารถย้อนกลับได้!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    let productId = $(this).data('id');
                    $.ajax({
                        url: './backend/deleteProduct.php',
                        type: 'POST',
                        data: {
                            productId: productId
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response)
                            if (response.status == '200') {
                                Swal.fire({
                                    title: 'ลบแล้ว!',
                                    text: 'ข้อมูลของคุณถูกลบแล้ว.',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'เกิดข้อผิดพลาด!',
                                    text: 'ไม่สามารถลบข้อมูลได้.',
                                    icon: 'error',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        }
                    })
                }
            })
        })
    </script>
</body>

</html>