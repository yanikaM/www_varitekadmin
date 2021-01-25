
<?php
include('vendor/mpdf/mpdf/mpdf.php');
include("../../connect/conn.php");
$dateT = date("d-m-Y");

function DateThai($date)
        {
        $strYear = date("Y",strtotime($date));
        $Year = $strYear +543;
        $strMonth= date("n",strtotime($date));
        $strDay= date("j",strtotime($date));

        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $Year";
        }

// -----------------------------------------------------------------------------
$dateToday = DateThai($dateT);
$mpdf = new mPDF('th', 'A4', '0', 'garuda',20,20,20,20);


$mpdf->defHeaderByName(
    'myHeader', array (
        'L' => array (
            'content' => 'ข้อมูลบุคคล',
            'font-style' => 'B',
            'font-family' => 'garuda'
        ),
        'R' => array (
            'content' => 'วันที่พิมพ์ '.$dateToday,
            'font-style' => 'B',
            'font-family' => 'garuda'
        ),
        'C' => array (
            'content' => 'บริษัทอาซีฟา',
            'font-style' => 'B',
            'font-family' => 'garuda'
        ),
        'line' => 1,
    )
);

$mpdf->defHTMLHeaderByName(
    'myHeader2',
    '<div style="text-align: left; font-weight: bold;" class="col-md-4">ข้อมูลบุคคล</div>
    <div style="text-align: center; font-weight: bold;" class="col-md-4">Chapter 2</div>
    <div style="text-align: right; font-weight: bold;" class="col-md-4">Chapter 2</div>'
);


$tbl = '
<style>
@page {
	margin-top: 10cm;
	margin-bottom: 2cm;
	margin-right: 2cm;
	margin-left: 2cm;
}
.container{
    font-family: "garuda";
    font-size: 2pt;
}
tr.a{
    line-stacking-strategy: max-height
}
.listd{ 
    list-style-type: lower-alpha; color: teal; line-height: 2; 
}
</style>
<div class="container">
<center>



<table width="100%" border="0" cellpadding="0" cellspacing="0">
';
$table = 'tbl_person';
$id    = $GET["per_ID"];

$sql = "SELECT * from ".$tbl_person."  Where id = ".$id ;


$sqlQ = mysqli_query($con,$sql);
$i=1;
$a=1; 
while ($result = mysqli_fetch_array($sqlQ)) {

    $per_name = $result['per_name'];
    $per_position1 = $result['per_position1'];
    $per_position2 = $result['per_position2'];
    $per_birthdate = $result['per_birthdate'];
    $per_gender = $result['per_gender'];
    $per_phone = $result['per_phone'];
    $per_line = $result['per_line'];
    $per_email = $result['per_email'];
    $per_edu = $result['per_edu'];
    $per_major = $result['per_major'];
    $per_academy = $result['per_academy'];
    $per_gpa = $result['per_gpa'];
    $per_work = $result['per_work'];
    $per_pos = $result['per_pos'];
    $per_salary = $result['per_salary'];
    $per_news = $result['per_news'];
    $per_pic = $result['per_pic'];

 

        if( !function_exists('DateThai')) {  //ตรวจสอบว่ามี ฟังก์ชั่นอยู่หรือเปล่า
        //ถ้าไม่มีให้สร้าง ฟังก์ชั่นขึ้นมา
        function DateThai($date)
        {
            $strYear = date("Y",strtotime($date));
            $Year=$strYear+543;
            $strMonth= date("n",strtotime($date));
            $strDay= date("j",strtotime($date));
            $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
            $strMonthThai=$strMonthCut[$strMonth];
            return "$strDay $strMonthThai $Year";
        }

    
    }


    // กำหนดภาพ
    if ($per_pic!="") {
        $image = '<img class="rounded mx-auto d-block" src="' . $per_pic . '" alt="Generic placeholder image" width="120" hight="120"/>';    
    } else {
        // ไม่มีภาพ
        $image = '<img class="rounded mx-auto d-block" src="Sample.JPG" alt="Generic placeholder image"  width="120" hight="120"/>';
    }
    $tbl .='<tr align = "center">
    <td align = "center" scope="col"  width="100%">
    '. $image.'
    </td>
    </tr>
    <tr>
    <td scope="row" valign="top" style="font-size: 17pt; line-height: 150%; font-family: thsarabun;">

        <br />
        <br />
         ชื่อ   : '.$per_name.'<br />
        ตำแหน่งที่ต้องการสมัคร:  '.$per_position1.','.$per_position2.'<br />      
        <br />
        เกิดวันที่   : '.DateThai($per_birthdate).'&nbsp;'.' เพศ : '.$per_gender.' <br />
        เบอร์โทร : '.$per_phone.'&nbsp;'.' ID Line : '.$per_line.'<br />
        อีเมล : '.$per_email.'<br />
        ระดับการศึกษา : '.$per_edu.'&nbsp;'.' สาขา : '.$per_major.'<br />
        สถาบันการศึกษา : '.$per_academy.'<br />
        เกรดเฉลี่ย : '.$per_gpa.'<br />
        สถานที่ทำงานปัจจุบัน : '.$per_work.'<br />
        ตำแหน่ง : '.$per_pos.'&nbsp;'.' เงินเดือน : '.$per_salary.'<br />
        ทราบข่าวจากช่องทาง : '.$per_news.'<br />
        ';
        

    $tbl .=' </td></tr>';
    unset($image);
    $i++;
    $a++; 
} // endforeach;



$tbl .= '
</table>
</center>
</div>';
$mpdf->SetFooter('');
$mpdf->AddPage(
    '','NEXT-ODD','','','','','',35,25,19,17,
    'myHeader', '', '', '',
    20, 20, 20, 20
);
$mpdf->ignore_invalid_utf8 = true;
//==============================================================
$mpdf->autoScriptToLang = true;
$mpdf->baseScript = 1;	// Use values in classes/ucdn.php  1 = LATIN
$mpdf->autoVietnamese = true;
$mpdf->autoArabic = true;

$mpdf->autoLangToFont = true;



$mpdf->SetAuthor('ThaiID Cloud');
$mpdf->SetTitle('ThaiID Cloud Report');
$mpdf->WriteHTML($tbl);
$mpdf->Output();
//echo $tbl;
?>