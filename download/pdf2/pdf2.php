<?php require_once('../../connect/conn.php'); ?>
<?php 
require_once('lang/eng.php');
require_once('../tcpdf.php');
     
// get data from users table 


//$id    = $GET["per_ID"];   

$result = mysqli_query($con,"SELECT * FROM tbl_person WHERE per_ID = '00002' "); 

while($row = mysqli_fetch_array($result)) 
  { 
    $type = $row['per_name']; 
    $company = $row['per_position1']; 

  } 
   
// create new PDF document 
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  // set document information

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Innovation');
$pdf->SetTitle('Asefa company');
$pdf->SetSubject('ใบสมัครงาน');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');




$pdf->SetPrintHeader(true); $pdf->SetPrintFooter(true); 
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

// set default monospaced font 
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 

//set margins 
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

//set some language-dependent strings 
$pdf->setLanguageArray($l);  

// --------------------------------------------------------- 

// set font 
$pdf->SetFont('dejavusans', '', 10); 

// add a page 
$pdf->AddPage(); 
// create some HTML content 
$txt = <<<EOD
Below are the details I require

Company type: $type
Company Name: $company


EOD;


// output the HTML content 
// $pdf->writeHTML($htmlcontent, true, 0, true, 0); 
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

// $pdf->writeHTML($inlinecss, true, 0, true, 0); 

// reset pointer to the last page 
// $pdf->lastPage(); 

//Close and output PDF document 
$pdf->Output('example_006.pdf', 'I'); 

//============================================================+ 
// END OF FILE                                                  
//============================================================+ 
?>