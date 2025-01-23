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
        <div class="card">
            <div class="card-body py-5">
                <h2 class="my-5 text-center">Sign Up</h2>
                <div class="my-2 d-flex justify-content-center">
                    <input type="text" placeholder="firstName" id="firstName">
                </div>
                <div class="my-2 d-flex justify-content-center">
                    <input type="text" placeholder="lastName" id="lastName">
                </div>
                <div class="my-2 d-flex justify-content-center">
                    <input type="text" placeholder="Username" id="userName">
                </div>
                <div class="my-2 d-flex justify-content-center">
                    <input type="password" id="password" placeholder="Password" class="my-2">
                </div>
                <div class="my-2 d-flex justify-content-center">
                    <select name="" id="department" class="">
                        <option selected>โปรดเลือกแผนก</option>
                        <option value="doctor">หมอ</option>
                        <option value="nurse">พยาบาล</option>
                        <option value="finance">การเงิน</option>
                        <option value="accounting">การบัญชี</option>

                    </select>
                </div>
                <div class="my-2 d-flex justify-content-center">
                    <button class="my-2 py-2" id="SignUp">Sign Up</button>
                </div>
                <a href="signIn.php" style="color: #000000;">เข้าสู่ระบบ</a>

            </div>
        </div>

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
            let formData = new FormData();
            formData.append("firstName", firstName);
            formData.append("lastName", lastName);
            formData.append("userName", userName);
            formData.append("password", password);
            formData.append("department", department);

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