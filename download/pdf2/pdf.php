<?php
include("../../connect/conn.php");
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
}

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ใบสมัครงาน');
$pdf->SetTitle('ใบสมัครงาน');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
if ($per_pic!="") {
    $image = '<img class="rounded mx-auto d-block" src=../../"' . $per_pic . '" alt="Generic placeholder image" width="120" hight="120"/>';    
} else {
    // ไม่มีภาพ
    $image = '<img class="rounded mx-auto d-block" src="Sample.JPG" alt="Generic placeholder image"  width="120" hight="120"/>';
}

// Set some content to print
$html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
