<?php 
require("../../FPDF/fpdf.php");

class myPDF extends FPDF{
    function head(){
        $this->Image('../../assets/image/logo.png', 30, 5, 25);
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
        $this->Cell(0,0,'__________________________________________________________________________________________',0,0,'C');
        $this->Ln(10);
    
        }

        function Footer(){
            $this->SetY(-30);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,0,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    }

    function content(){ 
        include '../../database/connection.php';
        $id = $_GET['id'];
        $grade = mysqli_real_escape_string($con, $_POST['grade']);
        $section = mysqli_real_escape_string($con, $_POST['section']);
        $sy = mysqli_real_escape_string($con, $_POST['sy']);
        $this->SetFont('Times','B',14);
        $this->Cell(1);
        $this->Cell(0,0,'My Class Schedule',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,''.$grade.' - '.$section.'',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,''.$sy.'',0,0,'C');
        $this->Ln(7);

        $this->SetFont('Times','B', 10);
        $this->Cell(1);
        $this->Cell(40, 6, 'Code', 1, 0, 'L');
        $this->Cell(60, 6, 'Descriptive_Title', 1, 0, 'L');
        $this->Cell(50, 6, 'Schedule', 1, 0, 'L');
        $this->Cell(40, 6, 'Room', 1, 0, 'L');
        $this->Ln();

        $query = "SELECT GROUP_CONCAT(Code SEPARATOR '\n' ) as code, GROUP_CONCAT(Description SEPARATOR '\n' ) as description, 
        GROUP_CONCAT(Days_Time SEPARATOR '\n' ) as sched,  GROUP_CONCAT(Room SEPARATOR '\n' ) as room From schedule inner join subjects on 
        schedule.Code = subjects.Subject_Code Where schedule.Teacher_ID = '$id' AND schedule.Grade = '$grade' AND 
        schedule.Strand = '$section' OR schedule.Section = '$section' Group By Section, Grade, schedule.Strand";
        $res = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($res)) {
            $this->SetFont('Times','B', 10);
            $this->Cell(1);
            $this->MultiCell(40, 6, ''.$row['code'].'', 1, 'L', false);
            $this->Ln(-12);
            $this->Cell(41);
            $this->MultiCell(60, 6, ''.$row['description'].'', 1, 'L', false);
            $this->Ln(-12);
            $this->Cell(101);
            $this->MultiCell(50, 6, ''.$row['sched'].'', 1, 'L', false);
            $this->Ln(-12);
            $this->Cell(151);
            $this->MultiCell(40, 6, ''.$row['room'].'', 1, 'L', false);
            $this->ln();
        }
    }

}

if (isset($_POST['print'])) {
    $pdf = new myPDF('p', 'mm', 'a4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle('Holy Child Academy Enrollment Form');
    $pdf->head();
    $pdf->content();
   
    $pdf->Footer();
    $pdf->Output();
}



?>