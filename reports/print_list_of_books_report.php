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
        $this->Cell(0,0,'List of books Reports',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
        $this->Ln(7);

        $this->SetFont('Times','B', 12);
        $this->Cell(1);
        $this->Cell(6, 6, '#', 1, 0, 'L');
        $this->Cell(45, 6, 'ISBN', 1, 0, 'L');
        $this->Cell(45, 6, 'Title', 1, 0, 'L');
        $this->Cell(45, 6, 'Author', 1, 0, 'L');
        $this->Cell(35, 6, 'Category', 1, 0, 'L');
        $this->Cell(35, 6, 'Publish', 1, 0, 'L');
        $this->Cell(15, 6, 'Total', 1, 0, 'L');
        $this->Cell(25, 6, 'Available', 1, 0, 'L');
        $this->Cell(25, 6, 'Borrowed', 1, 0, 'L');
        $this->Ln();

        $query = "SELECT * FROM books";
        $res = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($res)) {
            $date = $row['Date_Publish'];
            $newdate = date("M d Y", strtotime($date));

            $this->SetFont('Times','', 11);
            $this->Cell(1);
            $this->Cell(6, 8, ''.$row['ID'].'', 1, 0, 'C');
            $this->Cell(45, 8, ''.$row['ISBN'].'', 1, 0, 'C');
            $this->Cell(45, 8, ''.$row['Title'].'', 1, 0, 'C');
            $this->Cell(45, 8, ''.$row['Author'].'', 1, 0, 'C');
            $this->Cell(35, 8, ''.$row['Category'].'', 1, 0, 'C');
            $this->Cell(35, 8, ''.$newdate.'', 1, 0, 'C');
            $this->Cell(15, 8, ''.$row['Total'].'', 1, 0, 'C');
            $this->Cell(25, 8, ''.$row['Available'].'', 1, 0, 'C');
            $this->Cell(25, 8, ''.$row['Borrowed'].'', 1, 0, 'C');
            $this->Ln();
        }
    }

}


    $pdf = new myPDF('L', 'mm', 'a4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle('List of Books Reports');
    $pdf->head();
    $pdf->content();
   
    $pdf->Footer();
    $pdf->Output();




?>