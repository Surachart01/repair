<?php
include("./include/connect.php");
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: ./SignIn.php");
}
$userId = $_SESSION['auth']->id;
$role = $_SESSION['auth']->role;
if ($userId == 1) {
    $sqlProblem = "SELECT * FROM problems";
} else {
    $sqlProblem = "SELECT * FROM problems  WHERE userId = $userId";
}
$qProblem = $db->query($sqlProblem);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Report</title>
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
    <link rel="stylesheet" href="./css/report.css">
    <link rel="stylesheet" href="https:////cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
</head>

<body>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-start py-4 navbar px-5">
                <a href="send.php" class="mx-3 itemNav ">แจ้งซ่อม</a>
                <a href="report.php" class="mx-3 itemNav navActive">รายการส่งซ่อม</a>
                <a href="profile.php" class="mx-3 itemNav">โปรไฟล์</a>
                <?php
                if ($_SESSION['auth']->role == '9') { ?>
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
                <h2 class="my-auto mx-2">รายการ แจ้งซ่อม</h2>
            </div>

            <hr />
        </div>
        <div class="col-12">
            <div class="container">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th class="text-center">วันที่</th>
                            <th class="text-center">วัสดุคอมพิวเตอร์</th>
                            <th class="text-center">หมายเลขครุภัณฑ์</th>
                            <th class="text-center">ประเภท</th>
                            <th class="text-center">หน่วยงาน</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($item = $qProblem->fetch_object()) {
                            $type = $item->type == 1 ? "อุปกรณ์อิเล็กทรอนิก" : "อุปกรณ์สำนักงาน";
                            $depart = $item->depart == 1 ? "ฝ่ายการเงิน" : ($item->depart == 2 ? "ฝ่ายธุรการ" : "ฝ่ายบัญชี");
                            $state = $item->state == 1 ? "รับแจ้ง" : ($item->state == 2 ? "กำลังดำเนินการ" : "เสร็จสิ้น");
                            $color = $item->state == 1 ? 'bg-danger' : ($item->state == 2 ? 'bg-warning' : 'bg-success');
                        ?>
                            <tr>
                                <td><?php echo date("d-m-Y", strtotime($item->date)); ?></td>
                                <td><?php echo $item->itemName ?></td>
                                <td><?php echo $item->itemCode ?></td>
                                <td><?php echo $type ?></td>
                                <td><?php echo $depart ?></td>
                                <td>
                                    <p class="text-center rounded py-1 text-light <?php echo $color ?>"><?php echo $state ?></p>
                                </td>
                                <td>
                                    <button class="btn btn-primary me-2" data-id="<?php echo $item->id ?>" id="detail">รายละเอียด</button>
                                    <?php if ($item->state == 1) { ?>
                                        <button class="btn btn-danger me-2" data-id="<?php echo $item->id ?>" id="delete">ลบ</button>
                                        <button class="btn btn-warning" data-id="<?php echo $item->id ?>" id="edit">แก้ไข</button>
                                    <?php } ?>

                                    <?php
                                    if ($item->state != 3 && $role == '9') {
                                    ?>
                                        <button class="btn btn-success" data-id="<?php echo $item->id ?>" data-state="<?php echo $item->state ?>" id="state">Update สถานะ</button>
                                    <?php } ?>
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
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https:////cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>
    <script>
        let table = new DataTable('#myTable');

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
        $(document).on("click", "#delete", function() {
            Swal.fire({
                title: "คุณต้องการลบข้อมูลใช่หรือไม่",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่ใช่"
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id');
                    let formData = new FormData();
                    formData.append("id", id);
                    $.ajax({
                        url: "./backend/deleteProblem.php",
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            console.log(res)
                            if (res.status == "200") {
                                Swal.fire({
                                    title: "ลบข้อมูลสำเร็จ",
                                    icon: "success",
                                    timer: 1000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = "report.php";
                                })
                            } else {
                                Swal.fire({
                                    title: "ลบข้อมูลไม่สำเร็จ",
                                    icon: "error",
                                    timer: 1000,
                                    showConfirmButton: false
                                })
                            }
                        }
                    })
                }
            })
        })

        $(document).on("click", "#edit", function() {
            let id = $(this).data('id');
            let formData = new FormData();
            formData.append("id", id);
            $.ajax({
                url: "./components/popupEdit.php",
                type: "POST",
                data: formData,
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        title: "แก้ไขข้อมูล",
                        html: res,
                        showConfirmButton: false
                    })
                }
            })
        })

        $(document).on("click", "#state", function() {
            Swal.fire({
                title: "คุณต้องการแก้ไขสถานะใช่หรือไม่",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่ใช่"
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id');
                    let state = $(this).data('state');
                    console.log(state)
                    let formData = new FormData();
                    formData.append("id", id);
                    formData.append("state", state);
                    $.ajax({
                        url: "./backend/stateProblem.php",
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            console.log(res)
                            if (res.status == "200") {
                                Swal.fire({
                                    title: "แก้ไขสถานะสำเร็จ",
                                    icon: "success",
                                    timer: 1000,
                                    showConfirmButton: false
                                }).then(() => {
                                    if (res.dataProblem.state == 3) {
                                        emailjs.init("UaTrl6cBf3AKhFTYa");
                                    const templateParams = {
                                        NameOfSystem: "ระบบแจ้งซ่อม",
                                        to_name: res.dataUser.firstName + " " + res.dataUser.lastName,
                                        ID: res.dataProblem.itemCode,
                                        email: res.dataUser.email,
                                    };

                                    emailjs.send("service_kbfcmbv", "template_o25hr9m", templateParams)
                                        .then((response) => {
                                            console.log("Success!", response.status, response.text);
                                            window.location.href = "report.php";
                                        })
                                        .catch((error) => {
                                            console.error("Failed...", error);
                                        });
                                    }else{
                                        window.location.href = "report.php";
                                    }
                                    
                                    
                                })
                            } else {
                                Swal.fire({
                                    title: "แก้ไขสถานะไม่สำเร็จ",
                                    icon: "error",
                                    timer: 1000,
                                    showConfirmButton: false
                                })
                            }
                        }
                    })
                }
            })
        })

        $(document).on("click", "#btnEdit", function() {
            let id = $(this).data('id');
            let accessory = $('#accessory').val();
            let code = $('#code').val();
            let type = $('#type').val();
            let department = $('#department').val();
            let description = $('#description').val();
            let formData = new FormData();
            formData.append("id", id);
            formData.append("accessory", accessory);
            formData.append("code", code);
            formData.append("type", type);
            formData.append("department", department);
            formData.append("description", description);
            $.ajax({
                url: "./backend/editProblem.php",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res)
                    if (res.status == "200") {
                        Swal.fire({
                            title: "แก้ไขข้อมูลสำเร็จ",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "report.php";
                        })
                    } else {
                        Swal.fire({
                            title: "แก้ไขข้อมูลไม่สำเร็จ",
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