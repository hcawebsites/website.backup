<?php  
require("../FPDF/fpdf.php");
class myPDF extends FPDF{
    function head(){
        $this->Image('../assets/image/deped2.png', 10, 3, 20);

        $this->Image('../assets/image/logo.png', 120, 3, 20);
        $this->SetFont('Times','',8);
        $this->Cell(1);
        $this->Cell(0,0,'Republic of the Philippines',0,0,'C');
        $this->Ln(4);
        $this->Cell(1);
        $this->SetFont('Times','',12);
        $this->Cell(0,0,'Department of Education',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,'Holy Child Academy',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,'Oct. 16th Street, Poblacion, Binalonan, Pangasinan',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,'',1,0,'C');
        $this->Ln(5);
    
        }

	function content(){
        include '../database/connection.php';
        $date = date('Y-m-d');
        $std_id = $_GET['std_id'];
        $query = mysqli_query($con, "SELECT *, payment_history.QR_Code as qrcode, concat(student.Firstname, ', ' , student.Lastname, ' ', student.Middlename) as name from student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join payments on student.Student_ID = payments.Student_ID inner join payment_history on student.Student_ID = payment_history.Student_ID inner join staff_tb on payment_history.Cashier_ID = staff_tb.Emp_ID inner join grade on student_grade.Class_ID = grade.ID WHERE payments.Student_ID = '$std_id' AND payment_history.Date = '$date'");
        $row = mysqli_fetch_assoc($query);
        $date = date('F j, Y', strtotime($row['Date']));
        $this->SetFont('Courier','B',12);
        $this->Cell(1);
        $this->Cell(0,1,'OFFICIAL RECEIPT '.$row['OR_Number'].'',0,0,'C');
        $this->Ln(6);
        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,'',1,0,'L');
        $this->Ln(3);

        $this->SetFont('Times','B',8);
        $this->Cell(1);
        $this->Cell(0,0,'RECEIVED FROM (Last Name, First Name, Middle Name)',0,0,'L');
        $this->Ln(5);
        
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['name'].'',0,0,'L');
        $this->Ln(3);   
        $this->Ln(3);
        $this->SetFont('Times','B',8);
        $this->Cell(1);
        $this->Cell(0,0,'ADDRESS (Barangay, Municipality, Province)',0,0,'L');
        $this->Ln(5);
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['Address'].'',0,0,'L');
        $this->Ln(3);
        $this->Cell(0,0,'',1,0,'L');
        $this->Ln(1);
        $this->Image('../payment_qrcode/'.$row['qrcode'].'', 120, 44, 15, );
        $this->Ln(1);

        $this->SetFont('Times','B', 10);
        $this->Cell(1);
        $this->Cell(43, 6, 'Description', 1, 0, 'L');
        $this->Cell(43, 6, 'Amount', 1, 0, 'L');
        $this->Cell(43, 6, 'Type of Payment', 1, 0, 'L');
        $this->Ln();

         $this->SetFont('Times','', 10);
        $this->Cell(1);
        $this->Cell(43, 8, 'Payment', 1, 0, 'L');
        $this->Cell(43, 8, ''.$row['Paid_Amount'].'', 1, 0, 'L');
        $this->Cell(43, 8, ''.$row['Payment_Type'].'', 1, 0, 'L');
        $this->Ln(12);
        $sql1 = mysqli_query($con, "SELECT * FROM fees");
        
        while ($row1 = mysqli_fetch_assoc($sql1)) {
            $this->SetFont('Times','B',10);
            $this->Cell(1);
            $this->Cell(0,0,''.$row1['Description'].':',0,0,'L');
            $this->Cell(0,0,''.$row1['Amount'].'',0,0,'R');
            $this->Ln(6);
        }

        $total = $row['Balance'] + $row['Paid_Amount'];
        $this->Cell(0,0,'',1,0,'R');
        $this->Ln(3);
        $this->SetFont('Times','B',10);
        $this->Cell(1);
        $this->Cell(0,0,'Total:',0,0,'L');
        $this->Cell(0,0,''.$total.'',0,0,'R');
        $this->Ln(5);
        $this->Cell(1);
        $this->Cell(0,0,'Paid:',0,0,'L');
        $this->Cell(0,0,''.$row['Paid_Amount'].'',0,0,'R');
        $this->Ln(1);
        $this->Cell(0,0,'',0,0,'R');
        $this->Ln(4);
        $this->Cell(1);
        $this->Cell(0,0,'Balance:',0,0,'L');
        $this->Cell(0,0,''.$row['Balance'].'',0,0,'R');
        $this->Ln(7);
        $this->Cell(1);
        $this->SetFont('Times','BU',10);
        $this->Cell(0,0,''.$row['Salutation'].'. '.$row['Lastname'].' '.$row['Firstname'].'',0,0,'C');
        $this->Ln(3);
        $this->SetFont('Times','',8);
        $this->Cell(0,0,'Cashier',0,0,'C');
    }
}

$pdf = new myPDF('L', 'mm', array(150, 150));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle('OFFICIAL RECEIPT');
$pdf->head();
$pdf->content();

$pdf->Output();

?>