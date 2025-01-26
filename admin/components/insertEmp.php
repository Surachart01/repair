<form id="formInsertEmp">
<label for="">ชื่อจริง</label>
<input type="text" class="form-control" required id="firstName">
<label for="">นามสกุล</label>
<input type="text" class="form-control" required id="lastName">
<label for="">Username</label>
<input type="text" class="form-control" required id="userName">
<label for="">รหัสผ่าน</label>
<input type="password" class="form-control" required id="password">
<label for="">แผนก</label>
<select name="" id="department" required class="form-select">
    <option selected>โปรดเลือกแผนก</option>
    <option value="doctor">หมอ</option>
    <option value="nurse">พยาบาล</option>
    <option value="finance">การเงิน</option>
    <option value="accounting">การบัญชี</option>
</select>
<button type="submit" class="btn btn-success mt-2 form-control" id="btnInsertEmp">เพิ่มพนักงาน</button>
</form>
