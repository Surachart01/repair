<?php
include("./auth/auth.php");
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
            background-color: #343a40;
            padding: 10px 0;
            transition: ease-in-out 0.3s all;
            height: 100%;
            min-height: 100vh;
            flex-shrink: 0;

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
    <div class="d-flex h-100">
        <nav class="sidebar d-flex flex-column flex-shrink-0 px-2">
            <div class="text-center my-3">
                <h4 class="text-white">ระบบแจ้งซ่อม</h4>
            </div>
            <a href="./"><i class="bi bi-house-door"></i> หน้าหลัก</a>
            <a href="./user.php" class="active"><i class="bi bi-person"></i> ผู้ใช้งาน</a>
            <a href="./repairHistory.php"><i class="bi bi-bar-chart"></i> ประวัติแจ้งซ่อม</a>
            <a href="./product.php"><i class="bi bi-gear"></i> ครุภัณฑ์</a>
            <a href="./backend/logout.php"><i class="bi bi-box-arrow-left"></i> ออกจากระบบ</a>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class=" text-light me-3 fs-4 fw-4" id="sidebarToggle"><i class="bi bi-list"></i></a>
                    <h5 class="mb-0 text-white">ผู้ใช้งาน</h5>
                </div>
            </nav>

            <!-- Dashboard Content -->
            <div class="container my-4">
                <label for="">โปรดเลือกสถานะ : </label>
                <div class="d-flex">
                    <button class="btn btn-primary w-50 mx-1" id="employee">พนักงาน</button>
                    <button class="btn btn-warning w-50 mx-1" id="admin">admin</button>
                </div>
                <hr />
                <div class="content" style="overflow-y: scroll;">
                    <div class="d-flex">
                        <button class="btn btn-outline-primary me-2" id="addEmp">เพิ่มผู้ใช้งาน</button>
                        <button class="btn btn-outline-danger me-2" id="addAdmin">เพิ่มAdmin</button>
                    </div>

                    <table id="myTable">
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

        $(document).on("click", ".bt-del-admin", function() {

            console.log("hh")
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
                    let adminId = $(this).data('id');
                    $.ajax({
                        url: './backend/deleteAdmin.php',
                        type: 'POST',
                        data: {
                            adminId: adminId
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

        $(document).on("click", ".bt-del-emp", function() {

            console.log("hh")
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
                    let empId = $(this).data('id');
                    $.ajax({
                        url: './backend/deleteEmp.php',
                        type: 'POST',
                        data: {
                            empId: empId
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

        // edit admin
        $(document).on("click", "#btnEditAdmin", function() {
            let adminId = $(this).data('id');
            let firstName = $('#firstName').val()
            let lastName = $('#lastName').val()
            let email = $('#email').val()
            let formData = new FormData()
            formData.append("firstName", firstName)
            formData.append("lastName", lastName)
            formData.append("email", email)

            $.ajax({
                url: "./backend/editAdmin.php",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == '200') {
                        Swal.fire({
                            title: "แก้ไขข้อมูล Admin เสร็จสิ้น",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.reload()
                        })
                    } else {
                        Swal.fire({
                            title: "ไม่สามารถแก้ไขข้อมูล Admin ได้",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.reload()
                        })
                    }
                }
            })
        })

        // component edit employee 
        $(document).on("click", ".bt-edit-emp", function() {
            let empId = $(this).data("id")
            let formData = new FormData();
            formData.append("empId", empId)

            $.ajax({
                url: "./components/editEmployee.php",
                type: "POST",
                data: formData,
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res)
                    Swal.fire({
                        title: "แก้ไขข้อมูล",
                        html: res,
                        showConfirmButton: false
                    })
                }
            })
        })

        // component edit employee 
        $(document).on("click", ".bt-edit-admin", function() {
            let adminId = $(this).data("id")
            let formData = new FormData();
            console.log(adminId)
            formData.append("adminId", adminId)

            $.ajax({
                url: "./components/editAdmin.php",
                type: "POST",
                data: formData,
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res)
                    Swal.fire({
                        title: "แก้ไขข้อมูล",
                        html: res,
                        showConfirmButton: false
                    })
                }
            })
        })

        //ดึงตารางแสดงEmployee
        $(document).on("click", "#employee", function() {
            $.ajax({
                url: "./components/employeeList.php",
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    $("#myTable").html(res)
                }
            })
        })

        //ดึงตารางแสดง Admin
        $(document).on("click", "#admin", function() {
            $.ajax({
                url: "./components/adminList.php",
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    $("#myTable").html(res)
                }
            })
        })

        //ดึงcomponent Insert Employee
        $(document).on("click", "#addEmp", function() {
            $.ajax({
                url: "./components/insertEmp.php",
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        title: "เพิ่มพนักงาน",
                        html: res,
                        showConfirmButton: false
                    })
                }
            })
        })

        //ดึงcomponent Insert Admin
        $(document).on("click", "#addAdmin", function() {
            $.ajax({
                url: "./components/insertAdmin.php",
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        title: "เพิ่มAdmin",
                        html: res,
                        showConfirmButton: false
                    })
                }
            })
        })

        $(document).on("submit", "#formEditEmp", function(e) {
            e.preventDefault()
            let firstName = $('#firstName').val();
            let lastName = $('#lastName').val();
            let userName = $('#userName').val();
            let department = $('#department').val();
            let formData = new FormData();
            formData.append("firstName", firstName);
            formData.append("lastName", lastName);
            formData.append("userName", userName);
            formData.append("department", department);

            $.ajax({
                url: "./backend/editEmp.php",
                type: "post",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == '200') {
                        Swal.fire({
                            title: "แก้ไขข้อมูลพนักงานเสร็จสิ้น",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.reload()
                        })
                    } else {
                        Swal.fire({
                            title: "เกิดข้อผิดตลาด",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.reload()
                        })
                    }

                }
            })
        })

        //submit form insert Employee
        $(document).on("submit", "#formInsertEmp", function(e) {
            e.preventDefault();
            let firstName = $('#firstName').val();
            let lastName = $('#lastName').val();
            let userName = $('#userName').val();
            let password = $('#password').val();
            let department = $('#department').val();
            let formData = new FormData();
            formData.append("firstName", firstName);
            formData.append("lastName", lastName);
            formData.append("userName", userName);
            formData.append("password", password);
            formData.append("department", department);

            $.ajax({
                url: "../backend/signUpUser.php",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == "200") {
                        Swal.fire({
                            title: "สมัครสมาชิกเสร็จสิ้น",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            // window.location.href = "signIn.php";
                        });
                    } else if (res.status == "403") {
                        Swal.fire({
                            title: "Username นี้ถูกใช้ไปแล้ว",
                            icon: "error",
                            timer: 1000,
                            showConfirmButton: false,
                        });
                    } else {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง",
                            icon: "error",
                            timer: 1000,
                            showConfirmButton: false,
                        });
                    }
                }
            });
        });

        //submit form insert Admin
        $(document).on("submit", "#formInsertAdmin", function(e) {
            e.preventDefault();
            let firstName = $('#firstName').val();
            let lastName = $('#lastName').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let formData = new FormData();
            formData.append("firstName", firstName);
            formData.append("lastName", lastName);
            formData.append("email", email);
            formData.append("password", password);

            $.ajax({
                url: "./backend/addAdmin.php",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res)
                    if (res.status == "200") {
                        Swal.fire({
                            title: "สมัครสมาชิกเสร็จสิ้น",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload()
                        });
                    } else if (res.status == "402") {
                        Swal.fire({
                            title: "email นี้ถูกใช้ไปแล้ว",
                            icon: "error",
                            timer: 1000,
                            showConfirmButton: false,
                        });
                    } else {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง",
                            icon: "error",
                            timer: 1000,
                            showConfirmButton: false,
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>