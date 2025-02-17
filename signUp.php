<!doctype html>
<html lang="en">

<head>
    <title>Sign Up</title>
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
    <div class="page">
    <div class="card p-4">
    <div class="card-body">
        <h2 class="my-4 text-center">สมัครสมาชิก</h2>

        <div class="mb-3">
            <label for="firstName" class="form-label">ชื่อจริง</label>
            <input type="text" class="form-control" id="firstName" placeholder="กรอกชื่อจริงของคุณ">
        </div>

        <div class="mb-3">
            <label for="lastName" class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="lastName" placeholder="กรอกนามสกุลของคุณ">
        </div>

        <div class="mb-3">
            <label for="userName" class="form-label">ชื่อผู้ใช้</label>
            <input type="text" class="form-control" id="userName" placeholder="เลือกชื่อผู้ใช้">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input type="password" class="form-control" id="password" placeholder="กรอกรหัสผ่าน">
        </div>
        
        <div class="mb-3">
            <label for="department" class="form-label">แผนก</label>
            <select id="department" class="form-select">
                <option selected>โปรดเลือกแผนก</option>
                <option value="1">ศัลยกรรมหญิง</option>
                <option value="2">ศัลยกรรมชาย</option>
                <option value="3">การเงิน</option>
                <option value="4">ห้องฉุกเฉิน</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="userName" class="form-label">อีเมล (สำหรับแจ้งเตือน)</label>
            <input type="email" class="form-control" id="email" placeholder="email">
        </div>

            <button class=" py-2" style="width:100%" id="SignUp">สมัครสมาชิก</button>

        <div class="text-center mt-3">
            <a href="signIn.php" style="color: #000000;">เข้าสู่ระบบ</a>
        </div>
    </div>
</div>


    </div>
    <div class="fixed-bottom text-center p-2" style="background-color: black; color: white;">
        &copy; 2025 Phitsinee Prakod & Achita Boonniam
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on("click", "#SignUp", function() {
            let firstName = $('#firstName').val();
            let lastName = $('#lastName').val();
            let userName = $('#userName').val();
            let password = $('#password').val();
            let department = $('#department').val()
            let email = $('#email').val();
            let formData = new FormData();
            formData.append("firstName", firstName);
            formData.append("lastName", lastName);
            formData.append("userName", userName);
            formData.append("password", password);
            formData.append("department", department);
            formData.append("email",email);

            $.ajax({
                url: "./backend/signUpUser.php",
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
                            window.location.href = "signIn.php";
                        })
                    } else if (res.status == "403") {
                        Swal.fire({
                            title: "Username นี้ถูกใช้ไปแล้ว",
                            icon: "error",
                            timer: 1000,
                            showConfirmButton: false,

                        })
                    } else {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง",
                            icon: "error",
                            timer: 1000,
                            showConfirmButton: false,

                        })
                    }
                }
            })
        })
    </script>
</body>

</html>