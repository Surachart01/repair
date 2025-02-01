<form id="formInsert">
<label for="">เลขครุภัณฑ์</label>
<input type="text" class=" mb-2 form-control" id="productId" pattern="^\d{4}-\d{3}-\d{4}-\d{4}\/\d{2}$" title="กรุณาใส่หมายเลขในรูปแบบ 0000-000-0000-0000/00"  required/>
<label for="">ชื่อครุภัณฑ์</label>
<input type="text" class=" mb-2 form-control" id="productName" required>
<label for="">แบรน</label>
<input type="text" id="brand" class=" mb-2 form-control" required>
<label for="">แผนก</label>
<select class=" mb-2 form-select" id="department">
    <option selected>โปรดเลือกแผนก</option>
    <option value="doctor">หมอ</option>
    <option value="nurse">พยาบาล</option>
    <option value="finance">การเงิน</option>
    <option value="accounting">การบัญชี</option>
</select>
<label for="">ประเภท</label>
<select class=" mb-2 form-select" id="type">
    <option selected>โปรดเลือกประเภท</option>
    <option value="PC">เครื่องคอมพิวเตอร์</option>
    <option value="Monitor">หน้าจอคอมพิวเตอร์</option>
    <option value="UPS">เครื่องสำรองไฟ</option>
    <option value="Printer">เครื่องปริ้นเตอร์</option>
</select>


<button type="submit" class=" mb-2 btn btn-success form-control">เพิ่ม</button>
</form>

