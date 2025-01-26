<!doctype html>
<html lang="en">

<head>
    <title>Login As Admin</title>
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

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        html,
        body {
            min-height: 100vh;
            background-color: rgb(214, 214, 214);
            font-family: "Kanit", serif;
            font-weight: 400;
            font-style: normal;
        }

        .page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login {
            font-size: 30px;
        }

        .card {
            width: 40%;
            border-radius: 30px;
        }

        .butt {
            background-color: #000000;
            color: #ffffff;
            border-radius: 10px;
            width: 100%;
            transition: ease-in-out 0.3s all;
        }

        .butt:hover {
            background-color: rgb(52, 52, 52);
            transform: scale(1.05);
            box-shadow: rgb(121, 121, 121) 0px 0px 20px;
        }

        input:focus {
            transform: scale(1.03);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="card">
            <div class="card-body px-5">
                <p class="login mt-4">LOGIN AS ADMIN</p>
                <label for="">EMAIL</label>
                <input type="email" class="form-control mb-4" placeholder="Email">

                <label for="">PASSWORD</label>
                <div class="input-group ">
                    <input type="password" class="form-control" id="password" placeholder="Password">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    </button>
                </div>

                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
                <button class="butt  mt-5 py-2 mb-5" id="btnLogin">Login</button>
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
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });

        $(document).on("click", "#btnLogin", function() {
            let email = $('#email').val();
            let password = $('#password').val();

            if (!email || !password) {
                Swal.fire({
                    title: "ข้อมูลไม่ครบถ้วน",
                    icon:"error",
                    text: "กรุณากรอก Email และ Password",
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }
            let formData = new FormData();
            formData.append("email", email)
            formData.append("password", password)

            $.ajax({
                url: "./backend/checkLogin.php",
                type: "POST",
                data: formData,
                contentType:false,
                processData:false,
                success: function(res) {
                    console.log(res)
                    if (res.status == '200') {
                        Swal.fire({
                            title: "Login เสร็จสิ้น",
                            text: "ยินดีต้อนรับ ",
                            icon:"success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = 'index.php'
                        })
                    } else {
                        Swal.fire({
                            title: "Login ไม่ถูกต้อง",
                            text: "Email หรือ Password ไม่ถูกต้อง ",
                            icon:"error",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload()
                        })
                    }
                }
            })
        })
    </script>
</body>

</html>