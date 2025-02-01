<?php
try {
    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp']);
    $mpdf->SetTitle('ใบแจ้งซ่อม/รายงานผลการซ่อม/เบิกอะไหล่');

    $html = '
<style>
    body { font-family: "Garuda", sans-serif; }
    table { width: 100%; border-collapse: collapse; border: 1px solid black;}
    th, td { border: 0px solid black; padding: 8px; text-align: left; }
    .header { text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 10px; }
    .sub-header { text-align: center; font-size: 14px; margin-bottom: 20px; }
    .section-title { font-size: 16px; font-weight: bold; background-color: #f2f2f2; padding: 5px; }
    .signature { text-align: center; margin-top: 30px; }
    .checkbox { display: inline-block; width: 12px; height: 12px; border: 1px solid black; margin-right: 5px; }
</style>

<div class="header">ใบแจ้งซ่อม/รายงานผลการซ่อม/เบิกอะไหล่</div>
<div class="sub-header"><b>โรงพยาบาลพระนารายณ์มหาราช</b> โทรศัพท์: (036) 785444 ต่อ 4530</div>

<table>
    <tr>
        <td><b>ข้อมูลแจ้งซ่อม</b></td>
        <td>เลขที่แจ้งซ่อม: ______________________</td>
    </tr>
    <tr>
        <td>วันที่แจ้งซ่อม: ____________________________</td>
        <td>หน่วยงาน: ____________________________</td>
    </tr>
    <tr>
        <td>ครุภัณฑ์: ____________________________</td>
        <td>หมายเลข 7440-_______/_______/_______</td>
    </tr>
    <tr>
        <td>ยี่ห้อ/รุ่น: ___________________________</td>
        <td>IP: _______________________________</td>
    </tr>
    <tr>
        <td>วันที่ได้รับ: ____________________________</td>
        <td>ราคา: __________ ผู้จำหน่าย: _____________</td>
    </tr>
</table>

<table>
    <tr>
        <td><b>การดำเนินการ _______________________________________________________________________________________________________</b></td>
    </tr>
    <tr>
        <td>
            <input class="checkbox">เบิกวัสดุ/อะไหล่ ______________
            <input class="checkbox"> ส่งซ่อมภายนอก
            <input class="checkbox"> ส่งคืน
            <input class="checkbox"> อื่นๆ: _________________________
        </td>
    </tr>
</table>

<table>
    <tr>
        <td class="section-title">ความเห็นของผู้ตรวจสอบช่างคอมพิวเตอร์</td>
    </tr>
    <tr>
        <td>
            ลงชื่อ: ____________________________ <br>
            (นางสาวฐิติภาน์ มากสินธี) <br>
            ตำแหน่ง: นักวิชาการคอมพิวเตอร์ปฏิบัติการ <br>
            วันที่: ____________________________
        </td>
    </tr>
</table>

<table>
    <tr>
        <td class="section-title">ความเห็นของหัวหน้างานเทคโนโลยีสารสนเทศ</td>
    </tr>
    <tr>
        <td>
            ลงชื่อ: ____________________________ <br>
            (นางฐิติกา เชื้ออินทร์) <br>
            ตำแหน่ง: นักวิชาการคอมพิวเตอร์ปฏิบัติการ <br>
            วันที่: ____________________________
        </td>
    </tr>
</table>

<table>
    <tr>
        <td class="section-title">ความเห็นผู้บริหารงานเทคโนโลยีสารสนเทศระดับสูง (CIO)</td>
    </tr>
    <tr>
        <td>
            ลงชื่อ: ____________________________ <br>
            (นายอัมพล วิบูลย์ศักดิ์สกุล) <br>
            ตำแหน่ง: เจ้าราชการเชี่ยวชาญ <br>
            วันที่: ____________________________
        </td>
    </tr>
</table>

<table>
    <tr>
        <td class="section-title">งานพัสดุ: จัดซื้ออุปกรณ์ให้ศูนย์คอมแล้ว</td>
    </tr>
    <tr>
        <td>
            วันที่: ____________________________ <br>
            ราคา: ____________________________ <br>
            กำหนด: ____________________________ <br>
            ลงชื่อ: ____________________________ <br>
            ศูนย์คอมพิวเตอร์: รับอุปกรณ์แล้ว <br>
            ลงชื่อ: ____________________________ <br>
            วันที่: ____________________________
        </td>
    </tr>
</table>

';

    // ใส่ HTML เข้าไปใน PDF
    $mpdf->WriteHTML($html);

    // แสดง PDF บนเบราว์เซอร์
    $mpdf->Output('repair_report.pdf', 'I');
} catch (\Throwable $th) {
    echo $th;
}
