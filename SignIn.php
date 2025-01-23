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

    <div class="page">
        <div class="card">
            <div class="card-body py-5">
                <h2 class="my-5 text-center">Sign In</h2>
                <div class="my-2 d-flex justify-content-center">
                    <input type="text"  placeholder="Username" id="userName">
                </div>
                <div class="my-2 d-flex justify-content-center">
                    <input type="password"  id="password" placeholder="Password" class="my-2">
                </div>
                <div class="my-2 d-flex justify-content-center">
                    <button class="my-2 py-2" id="login">Sign In</button>
                </div>
                <a href="signUp.php"  style="color: #000000;">สมัครสมาชิก</a>
            </div>
        </div>
    </div>




    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on("click","#login",function(){
            console.log('click')
            let userName = $('#userName').val();
            let password = $('#password').val();
            let formData = new FormData();
            formData.append("userName",userName);
            formData.append("password",password);

            $.ajax({
                url:"./backend/checkLogin.php",
                type:"POST",
                data:formData,
                dataType:"json",
                contentType:false,
                processData:false,
                success:function(res){
                    console.log(res)
                    if(res.status == "200"){
                        Swal.fire({
                            title:"เข้าสู่ระบบสำเร็จ",
                            icon:"success",
                            timer:1000,
                            showConfirmButton:false
                        }).then(() => {
                            window.location.href = "send.php";
                        })
                    }else{
                        Swal.fire({
                            title:"Username หรือ Password ไม่ถูกต้อง",
                            icon:"error",
                            timer:1000,
                            showConfirmButton:false,
                            position:"top-end"
                        })
                    }
                }
            })
        })
    </script>
</body>

</html>