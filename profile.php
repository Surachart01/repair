<?php 
    session_start();
    include("./include/connect.php");
    $userId = $_SESSION['auth']->id;
    $sql = "SELECT * FROM users WHERE id = $userId";
    $q = $db->query($sql);
    $user = $q->fetch_object();

 ?>
<!doctype html>
<html lang="en">

<head>
    <title>Profile</title>
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
    <link rel="stylesheet" href="./css/profile.css">
</head>

<body>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-start py-4 navbar px-5">
                <a href="send.php" class="mx-3 itemNav ">แจ้งซ่อม</a>
                <a href="report.php" class="mx-3 itemNav">รายการส่งซ่อม</a>
                <a href="profile.php" class="mx-3 itemNav navActive">โปรไฟล์</a>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
                <h2 class="my-auto mx-2">โปรไฟล์</h2>
            </div>

            <hr />
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <h4>ข้อมูลส่วนตัว</h4>
                        <div class="d-flex">
                            <div class="me-3">
                                <label for="">ชื่อ</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                            <path d="M8 0a4 4 0 0 1 4 4v1a4 4 0 0 1-4 4 4 4 0 0 1-4-4V4a4 4 0 0 1 4-4zm0 1a3 3 0 0 0-3 3v1a3 3 0 0 0 3 3 3 3 0 0 0 3-3V4a3 3 0 0 0-3-3z" />
                                            <path fill-rule="evenodd" d="M0 15a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-1z" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" id="firstName" value="<?php echo $user->firstName ?>" placeholder="ชื่อ" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="">
                                <label for="">นามสกุล</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                            <path d="M8 0a4 4 0 0 1 4 4v 1a4 4 0 0 1-4 4 4 4 0 0 1-4-4V4a4 4 0 0 1 4-4zm0 1a3 3 0 0 0-3 3v 1a3 3 0 0 0 3 3 3 3 0 0 0 3-3V4a3 3 0 0 0-3-3z" />
                                            <path fill-rule="evenodd" d="M0 15a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v 1a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-1z" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" id="lastName" value="<?php echo $user->lastName ?>" placeholder="นามสกุล" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">อีเมล</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.708 2.825L15 11.383V5.383zM1 5.383v6l4.708-2.825L1 5.383zM1.5 12.5v.5a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-.5l-5.5-3.3-5.5 3.3z"/>
                                    </svg>
                                </span>
                                <input type="email" class="form-control" id="email" value="<?php echo $user->email ?>" placeholder="อีเมล" aria-label="Email" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    
                        <div class="mb-3">
                            <label for="phone">เบอร์โทร</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 1 .168-.745L5.457.168a.678.678 0 0 1 .745-.168l2.513 1.005a.678.678 0 0 1 .392.392l1.005 2.513a.678.678 0 0 1-.168.745l-1.287 1.287a11.72 11.72 0 0 0 4.287 4.287l1.287-1.287a.678.678 0 0 1 .745-.168l2.513 1.005a.678.678 0 0 1 .392.392l1.005 2.513a.678.678 0 0 1-.168.745l-1.415 1.415a.678.678 0 0 1-.745.168 15.978 15.978 0 0 1-6.01-3.757 15.978 15.978 0 0 1-3.757-6.01.678.678 0 0 1 .168-.745L3.654 1.328z"/>
                                    </svg>
                                </span>
                                <input type="tel" class="form-control" value="<?php echo $user->tel ?>" id="phone" placeholder="เบอร์โทร" aria-label="Phone" aria-describedby="basic-addon4">
                            </div>
                        </div>
                        <button class="btn btn-success form-control" data-id="<?php echo $userId ?>" id="btnSubmit">ยืนยัน</button>
                    </div>
                </div>
                <!-- Bootstrap JavaScript Libraries -->
                <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    $(document).on("click","#btnSubmit",function(){
                        let id = $(this).data('id');
                        let firstName = $('#firstName').val();
                        let lastName = $('#lastName').val();
                        let email = $('#email').val();
                        let phone = $('#phone').val();
                        let formData = new FormData();
                        formData.append('id',id);
                        formData.append('firstName',firstName);
                        formData.append('lastName',lastName);
                        formData.append('email',email);
                        formData.append('phone',phone);
                        $.ajax({
                            url: './backend/updateProfile.php',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(res){
                                if(res.status == 200){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'แก้ไขข้อมูลสำเร็จ',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }else{
                                    console.log(res)
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'แก้ไขข้อมูลไม่สำเร็จ',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            }
                        });
                    })
                </script>

</body>

</html>