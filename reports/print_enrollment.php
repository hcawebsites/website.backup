<?php  
require("../FPDF/fpdf.php");

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
        $this->Image('../assets/image/logo.png', 10, 6, 20);
        include ('../database/connection.php');
        $student_id = $_GET['id'];
        $sql = "SELECT Picture as image FROM student WHERE student.Student_ID = '$student_id'";
        $result  = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $image = $row['image'];
            $this->Image('../assets/upload/'.$image.'', 165, 6, 35);
        }
        $this->SetFont('Times','I',18);
        $this->Cell(22);
        $this->Cell(0,0,'Diocesan Schools of Urdaneta',0,0,'L');
        $this->Ln(2);
        $this->SetFont('Times','I',16);
        $this->Cell(22);
        $this->Cell(280,10,'Holy Child Academy',0,0,'L');
        $this->Ln(6);
        $this->SetFont('Times','I',14);
        $this->Cell(22);
        $this->Cell(280,10,'Oct. 16th Street, Poblacion, Binalonan, Pangasinan, 2428',0,0,'L');
        $this->Ln(30);
    
    }

    function Content(){
    	include ('../database/connection.php');
        $student_id = $_GET['id'];
        $count = 1;
        

        $this->SetFont('Courier','B', 20);
        $this->Cell(80);
        $this->Cell(30,0,'Enrollment Form',0,0,'C');
        $this->Ln(10);

        $_get = mysqli_query($con, "SELECT *, Concat(Firstname, ' ', Middlename, ' ', Lastname) as name FROM student Where Student_ID = '$student_id'");
        while ($_row = mysqli_fetch_assoc($_get)) {
        	$reference =(sprintf("%'.04d",$_row['ID']));
        	$date = date('F j, Y', strtotime($_row['Application_Date']));

        	$this->SetFont('Times','I', 12);
            $this->Cell(1);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(45, 6, 'Student Copy Number:', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(30, 6, ''.$reference.'', 0, 0, 'L');
            $this->Cell(40, 6, '', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->Cell(30, 6, 'Student Type:', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(30, 6, ''.$_row['Student_Type'].'', 0, 0, 'L');
            $this->Ln();

            $this->SetFont('Times','I', 12);
            $this->Cell(1);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(45, 6, 'Student ID:', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(30, 6, ''.$_row['Student_ID'].'', 0, 0, 'L');
            $this->Cell(40, 6, '', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->Cell(30, 6, '', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(30, 6, '', 0, 0, 'L');
            $this->Ln();

            $this->SetFont('Times','I', 12);
            $this->Cell(1);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(45, 6, 'Student Name:', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(60, 6, ''.$_row['name'].'', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->Cell(40, 6, '', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(30, 6, '', 0, 0, 'L');
            $this->Ln();

            $this->SetFont('Times','I', 12);
            $this->Cell(1);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(45, 6, 'Date of Registration:', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(60, 6, ''.$date.'', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->Cell(40, 6, '', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(30, 6, '', 0, 0, 'L');
            $this->Ln();

            $this->SetFont('Times','I', 12);
            $this->Cell(1);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(45, 6, 'School Year:', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(70, 6, ''.$_row['SY'].'', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->Cell(30, 6, 'Grade:', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(30, 6, ''.$_row['Grade'].'', 0, 0, 'L');
            $this->Ln();

            $this->SetFont('Times','I', 12);
            $this->Cell(1);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(45, 6, 'Semester', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(70, 6, ''.$_row['Semester'].'', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->Cell(30, 6, 'Strand:', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(30, 6, ''.$_row['Strand'].'', 0, 0, 'L');
            $this->Ln(10);

            $this->SetFont('Times','B', 20);
            $this->Cell(1);
            $this->Cell(0,0,'',1,0,'L');
            $this->Ln(3);

            $this->SetFont('Times','BI', 12);
            $this->Cell(1);
            $this->Cell(10, 6, 'Requirements (Check if available)', 0, 0, 'L');
            $this->Cell(45, 6, '', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(70, 6, '', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->Cell(30, 6, '', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(30, 6, '', 0, 0, 'L');
            $this->Ln();

            $this->SetFont('Times','I', 12);
            $this->Cell(1);
            $this->Cell(10, 6, 'Photocopy of:', 0, 0, 'L');
            $this->Cell(45, 6, '', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(70, 6, '', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->Cell(30, 6, '', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(30, 6, '', 0, 0, 'L');
            $this->Ln(10);

            
            $this->Cell(1);
            $this->SetFont('Times','I', 12);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(10, 6, '', 1, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(70, 6, 'PSA Birth Certificate', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->SetFont('Times','I', 12);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(10, 6, '', 1, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(50, 6, 'SF 9 | Form 13 / Card', 0, 0, 'L');
            $this->Ln();

            $this->Cell(1);
            $this->SetFont('Times','I', 12);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(10, 6, '', 1, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(70, 6, 'Baptisimal / Confirmation Certificate', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->SetFont('Times','I', 12);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(10, 6, '', 1, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(50, 6, 'SF 10 | Form 137', 0, 0, 'L');
            $this->Ln();

            $this->Cell(1);
            $this->SetFont('Times','I', 12);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(10, 6, '', 1, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(70, 6, 'Good Moral Certificate', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->SetFont('Times','I', 12);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(10, 6, '', 1, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(90, 6, '2x2 Picture (White Background and Name Tag)', 0, 0, 'L');
            $this->Ln();


            $this->Cell(1);
            $this->SetFont('Times','I', 12);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->Cell(10, 6, '', 1, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(70, 6, 'Certificate Completion', 0, 0, 'L');
            $this->SetFont('Times','I', 12);
            $this->SetFont('Times','I', 12);
            $this->Cell(10, 6, '', 0, 0, 'L');
            $this->SetFont('Times','BI', 12);
            $this->Cell(50, 6, '', 0, 0, 'L');
            $this->Ln(10);

            $this->SetFont('Times','B', 20);
            $this->Cell(1);
            $this->Cell(0,0,'',1,0,'L');
            $this->Ln(5);

            $this->SetFont('Times','BI',12);
            $this->SetWidths(array(5, 25, 45, 26, 30, 30, 35));
            for($i=0;$i<1;$i++):
            $this->Row(array('#','Code', 'Description', 'Room', 'Days', 'Time', 'Teacher'));
        	endfor;

            $_get_subject = mysqli_query($con, "SELECT *, concat(Salutation, '. ' , Lastname) as adviser FROM handle_student inner join schedule on handle_student.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join time on schedule.Time_ID = time.time_id WHERE handle_student.Student_ID = '$student_id'");
            while ($_row_subject = mysqli_fetch_assoc($_get_subject)) {
            	$room = $_row_subject['Room'] == "Online" ? "TBA" : $_row_subject['Room'];
            	$time = $_row_subject['time_start']. " - " . $_row_subject['time_end'];

            	$this->SetFont('Times','I',12);
	            $this->SetWidths(array(5, 25, 45, 26, 30, 30, 35));
	            for($i=0;$i<1;$i++):
	            $this->Row(array(''.$count++.'',''.$_row_subject['Code'].'', ''.$_row_subject['Description'].'', ''.$room.'', ''.$_row_subject['Day'].'', ''.$time.'', ''.$_row_subject['adviser'].''));
	        	endfor;
	            	
	            }

	            $this->Ln(10);
	            $this->Cell(1);
	            $this->SetFont('Times','BI', 12);
	            $this->Cell(97, 6, 'Assessment Of Fees', 1, 0, 'L');
	            $this->Ln();
	            $this->Cell(1);
	            $this->SetFont('Times','I', 12);
	            $this->Cell(60, 6, 'Type of Payment', 1, 0, 'L');
	            $this->Cell(37, 6, 'Amount', 1, 0, 'L');
	            $this->Ln();



	            $fees = mysqli_query($con, "SELECT * from fees inner join grade on fees.Grade_ID = grade.ID inner join student_grade on grade.ID = student_grade.Class_ID Where student_grade.Student_ID = '$student_id'");

	            $total = mysqli_query($con, "SELECT sum(Amount) as amount from fees inner join grade on fees.Grade_ID = grade.ID inner join student_grade on grade.ID = student_grade.Class_ID Where student_grade.Student_ID = '$student_id'");
	            $_row_total = mysqli_fetch_assoc($total);

		        while ($row=mysqli_fetch_assoc($fees)) {
		            $this->SetFont('Courier','', 14);
		            $this->Cell(1);
		            $this->Cell(60,6,''.$row['Description'].'',1,0,'L');
		            $this->Cell(37,6,''.$row['Amount'].'',1,0,'L');
		            $this->Ln();
		        }
		        $this->SetFont('Courier','', 14);
	            $this->Cell(1);
	            $this->Cell(60,6,'Total',1,0,'L');
	            $this->Cell(37,6,''.$_row_total['amount'].'',1,0,'L');
	            $this->Ln();

	            $this->Ln(-36);
	            $this->Cell(98);
	            $this->SetFont('Times','BI', 12);
	            $this->Cell(97, 6, 'First Payment Details', 1, 0, 'L');
	            $this->Ln();

	            $_get_payment = mysqli_query($con, "SELECT * FROM payment_history WHERE Student_ID = '$student_id' LIMIT 1");
	            while ($_row_payment = mysqli_fetch_assoc($_get_payment)) {
	            	$total = $_row_payment['Balance'] + $_row_payment['Paid_Amount'];
	            	$this->Cell(98);
		            $this->SetFont('Times','I', 12);
		            $this->Cell(50, 6, 'Official Receipt', 1, 0, 'L');
		            $this->Cell(47, 6, ''.$_row_payment['OR_Number'].'', 1, 0, 'L');
		            $this->Ln();

		            $this->Cell(98);
		            $this->SetFont('Times','I', 12);
		            $this->Cell(50, 6, 'Date', 1, 0, 'L');
		            $this->Cell(47, 6, ''.date('F j, Y', strtotime($_row_payment['Date'])).'', 1, 0, 'L');
		            $this->Ln();

		            $this->Cell(98);
		            $this->SetFont('Times','I', 12);
		            $this->Cell(50, 6, 'Payment Type', 1, 0, 'L');
		            $this->Cell(47, 6, ''.$_row_payment['Payment_Type'].'', 1, 0, 'L');
		            $this->Ln();

		            $this->Cell(98);
		            $this->SetFont('Times','I', 12);
		            $this->Cell(50, 6, 'Total', 1, 0, 'L');
		            $this->Cell(47, 6, ''.$total.'', 1, 0, 'L');
		            $this->Ln();

		            $this->Cell(98);
		            $this->SetFont('Times','I', 12);
		            $this->Cell(50, 6, 'Paid Amount', 1, 0, 'L');
		            $this->Cell(47, 6, ''.$_row_payment['Paid_Amount'].'', 1, 0, 'L');
		            $this->Ln();

		            $this->Cell(98);
		            $this->SetFont('Times','I', 12);
		            $this->Cell(50, 6, 'Balance', 1, 0, 'L');
		            $this->Cell(47, 6, ''.$_row_payment['Balance'].'', 1, 0, 'L');
		            $this->Ln(10);
	            }
            $this->SetFont('Times','B', 20);
            $this->Cell(1);
            $this->Cell(0,0,'',1,0,'C');
            $this->Ln(5); 

            $_get_student_info = mysqli_query($con, "SELECT * FROM student Where Student_ID = '$student_id'");
            while ($row = mysqli_fetch_assoc($_get_student_info)) {
            	$this->SetFont('Courier','B', 12);
		      	$this->Cell(1);
		      	$this->Cell(0,8,'Student ID: '.$row['Student_ID'].'',0,0,'L');
		      	$this->Ln(5);

		      	$this->SetFont('Courier','B', 12);
		      	$this->Cell(1);
			    $this->Cell(0,8,'Student Name: '.$row['Lastname'].', '.$row['Firstname'].', '.$row['Middlename'].'',0,0,'L');
			    $this->Ln(5);

			    $this->SetFont('Courier','B', 12);
			    $this->Cell(1);
			    $this->Cell(0,8,'Age: '.$row['Age'].' Years Old',0,0,'L');
			    $this->Ln(5);

			    $this->SetFont('Courier','B', 12);
			    $this->Cell(1);
			    $this->Cell(0,8,'Address: '.$row['Address'].'',0,0,'L');
			    $this->Ln(5);

			    $this->SetFont('Courier','B', 12);

				$this->Cell(1);
				$this->Cell(0,8,'Date of Birth: '.date('F j, Y', strtotime($row['DOB'])).'',0,0,'L');
				$this->Ln(5);

				$this->SetFont('Courier','B', 12);
				$this->Cell(1);
				$this->Cell(0,8,'Place of Birth: '.$row['POB'].'',0,0,'L');
				$this->Ln(5);

				$this->SetFont('Courier','B', 12);
				$this->Cell(1);
				$this->Cell(0,8,'Name of Guardian: '.$row['GLastname'].', '.$row['GFirstname'].', '.$row['GMiddlename'].'',0,0,'L');
				$this->Ln(5);
				$this->SetFont('Courier','B', 12);
				$this->Cell(1);
				$this->Cell(0,8,'Guardians Contact: '.$row['GContact'].'',0,0,'L');
				$this->Ln(5);

				$this->SetFont('Courier','B', 12);
				$this->Cell(1);
				$this->Cell(0,8,'Last School Attended: '.$row['SLA'].'',0,0,'L');
				$this->Ln(5);

				$this->SetFont('Courier','B', 12);
				$this->Cell(1);
				$this->Cell(0,8,'Last School Year Attended: '.$row['LSYA'].'',0,0,'L');
				$this->Ln(5);

				$this->SetFont('Courier','B', 12);
				$this->Cell(1);
				$this->Cell(0,8,'LRN: '.$row['LRN'].'',0,0,'L');
				$this->Ln(5);

				$this->SetFont('Courier','B', 12);
				$this->Cell(1);
				$this->Cell(0,8,'General Average: '.$row['Gen_Ave'].'',0,0,'L');
				$this->Ln(5);

				$this->SetFont('Courier','B', 12);
				$this->Cell(1);
				$this->Cell(0,8,'Student Contact: '.$row['Phone'].'',0,0,'L');
				$this->Ln(40);

				$this->Cell(10);
				$this->SetFont('Times','B', 12);
				$this->Cell(0,0,'_____________________________________',0,0,'L');
				$this->Ln();

				$this->Cell(102);
				$this->SetFont('Times','B', 12);
				$this->Cell(0,0,'_____________________________________',0,0,'L');
				$this->Ln(5);

				$this->Cell(21);
				$this->SetFont('Times','', 10);
				$this->Cell(0,0,'Signature over Printed Name of Student',0,0,'L');
				$this->Ln();

				$this->Cell(107);
				$this->SetFont('Times','', 10);
				$this->Cell(0,0,'Signature over Printed Name of Parents/Guardian',0,0,'L');
				$this->Ln(30);


             } 
				$this->Cell(1);
		        $this->SetFont('Times','', 12);
		        $this->Cell(0,0,'Evaluated by:',0,0,'C');
		        $this->Ln(15);

		        $this->Cell(1);
		        $this->SetFont('Times','BU', 12);
		        $this->Cell(0,0,'                                            ',0,0,'C');
		        $this->Ln(5);
		        $this->Cell(1);
		        $this->SetFont('Times','', 10);
		        $this->Cell(0,0,'Registrar/ Cashier',0,0,'C');
		        $this->Ln(25);

		        
		        $this->SetFont('Times','', 12);
		        $this->Cell(0,0,'Approve by:',0,0,'C');
		        $this->Ln(15);

		        $this->SetFont('Times','BU', 12);
		        $this->Cell(0,0,'                                            ',0,0,'C');
		        $this->Ln(5);

		        $this->SetFont('Times','', 10);
		        $this->Cell(0,0,'OIC/ Principal',0,0,'C');







        }

    }

    function Footer(){
        $this->SetY(-30);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,0,'Page '.$this->PageNo().'/{nb}',0,0,'R');
	}
}




if (isset($_POST['print'])) {
$pdf = new myPDF('p', 'mm', array(215.9, 330.2));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle('Holy Child Academy Enrollment Form');
$pdf->head();
$pdf->Content();
$pdf->Footer();
$date = date('Y-m-d');
$pdf->Output('', 'student_form_'.$date.'.pdf', true);

}

?>