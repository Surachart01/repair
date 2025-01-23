<?php 
    session_start();
    include("../include/connect.php");
    $id = $_POST['id'];
    $sqlGetProblem = "SELECT * FROM repair INNER JOIN product ON product.productId = repair.productId WHERE repairId = '$id'";
    $qGetProblem = $db->query($sqlGetProblem);
    $dataProblem = $qGetProblem->fetch_object();
?>
<div class="d-flex">
                            <div class="me-3">
                                <label for="">วัสดุ</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" id="accessory" placeholder="ประเภทของวัสดุ" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $dataProblem->productId ?>" disabled>
                                </div>
                            </div>
                            <div class="">
                                <label for="">หมายเลขครุภัณฑ์</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-123" viewBox="0 0 16 16">
                                            <path d="M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75z" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" id="code" placeholder="0000-0000" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $dataProblem->productName ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mb-2">

                            <div class="w-50">
                                <label for="">ประเภท</label>
                                <select class="form-select" id="type" disabled>
                                    <option value="1" <?php echo ($dataProblem->type == 1) ? 'selected' : ''; ?>>อุปกรณ์อิเล็กทรอนิก</option>
                                    <option value="2" <?php echo ($dataProblem->type == 2) ? 'selected' : ''; ?>>อุปกรณ์สำนักงาน</option>
                                </select>
                            </div>

                            <div class="w-50 ms-2">
                                <label for="">หน่วยงาน</label>
                                <select class="form-select" id="department" disabled>
                                    <option value="1" <?php echo ($dataProblem->department == 1) ? 'selected' : ''; ?>>ฝ่ายการเงิน</option>
                                    <option value="2" <?php echo ($dataProblem->department == 2) ? 'selected' : ''; ?>>ฝ่ายธุรการ</option>
                                    <option value="3" <?php echo ($dataProblem->department == 3) ? 'selected' : ''; ?>>ฝ่ายการบัญชี</option>
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
                                <textarea class="form-control" id="description" aria-label="With textarea"><?php echo $dataProblem->description; ?></textarea>
                            </div>
                        </div>
                        <button class="btn btn-success my-3 form-control" id="btnEdit" data-id="<?php echo $id ?>">บันทึก</button>