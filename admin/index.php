<?php 
    // include("./auth/auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
            background-color:rgb(37, 81, 128);
            color: white;
        }
        .navbar {
            background-color: #343a40;
            color: white;
        }
        #sidebarToggle:hover{
            color:rgb(253, 126, 0);
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
            <a href="./" class="active"><i class="bi bi-house-door"></i> หน้าหลัก</a>
            <a href="./user.php" ><i class="bi bi-person"></i> ผู้ใช้งาน</a>
            <a href="./repairHistory.php"><i class="bi bi-bar-chart"></i> ปวะวัติแจ้งซ่อม</a>
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
            <div class="container my-4">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card text-white bg-primary shadow">
                            <div class="card-body">
                                <h5 class="card-title">จำนวนพนักงานทั้งหมด</h5>
                                <p class="card-text">1,234 คน</p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 ">
                        <div class="card text-white bg-success shadow">
                            <div class="card-body">
                                <h5 class="card-title">จำนวน Admin ทั้งหมด</h5>
                                <p class="card-text">12,345 คน</p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card text-dark bg-warning shadow">
                            <div class="card-body">
                                <h5 class="card-title">แจ้งซ่อมครุภัณฑ์ (ยังไม่เสร็จ)</h5>
                                <p class="card-text">567 รายการ</p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card text-white bg-danger shadow">
                            <div class="card-body">
                                <h5 class="card-title">แจ้งซ่อมครุภัณฑ์ (เสร็จแล้ว)</h5>
                                <p class="card-text">123 รายการ</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('d-none');
        });
    </script>
</body>
</html>
