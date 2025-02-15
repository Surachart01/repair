<?php
session_start();
include("./include/connect.php");
if (!isset($_SESSION['auth'])) {
    header("Location: ./SignIn.php");
}

$user = $_SESSION['auth'];
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
                <!-- <?php
                        // if($_SESSION['auth']->role == '9'){
                        ?> 
                    <a href="member.php" class="mx-3 itemNav">ผู้ใช้งาน</a> 
                    <?php
                    // }
                    ?> -->
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
                        <label for="">หมายเลขครุภัณฑ์</label>
                        <input type="text" id="productId" placeholder="0000-000-0000-0000/00" class="form-control">
                        <div class="d-flex">
                            <div class="me-1">
                                <label for="">ชื่อวัสดุ</label>
                                <input type="text" id="productName" class="form-control" disabled>
                            </div>
                            <div class="">
                                <label for="">ยี่ห้อ</label>
                                <input type="text" id="brand" class="form-control" disabled>
                            </div>
                        </div>
                        <label for="">ประเภทครุภัณฑ์</label>
                        <input type="text" id="type" class="form-control" disabled>
                        <label for="">แผนก</label>
                        <input type="text" id="department" class="form-control" disabled>
                        <div class="">
                            <label for="">อาการที่แจ้งซ่อม</label>
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
                        <input type="hidden" placeholder="email" id="email" value="<?php echo $user->email ?>" class="form-control">
                        <button class="btn btn-success my-3 form-control" id="btnSubmit" disabled>บันทึก</button>

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
        $(document).on("input", "#productId", function() {
            let productId = $(this).val();
            let regex = /^\d{4}-\d{3}-\d{4}-\d{4}\/\d{2}$/;
            let obj = $(this)
            if (!regex.test(productId)) {
                $(this).focus();
                $(this).get(0).setCustomValidity('กรุณาใส่หมายเลขในรูปแบบ 0000-000-0000-0000/00');
                $(this).get(0).reportValidity();
                $('#productName').val("");
                $('#brand').val("");
                $('#department').val("");
                $('#type').val("");
            } else {
                
                $(this).get(0).setCustomValidity('');
                $(this).get(0).reportValidity();
                let formData = new FormData();
                formData.append("productId", productId);
                $.ajax({
                    url: "./backend/updateSend.php",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.status == '200') {

                            $('#productName').val(res.data[0].productName);
                            $('#brand').val(res.data[0].brand);
                            $('#department').val(res.data[0].department);
                            $('#type').val(res.data[0].type);
                            $('#btnSubmit').attr('disabled',false);
                        } else if(res.status == '403'){
                            console.log(res)
                            obj.get(0).setCustomValidity('ครุภัณฑ์แจ้งซ่อมแล้ว');
                            obj.get(0).reportValidity();
                        }else{
                            console.log(res)
                            obj.get(0).setCustomValidity('ไม่พบครุภัณฑ์ในแผนกของคุณ');
                            obj.get(0).reportValidity();
                        }


                    }
                })
            }
        });
        $(document).on("click", "#btnSubmit", function() {
            let productId = $('#productId').val();
            let description = $('#description').val();
            let email = $("#email").val();
            let formData = new FormData();
            formData.append("productId", productId);
            formData.append("description", description);
            formData.append("email",email);
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
                            title: "แจ้งซ่อมสำเร็จ",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload()
                        })
                    } else {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด",
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