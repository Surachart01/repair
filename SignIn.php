<!doctype html>
<html lang="en">

<head>
    <title>SignIn</title>
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
    <link rel="stylesheet" href="./css/signIn.css">
</head>


<body>

    <div class="page flex-column">
        <h3 class="text-center mb-5 bg-dark text-light rounded px-5 py-3 shadow">ระบบแจ้งซ่อมครุภัณฑ์ไอที ในโรงพยาบาลพระนารายณ์มหาราช</h3>
        <div class="card p-4">
            <div class="card-body">
                <h2 class="text-center">เข้าสู่ระบบ</h2>

                <div class="mb-3">
                    <label for="userName" class="form-label">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" id="userName" placeholder="กรอกชื่อผู้ใช้">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control" id="password" placeholder="กรอกรหัสผ่าน">
                </div>

                    <button class=" py-2" style="width: 100%;" id="login">เข้าสู่ระบบ</button>

                <div class="text-center mt-3">
                    <a href="signUp.php" style="color: #000000;">สมัครสมาชิก</a>
                </div>
            </div>
        </div>

    </div>
    <div class="fixed-bottom text-center p-2" style="background-color: black; color: white;">
        &copy; 2025 Phitsinee Prakod & Achita Boonniam
    </div>





    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on("click", "#login", function() {
            console.log('click')
            let userName = $('#userName').val();
            let password = $('#password').val();
            let formData = new FormData();
            formData.append("userName", userName);
            formData.append("password", password);

            $.ajax({
                url: "./backend/checkLogin.php",
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
                            title: "Username หรือ Password ไม่ถูกต้อง",
                            icon: "error",
                            timer: 1000,
                            showConfirmButton: false,
                            position: "top-end"
                        })
                    }
                }
            })
        })
    </script>
</body>

</html>