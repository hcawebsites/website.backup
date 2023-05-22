<?php  
include_once '../database/connection.php';
require("../FPDF/fpdf.php");
$count = 1;

if (isset($_POST['print'])) {

	class myPDF extends FPDF{
		protected $widths;
    protected $aligns;

    function SetWidths($w)
    {
        // Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        // Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data)
    {
        // Calculate the height of the row
        $nb = 0;
        for($i=0;$i<count($data);$i++)
            $nb = max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h = 5*$nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x,$y,$w,$h);
            // Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            // Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        // Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        // If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        // Compute the number of lines a MultiCell of width w will take
        if(!isset($this->CurrentFont))
            $this->Error('No font has been set');
        $cw = $this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
        $s = str_replace("\r",'',(string)$txt);
        $nb = strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i<$nb)
        {
            $c = $s[$i];
            if($c=="\n")
            {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep = $i;
            $l += $cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i = $sep+1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

    function head(){
        $this->Image('../assets/image/logo.png', 80, 5, 25);
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
    		include '../database/connection.php';
        	$aid = mysqli_real_escape_string($con, $_POST['myID']);
        	$count = 1;
        	$getAcadYear = mysqli_query($con, "SELECT School_Year, Semester From academic_list Where is_default = 1");
	    	$rowAcad = mysqli_fetch_assoc($getAcadYear);
	    	$sy = $rowAcad['School_Year'];
        	$this->SetFont('Times','B',12);
            $this->Cell(1);
            $this->Cell(0,0,"Student Payment Reports",0,0,'C');
            $this->Ln(5);
            $this->SetFont('Times','',10);
            $this->Cell(1);
            $this->Cell(0,0,'S.Y: '.$sy.'',0,0,'C');
            $this->Ln(6);

            $this->SetFont('Times','BI',12);
            $this->SetWidths(array(10, 50, 30, 50, 30, 30, 30, 40, 40));
            for($i=0;$i<1;$i++):
            $this->Row(array('#','OR Number', 'Student ID', 'Name', 'Amount', 'Balance', 'Total', 'Status', 'Date'));
            endfor;

            $get = mysqli_query($con, "SELECT *, payments.Balance, payment_history.Balance as bal from payments inner join payment_history on payments.Student_ID = payment_history.Student_ID inner join student on payment_history.Student_ID = student.Student_ID Order By payment_history.Student_ID ASC");

            if (mysqli_num_rows($get) > 0) {
            	while ($row = mysqli_fetch_assoc($get)) {
            		$name = $row['Lastname']. " " .$row['Firstname']. " " .$row['Middlename'];
            		$date = date('F j, Y', strtotime($row['Date']));
            			$this->SetFont('Times','I',11);
			            $this->SetWidths(array(10, 50, 30, 50, 30, 30, 30, 40, 40));
			            for($i=0;$i<1;$i++):
			            $this->Row(array(''.$count++.'',''.$row['OR_Number'].'', ''.$row['Student_ID'].'', ''.$name.'', ''.$row['Paid_Amount'].'', ''.$row['bal'].'', ''.$row['Total'].'', ''.$row['Payment_Type'].'', ''.$date.''));
			            endfor;
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

	$pdf = new myPDF('L', 'mm', array(330.2, 215.9));
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetTitle('Payments Reports');
	$pdf->head();
	$pdf->content();


	$pdf->Footer();
	$pdf->Output();
}

if (isset($_POST['excel'])) {
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 

    $fileName = "payment_report_" . date('Y-m-d') . ".xls";

    $fields = array('#','OR Number', 'Student ID', 'Name', 'Amount', 'Balance', 'Total', 'Status', 'Date');
    $excelData = implode("\t", array_values($fields)) . "\n";

    $get = mysqli_query($con, "SELECT *, payments.Balance, payment_history.Balance as bal from payments inner join payment_history on payments.Student_ID = payment_history.Student_ID inner join student on payment_history.Student_ID = student.Student_ID Order By payment_history.Student_ID ASC");

    if (mysqli_num_rows($get) > 0) {
    	while ($row = mysqli_fetch_assoc($get)) {
    		$name = $row['Lastname']. " " .$row['Firstname']. " " .$row['Middlename'];
    		$date = date('F j, Y', strtotime($row['Date']));

	        	$data = array(''.$count++.'',''.$row['OR_Number'].'', ''.$row['Student_ID'].'', ''.$name.'', ''.$row['Paid_Amount'].'', ''.$row['bal'].'', ''.$row['Total'].'', ''.$row['Payment_Type'].'', ''.$date.'');
	        	
                
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