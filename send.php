<?php  
session_start();
include("./include/connect.php");
if (!isset($_SESSION['auth'])) {
    header("Location: ./SignIn.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Send</title>
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
    <link rel="stylesheet" href="./css/send.css">
    <link rel="stylesheet" href="https:////cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
</head>

<body>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-start py-4 navbar px-5">
                <a href="send.php" class="mx-3 itemNav navActive">แจ้งซ่อม</a>
                <a href="report.php" class="mx-3 itemNav">รายการส่งซ่อม</a>
                <a href="profile.php" class="mx-3 itemNav">โปรไฟล์</a>
                <?php  
                    if($_SESSION['auth']->role == '9'){?> 
                    <a href="member.php" class="mx-3 itemNav">ผู้ใช้งาน</a> 
                    <?php  }
                ?>
                <a href="./backend/signOut.php" class="mx-3 itemNav">ออกจากระบบ</a>
            </div>
        </div>
        <div class="col-12">
            <div class="d-flex my-2 px-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-card-list my-auto" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                </svg>
                <h2 class="my-auto mx-2">รายการ ส่งซ่อม</h2>
            </div>

            <hr />
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <h4>รายละเอียดการซ่อม</h4>
                        <div class="d-flex">
                            <div class="me-3">
                                <label for="">วัสดุ</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" id="accessory" placeholder="ประเภทของวัสดุ" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="">
                                <label for="">หมายเลขเครื่อง / เลขทะเบียน</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-123" viewBox="0 0 16 16">
                                            <path d="M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75z" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" id="code" placeholder="0000-0000" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mb-2">

                            <div class="w-50">
                                <label for="">ประเภท</label>
                                <select class="form-select" id="type">
                                    <option selected>โปรดเลือกประเภท</option>
                                    <option value="1">อุปกรณ์อิเล็กทรอนิก</option>
                                    <option value="2">อุปกรณ์สำนักงาน</option>
                                </select>
                            </div>

                            <div class="w-50">
                                <label for="">หน่วยงาน</label>
                                <select class="form-select" id="department">
                                    <option selected>เลือกหน่วยงาน</option>
                                    <option value="1">ฝ่ายการเงิน</option>
                                    <option value="2">ฝ่ายธุรการ</option>
                                    <option value="3">ฝ่ายการบัญชี</option>
                                </select>
                            </div>

                        </div>
                        <div class="">
                            <label for="">หมายเหตุ</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2" />
                                    </svg>
                                </span>
                                <textarea class="form-control" id="description" aria-label="With textarea"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-success my-3 form-control" id="btnSubmit">บันทึก</button>

                    </div>
                </div>
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
        $(document).on("click", "#btnSubmit", function() {
            let accessory = $('#accessory').val();
            let code = $('#code').val();
            let type = $('#type').val();
            let department = $('#department').val();
            let description = $('#description').val();
            let formData = new FormData();
            formData.append("accessory", accessory);
            formData.append("code", code);
            formData.append("type", type);
            formData.append("department", department);
            formData.append("description", description);

            $.ajax({
                url: "./backend/addProblum.php",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res)
                    if (res.status == "200") {
                        Swal.fire({
                            title: "เข้าสู่ระบบสำเร็จ",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "send.php";
                        })
                    } else {
                        Swal.fire({
                            title: "เข้าสู่ระบบไม่สำเร็จ",
                            icon: "error",
                            timer: 1000,
                            showConfirmButton: false
                        })
                    }
                }
            })
        })
    </script>

</body>

</html>