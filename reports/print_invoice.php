<?php 
require("../FPDF/fpdf.php");
class myPDF extends FPDF{
    function head(){
        $this->Image('../assets/image/logo.png', 30, 5, 25, );
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
        $this->Ln(8);
        $this->SetFont('Times','B',14);
        $this->Cell(1);
        $this->Cell(0,0,'Invoice to:',0,0,'L');
        $this->Ln(7);
        
        include_once ('../database/connection.php');
        $or_num = $_GET['or_num'];
        $sql = mysqli_query($con, "SELECT *, payment_history.QR_Code as qrcode from payment_history inner join student on payment_history.Student_ID = student.Student_ID inner join student_grade on student.Student_ID = student_grade.Student_ID Where payment_history.OR_Number = '$or_num'");
        $row = mysqli_fetch_assoc($sql);
        $name = $row['Firstname']. " " .$row['Middlename']. " " .$row['Lastname'];
        $grade = $row['Class_ID'];

        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,''.$name.'',0,0,'L');
        $this->Ln(7);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['Address'].'',0,0,'L');
        $this->Ln(7);
        $this->Image('../payment_qrcode/'.$row['qrcode'].'', 150, 40, 45, );
        $this->Ln(7);

        $this->SetFont('Times','B', 12);
            $this->Cell(1);
            $this->Cell(60, 6, 'Description', 1, 0, 'L');
            $this->Cell(70, 6, 'Amount', 1, 0, 'L');
            $this->Cell(60, 6, 'Type of Payment', 1, 0, 'L');
            $this->Ln();

            $this->SetFont('Times','', 12);
            $this->Cell(1);
            $this->Cell(60, 8, 'Monthly Payment', 1, 0, 'L');
            $this->Cell(70, 8, ''.$row['Paid_Amount'].'', 1, 0, 'L');
            $this->Cell(60, 8, ''.$row['Payment_Type'].'', 1, 0, 'L');
            $this->Ln(15);
            $sql1 = mysqli_query($con, "SELECT * FROM fees Where Grade_ID = '$grade'");
            
            while ($row1 = mysqli_fetch_assoc($sql1)) {
                $this->SetFont('Times','B',12);
                $this->Cell(140);
                $this->Cell(0,0,''.$row1['Description'].':',0,0,'L');
                $this->Cell(0,0,''.$row1['Amount'].'',0,0,'R');
                $this->Ln(7);
            }
            $total = $row['Balance'] + $row['Paid_Amount'];
            $this->Cell(0,0,'________________________',0,0,'R');
            $this->Ln(7);
            $this->SetFont('Times','B',12);
            $this->Cell(140);
            $this->Cell(0,0,'Total:',0,0,'L');
            $this->Cell(0,0,''.$total.'',0,0,'R');
            $this->Ln(7);
            $this->Cell(140);
            $this->Cell(0,0,'Paid:',0,0,'L');
            $this->Cell(0,0,''.$row['Paid_Amount'].'',0,0,'R');
            $this->Ln(1);
            $this->Cell(0,0,'________________________',0,0,'R');
            $this->Ln(7);
            $this->Cell(140);
            $this->Cell(0,0,'Balance:',0,0,'L');
            $this->Cell(0,0,''.$row['Balance'].'',0,0,'R');
            $this->Ln(30);


            $this->Cell(1);
            $this->SetFont('Times','BU', 12);
            $this->Cell(0,0,'JOVITA R. BUENO',0,0,'C');
            $this->Ln(5);
            $this->Cell(1);
            $this->SetFont('Times','', 10);
            $this->Cell(0,0,'Registrar/ Cashier',0,0,'C');
            $this->Ln(25);

    
            $this->SetFont('Times','BU', 12);
            $this->Cell(0,0,'LORRIE T. SERAIN',0,0,'C');
            $this->Ln(5);
    
            $this->SetFont('Times','', 10);
            $this->Cell(0,0,'OIC/ Principal',0,0,'C');
            

        }
    }

$pdf = new myPDF('p', 'mm', 'a4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle('HCAMIS INVOICE');
$pdf->head();
$pdf->content();
       
$pdf->Footer();
$pdf->Output();
?>