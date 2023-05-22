<?php  
require("../FPDF/fpdf.php");
class myPDF extends FPDF{
	function content(){
        include '../database/connection.php';
        $date = date('Y-m-d');
        $num = $_GET['number'];
        $std_id = $_GET['std_id'];
        $query = mysqli_query($con, "SELECT *, concat(student.Firstname, ' ' , student.Lastname) as name, queuing.Contact as contact ,staff_tb.Cashier as cashier, queuing.Date as date FROM queuing inner join student on queuing.Student_ID = student.Student_ID inner join staff_tb on queuing.Cashier = staff_tb.Emp_ID WHERE Number = '$num' AND queuing.Student_ID = '$std_id' and queuing.Date = '$date'");
        $row = mysqli_fetch_assoc($query);
        $name = $row['name'];
        $date = date('F j, Y', strtotime($row['date']));
        $this->SetFont('Courier','',12);
        $this->Cell(1);
        $this->Cell(0,0,'HCA QUEUING SYSTEM',0,0,'C');
        $this->Ln(6);
        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,'',1,0,'L');
        $this->Ln(6);

        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,'Name: '.$name.'',0,0,'L');
        $this->Ln(5);
        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,'Contact: '.$row['contact'].'',0,0,'L');
        $this->Ln(5);
        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,'Purpose: '.$row['Purpose'].'',0,0,'L');
        $this->Ln(5);
        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,'Cashier: '.$row['cashier'].'',0,0,'L');
        $this->Ln(5);
        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,'Date: '.$date.'',0,0,'L');
        $this->Ln(5);
        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,'',1,0,'L');
        $this->Ln(5);
        $this->SetFont('Times','B',14);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['Number'].'',0,0,'C');
        $this->Ln(6);
        $this->SetFont('Times','B',14);
        $this->Cell(1);
        $this->Cell(0,0,'',1,0,'L');
        $this->Ln(6);
        $this->SetFont('Times','',14);
        $this->Cell(1);
        $this->Cell(0,0,'Thank you!',0,0,'C');
        $this->Ln(5);
    }
}

$pdf = new myPDF('L', 'mm', array(85, 85));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle('Queue Number');
$pdf->content();

$pdf->Output();

?>