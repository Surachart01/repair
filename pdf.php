<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;

try {
    // ตั้งค่า default font เป็น THSarabun
    $mpdf = new Mpdf();
    $mpdf->charset_in = 'UTF-8';

    $html = '
        <style>
            body{ font-family: "Garuda"; font-size: 10pt; }

            p{  
                margin-top: 10px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            .header-table td {
                vertical-align: top;
            }
            .header-title {
                text-align: left;
            }
            .card-header {
                background-color: yellow;
                border: 1px solid black;
                padding: 10px;
                text-align: start;
            }
        </style>
        <table class="header-table">
            <tr>
                <td class="header-title">
                    <h3>ใบแจ้งซ่อม/รายงานผลการซ่อม/เบิกอะไหล่</h3>
                    <p>(ครุภัณฑ์คอมพิวเตอร์และอุปกรณ์คอมพิวเตอร์)</p>
                </td>
                <td class="card-header">
                    <p>พัสดุลงรับเลขที่...........</p>
                    <p>วันที่...................</p>
                </td>
            </tr>
        </table>
        <p style="margin:5px 0px 5px 0px; text-align:center;">โทรศัพท์ : (036) 7854444 ต่อ 4530</p>
        <table border="1">
            <tr>
                <td style="width: 50%;">
                    <u>ข้อมูลส่งซ่อม</u>
                    <p style="padding-top:10px">วันที่แจ้งซ่อม ........................................</p>
                    <p style="padding-top:10px">ครุภัณฑ์ ............................................</p>
                    <p style="padding-top:10px">ยี่ห้อ/รุ่น ...........................................</p>
                    <p style="padding-top:10px">วันที่ได้รับ ..........................................</p>
                </td>
                <td style="width: 50%;">
                    <p>เลขที่ส่งซ่อม.........................................</p>
                    <p>หน่วยงาน...........................................</p>
                    <p>IP ...............................................</p>
                    <p>ราคา ................. ผู้จำหน่าย ...................</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>อาการ/สาเหตุ............................................................................................</p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <p>ผู้แจ้งซ่อม .............................................</p>
                    <p style="margin-left:10px;">วันที่ .................................................</p>
                </td>
            </tr>
        </table>
    ';

    $mpdf->WriteHTML($html);
    $mpdf->Output('styled-example.pdf', 'I');
} catch (\Throwable $th) {
    echo $th->getMessage();
}

<table>
    <tr>
        <td>การดำเนินการ.................................................................................</td>
        <input type="checkbox" ><p>เบิกวัสดุ/อะไหล่</p>
    </tr>
</table>
