<?php
try {

    include("./include/connect.php");
    $repairId = $_GET['Key'];
    $sqlData = "SELECT * FROM repair INNER JOIN product ON repair.productId = product.productId INNER JOIN employee ON repair.empId = employee.empId WHERE repairId = '$repairId'";
    $qData = $db->query($sqlData);
    $data = $qData->fetch_object();
    $type = ($data->type == "PC") ? "เครื่องคอมพิวเตอร์" : (($data->type == "Monitor") ? "หน้าจอคอมพิวเตอร์" : (($data->type == "UPS") ? "เครื่องสำรองไฟ" : (($data->type == "Printer") ? "เครื่องปริ้นเตอร์" : "ไม่ทราบประเภท")));
    $department = ($data->department == '1')?'ศัลยกรรมหญิง':(($data->department == '2')?'ศัลยกรรมชาย':(($data->department == '3')?'การเงิน':'ห้องฉุกเฉิน'));
    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp']);
    $mpdf->SetTitle('ใบแจ้งซ่อม/รายงานผลการซ่อม/เบิกอะไหล่');

    $html = '
<style>
    body { font-family: "Garuda", sans-serif; line-height: 1.6; }
    table { width: 100%; border-collapse: collapse; border: 1px solid black;}
    th, td { border: 0px solid black; padding: 12px; text-align: left; }
    .header { text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 20px; }
    .sub-header { text-align: center; font-size: 14px; margin-bottom: 30px; }
    .section-title { font-size: 16px; font-weight: bold; background-color: #f2f2f2; padding: 10px; margin-top: 10px; margin-bottom: 10px; }
    .signature { text-align: center; margin-top: 50px; }
    .checkbox { display: inline-block; width: 12px; height: 12px; border: 1px solid black; margin-right: 5px; }
    .b {font-weight: bold;}
    .text-center {text-align:center;}
</style>

<div class="header">ใบแจ้งซ่อม/รายงานผลการซ่อม/เบิกอะไหล่</div>
<div class="sub-header"><b>โรงพยาบาลพระนารายณ์มหาราช</b> โทรศัพท์: (036) 785444 ต่อ 4530</div>

<table>
    <tr>
        <td><b>ข้อมูลแจ้งซ่อม</b></td>
        <td>เลขที่แจ้งซ่อม:   '.$data->repairId .'</td>
    </tr>
    <tr>
        <td>วันที่แจ้งซ่อม:   '.$data->date.'</td>
        <td>หน่วยงาน:  '.$department.'</td>
    </tr>
    <tr>
        <td>ครุภัณฑ์:  '.$type.'</td>
        <td>หมายเลข :  '.$data->productId.'</td>
    </tr>
    <tr>
        <td>ยี่ห้อ/รุ่น:  '.$data->brand.'</td>
        <td>ผู้แจ้งซ่อม: '.$data->firstName.' '.$data->lastName.'</td>
    </tr>
    <tr>
        <td>วันที่ได้รับ: ' . (!empty($data->dateEnd) ? $data->dateEnd : '____________________________') . '</td>
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
        <td width="50%" style="border-right:1px solid black">
            <div class="b">ความเห็นของผู้ตรวจสอบช่างคอมพิวเตอร์</div>
            ____________________________________<br>
            ____________________________________<br>
            ลงชื่อ: ____________________________ <br>
            (นางสาวฐิติภาน์ มากสินธี) <br>
            ตำแหน่ง: นักวิชาการคอมพิวเตอร์ปฏิบัติการ <br>
            วันที่: ____________________________
        </td>
        <td width="50%"  style="border-left:1px solid black">
            <div class="b">ความคิดเห็นผู้บริหารเทนโนโลยีสารสนเทศระดับสูง (CIO)</div>
            ____________________________________<br>
            ____________________________________<br>
            ____________________________________<br><br><br><br>
            ลงชื่อ: ____________________________ <br>
            <div class="text-center">(นายกัมพล วิบูลย์ศักดิ์สกุล) </div>
            วันที่: ____________________________
        </td>
    </tr>
    <tr>
        <td width="50%"style="border-right:1px solid black; ">
            <div class="b">ความเห็นของหัวหน้างานเทคโนโลยีสารสนเทศ</div>
            ____________________________________<br>
            ____________________________________<br>
            ลงชื่อ: ____________________________ <br>
            (นางฐิติกา เชื้ออินทร์) <br>
            ตำแหน่ง: นักวิชาการคอมพิวเตอร์ปฏิบัติการ <br>
            วันที่: ____________________________
        </td>
        <td width="50%" rowspan="2" style="border-left:1px solid black;">
           <div class="b">งานพัสดุ: จัดซื้ออุปกรณ์ให้ศูนย์คอมแล้ว</div>
            วันที่: ____________________________ <br>
            ราคา: ____________________________ <br>
            กำหนด: ____________________________ <br>
            ลงชื่อ: ____________________________ <br>
            ศูนย์คอมพิวเตอร์: รับอุปกรณ์แล้ว <br>
            ลงชื่อ: ____________________________ <br>
            วันที่: ____________________________
        </td>
    </tr>
    
    <tr>
        <td class="b" style="border-top:1px solid black">ความเห็นผู้บริหารงานเทคโนโลยีสารสนเทศระดับสูง (CIO)</td>
    </tr>
    <tr>
        <td style="border-right:1px solid black">
            ลงชื่อ: ____________________________ <br>
            (นายอัมพล วิบูลย์ศักดิ์สกุล) <br>
            ตำแหน่ง: เจ้าราชการเชี่ยวชาญ <br>
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
