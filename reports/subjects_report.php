<?php
include_once '../database/connection.php';
require("../FPDF/fpdf.php");
error_reporting(0);

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
        $this->Ln(5);
    
        }

        function Footer(){
            $this->SetY(-30);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,0,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    }

    function content(){
        $count = 1;
        include '../database/connection.php';
        $aid = mysqli_real_escape_string($con, $_POST['aid']);
        $query = "SELECT * FROM academic_list WHERE is_default = '1'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,'Subjects Reports',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
        $this->Ln(7);

        $this->SetFont('Times','BI', 11);
        $this->Cell(1);
        $this->Cell(6, 6, '#', 1, 0, 'L');
        $this->Cell(45, 6, 'Code', 1, 0, 'L');
        $this->Cell(65, 6, 'Description', 1, 0, 'L');
        $this->Cell(45, 6, 'Grade', 1, 0, 'L');
        $this->Cell(35, 6, 'Department', 1, 0, 'L');
        $this->Ln();

        $get = mysqli_query($con, "SELECT * FROM subjects Order By Level ASC");
        if (mysqli_num_rows($get) > 0) {
            while ($row = mysqli_fetch_assoc($get)) {
                $this->SetFont('Times','I', 11);
                $this->Cell(1);
                $this->Cell(6, 6, ''.$count++.'', 1, 0, 'L');
                $this->Cell(45, 6, ''.$row['Subject_Code'].'', 1, 0, 'L');
                $this->Cell(65, 6, ''.$row['Description'].'', 1, 0, 'L');
                $this->Cell(45, 6, ''.$row['Level'].'', 1, 0, 'L');
                $this->Cell(35, 6, ''.$row['Department'].'', 1, 0, 'L');
                $this->Ln();
            }
        }else{
            echo "<script>
                    alert('No Record Found!');
                    window.location.href = '../admin/student_payment.php';
                </script>";
        }

        $get = mysqli_query($con, "SELECT * FROM admin WHERE Admin_ID = '$aid'");
            $row = mysqli_fetch_assoc($get);
            $principal = $row['Salutation']. ". " .$row['Lastname']. ", " .$row['Firstname']. " " .$row['Middlename'];

            $this->Ln(6);
            $this->SetFont('Times','B',11);
            $this->Cell(1);
            $this->Cell(0,0,'School Principal:',0,0,'L');
            $this->Ln(5);

            $this->SetFont('Times','I',11);
            $this->Cell(1);
            $this->Cell(0,0,''.$principal.'',0,0,'L');
            $this->Ln(0);
        
    }

}


    $pdf = new myPDF('p', 'mm', array(330.2, 215.9));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle('Subjects Report');
    $pdf->head();
    $pdf->content();
   
    $pdf->Footer();
    $pdf->Output();

}

if (isset($_POST['excel'])) {
    $count = 1;
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 

    $fileName = "subject_report_" . date('Y-m-d') . ".xls";

    $fields = array('#','Code', 'Description', 'Grade', 'Department');
    $excelData = implode("\t", array_values($fields)) . "\n";

    $get = mysqli_query($con, "SELECT * FROM subjects Order by Level ASC");

    if (mysqli_num_rows($get) > 0) {
        while ($row = mysqli_fetch_assoc($get)) {

                $data = array(''.$count++.'',''.$row['Subject_Code'].'', ''.$row['Description'].'', ''.$row['Level'].'', ''.$row['Department'].'');
                
                
            array_walk($data, 'filterData'); 
            $excelData .= implode("\t", array_values($data)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n";
    }

    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    
    // Render excel data 
    echo $excelData; 
    
    exit;
}


   
      

?>