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
        <option value="1">ศัลยกรรมหญิง</option>
        <option value="2">ศัลยกรรมชาย</option>
        <option value="3">การเงิน</option>
        <option value="4">ห้องฉุกเฉิน</option>
    </select>
    <label for="">email</label>
    <input type="text" class="form-control" required id="email">
    <button type="submit" class="btn btn-success mt-2 form-control" id="btnInsertEmp">เพิ่มพนักงาน</button>
</form>