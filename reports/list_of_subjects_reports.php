<?php 
require("../FPDF/fpdf.php");

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
        $this->Cell(0,0,'__________________________________________________________________________________________',0,0,'C');
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
        $this->Cell(0,0,'Subjetct Lists Reports',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
        $this->Ln(7);

        $this->SetFont('Times','B', 12);
        $this->Cell(1);
        $this->Cell(10, 6, '#', 1, 0, 'L');
        $this->Cell(40, 6, 'Code', 1, 0, 'L');
        $this->Cell(60, 6, 'Title', 1, 0, 'L');
        $this->Cell(40, 6, 'Level', 1, 0, 'L');
        $this->Cell(40, 6, 'Strand', 1, 0, 'L');
        $this->Ln();

        $query = "SELECT * FROM subjects ";
        $res = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($res)) {
        $level = ($row['Level']=="")? 'TBA': ''.$row['Level'].'';
        $strand = ($row['Strand']=="")? 'TBA': ''.$row['Strand'].'';
            $this->SetFont('Times','', 11);
            $this->Cell(1);
            $this->Cell(10, 8, ''.$row['ID'].'', 1, 0, 'C');
            $this->Cell(40, 8, ''.$row['Subject_Code'].'', 1, 0, 'C');
            $this->Cell(60, 8, ''.$row['Description'].'', 1, 0, 'C');
            $this->Cell(40, 8, ''.$level.'', 1, 0, 'C');
            $this->Cell(40, 8, ''.$strand.'', 1, 0, 'C');
            $this->Ln();
        }
    }

}


    $pdf = new myPDF('p', 'mm', 'a4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle('HCAMIS SUBJECT LIST');
    $pdf->head();
    $pdf->content();
   
    $pdf->Footer();
    $pdf->Output();




?>