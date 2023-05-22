<?php
include_once '../database/connection.php';
require '../phpExcel/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require("../FPDF/fpdf.php");

if (isset($_POST['print'])) {

    class myPDF extends FPDF{
        function head(){
            $this->Image('../assets/image/logo.png', 30, 5, 25);
            $this->SetFont('Times','',16);
            $this->Cell(1);
            $this->Cell(0,0,'Republic of the Philippines',0,0,'C');
            $this->Ln(7);
            $this->Cell(1);
            $this->SetFont('Times','',18);
            $this->Cell(0,0,'Diocesan Schools of Urdaneta',0,0,'C');
            $this->Ln(7);
            $this->SetFont('Times','',16);
            $this->Cell(1);
            $this->Cell(0,0,'Holy Child Academy',0,0,'C');
            $this->Ln(7);
            $this->SetFont('Times','',12);
            $this->Cell(1);
            $this->Cell(0,0,'Oct. 16th Street, Poblacion, Binalonan, Pangasinan, 2428',0,0,'C');
            $this->Ln(5);
            $this->SetFont('Times','B',12);
            $this->Cell(1);
            $this->Cell(0,0,'',1,0,'C');
            $this->Ln(10);
        
            }
    
            function Footer(){
                $this->SetY(-30);
                $this->SetFont('Arial','I',8);
                $this->Cell(0,0,'Page '.$this->PageNo().'/{nb}',0,0,'R');
        }
    
        function content(){ 
            include '../database/connection.php';
            $query = "SELECT * FROM academic_list WHERE is_default = '1'";
            $res = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($res);
            $this->SetFont('Times','B',14);
            $this->Cell(1);
            $this->Cell(0,0,'Student Account Reports',0,0,'C');
            $this->Ln(7);
            $this->SetFont('Times','',12);
            $this->Cell(1);
            $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
            $this->Ln(7);
    
            $this->SetFont('Times','B', 12);
            $this->Cell(1);
            $this->Cell(30, 6, 'Username', 1, 0, 'L');
            $this->Cell(30, 6, 'Lastname', 1, 0, 'L');
            $this->Cell(30, 6, 'Firstname', 1, 0, 'L');
            $this->Cell(30, 6, 'Middlename', 1, 0, 'L');
            
            $this->Cell(30, 6, 'Status', 1, 0, 'L');
            $this->Cell(30, 6, 'Date', 1, 0, 'L');
            $this->Ln();
            
            $sql = "SELECT * FROM std_account";
            $res = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
                $status = ($row['Status'] == 2 ) ? 'Activate':'Deactivate';
                $date = $row['Date'];
                $newdate = date("M d Y", strtotime($date));
    
                $this->SetFont('Times','', 12);
                $this->Cell(1);
                $this->Cell(30, 8, ''.$row['Student_ID'].'', 1, 0, 'L');
                $this->Cell(30, 8, ''.$row['Lastname'].'', 1, 0, 'L');
                $this->Cell(30, 8, ''.$row['Firstname'].'', 1, 0, 'L');
                $this->Cell(30, 8, ''.$row['Middlename'].'', 1, 0, 'L');
                $this->Cell(30, 8, ''.$status.'', 1, 0, 'L');
                $this->Cell(30, 8, ''.$newdate.'', 1, 0, 'L');
                $this->Ln();
            }
        }
    
    }
    
    
        $pdf = new myPDF('p', 'mm', 'a4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetTitle('HCAMIS Guidance Report');
        $pdf->head();
        $pdf->content();
       
        $pdf->Footer();
        $pdf->Output();
    
}

elseif (isset($_POST['excel'])) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $from = "A1";
    $to = "I1"; 
    $sheet->getStyle("$from:$to")->getFont()->setBold( true );

    $sheet->setCellValue('A1', 'Username');
    $sheet->setCellValue('B1', 'Lastname');
    $sheet->setCellValue('C1', 'Firstname');
    $sheet->setCellValue('D1', 'Middlename');
    $sheet->setCellValue('E1', 'Contact');
    $sheet->setCellValue('F1', 'Email');
    $sheet->setCellValue('G1', 'Status');
    $sheet->setCellValue('H1', 'Access');
    $sheet->setCellValue('I1', 'Date');

    $sql = "SELECT * FROM std_account";
    $result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $row = mysqli_fetch_assoc($result);
    $status = ($row['Status'] == 2)?'Activate':'Deactivate';
    $date = $row['Reg_Date'];
    $newdate = date("M d Y", strtotime($date));
    $rowCount = 3;
  
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A'.$rowCount, ''.$row['Username'].'');
    $sheet->setCellValue('B'.$rowCount, ''.$row['Lastname'].'');
    $sheet->setCellValue('C'.$rowCount, ''.$row['Firstname'].'');
    $sheet->setCellValue('D'.$rowCount, ''.$row['Middlename'].'');
    $sheet->setCellValue('E'.$rowCount, ''.$row['Contact'].'');
    $sheet->setCellValue('F'.$rowCount, ''.$row['Email'].'');
    $sheet->setCellValue('G'.$rowCount, ''.$status.'');
    $sheet->setCellValue('H'.$rowCount, ''.$row['Access'].'');
    $sheet->setCellValue('I'.$rowCount, ''.$newdate.'');
    

    $date = date("Y-m-d");
    $writer = new Xlsx($spreadsheet);
    $final_filename = 'student_accounts_report_'.$date.".xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attactment; filename="'.urlencode($final_filename).'"');
    $writer->save('php://output');
    }
    $rowCount++;
    
}else{
    echo '<script>
        alert("No Record Found!");
        window.location.href = "../admin/std_account.php";
        </script>';
}

    
}


?>