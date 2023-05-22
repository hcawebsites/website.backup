<?php  
include_once '../database/connection.php';
require("../FPDF/fpdf.php");

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
	            $this->SetFont('Times','I',8);
	            $this->Cell(0,0,'Page '.$this->PageNo().'/{nb}',0,0,'R');
	    }

	    function title(){ 
	        include '../database/connection.php';
	        $query = "SELECT * FROM academic_list WHERE is_default = '1'";
	        $res = mysqli_query($con, $query);
	        $row = mysqli_fetch_assoc($res);
	        $this->SetFont('Arial','BI',12);
	        $this->Cell(1);
	        $this->Cell(0,0,'Student Attendance Reports',0,0,'C');
	        $this->Ln(5);
	        $this->SetFont('Arial','',10);
	        $this->Cell(1);
	        $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
	        $this->Ln(7);
	    }

	    function content(){
	    	include "../database/connection.php";
	    	$count = 1;
			$sched_id = mysqli_real_escape_string($con, $_POST['subject']);
			$from = mysqli_real_escape_string($con, $_POST['from']);
			$to = mysqli_real_escape_string($con, $_POST['to']);
			$myID = mysqli_real_escape_string($con, $_POST['myID']);

			$this->SetFont('Arial','BI', 11);
	        $this->SetWidths(array(5, 30, 50, 50, 50, 30, 30, 30, 35, 30));
	        for($i=0;$i<1;$i++):
	        $this->Row(array('#', 'Student ID', 'Name', 'Subject', 'Class' , 'Time In', 'Time Out', 'Remarks', 'Date'));
	        endfor;

			if ($sched_id == "" AND $from == "" AND $to == "") {
					$count = 1;
					$_get_attendance = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name, std_attendance.Status as status, std_attendance.Date as date FROM std_attendance inner join schedule on std_attendance.Sched_ID = schedule.ID inner join student_grade on std_attendance.Student_ID = student_grade.Student_ID inner join student on student_grade.Student_ID = student.Student_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID Where schedule.Teacher_ID = '$myID' ORDER BY std_attendance.ID ASC");
					while ($_row = mysqli_fetch_assoc($_get_attendance)) {
						$class = $_row['Name']. " " .$_row['Strand']. " - " .$_row['Section'];
						$in = date('h:i A', strtotime($_row['Time_In'] ?? ''));
						$out = date('h:i A', strtotime($_row['Time_Out'] ?? ''));
						$date = date('F j, Y', strtotime($_row['date']));
						$this->SetFont('Arial','I', 10);
				        $this->SetWidths(array(5, 30, 50, 50, 50, 30, 30, 30, 35, 30));
				        for($i=0;$i<1;$i++):
				        $this->Row(array(''.$count++.'', ''.$_row['Student_ID'].'', ''.$_row['name'].'', ''.$_row['Description'].'', ''.$class.'' , ''.$in.'', ''.$out.'', ''.$_row['status'].'', ''.$date.''));
				        endfor;
					}
				
			}else{
				$count = 1;
				$get = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name, std_attendance.Status as status, std_attendance.Date as date FROM std_attendance inner join schedule on std_attendance.Sched_ID = schedule.ID inner join student_grade on std_attendance.Student_ID = student_grade.Student_ID inner join student on student_grade.Student_ID = student.Student_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID Where schedule.Teacher_ID = '$myID' AND std_attendance.Sched_ID = '$sched_id' AND std_attendance.Date BETWEEN '$from' AND '$to' ORDER BY std_attendance.ID ASC");
				while ($_row = mysqli_fetch_assoc($get)) {
					$class = $_row['Name']. " " .$_row['Strand']. " - " .$_row['Section'];
					$in = date('h:i A', strtotime($_row['Time_In']));
					$out = date('h:i A', strtotime($_row['Time_Out']));
					$date = date('F j, Y', strtotime($_row['date']));
					$this->SetFont('Arial','I', 10);
			        $this->SetWidths(array(5, 30, 50, 50, 50, 30, 30, 30, 35, 30));
			        for($i=0;$i<1;$i++):
			        $this->Row(array(''.$count++.'', ''.$_row['Student_ID'].'', ''.$_row['name'].'', ''.$_row['Description'].'', ''.$class.'' , ''.$in.'', ''.$out.'', ''.$_row['status'].'', ''.$date.''));
			        endfor;
				}
			}

			$this->Ln(5);
		    $this->SetFont('Arial','I',12);
		    $this->Cell(1);
		    $this->Cell(0,0,'Adviser:',0,0,'L');
		    $this->Ln(6);

		    $get = mysqli_query($con, "SELECT * FROM teacher_tb Where Emp_ID = '$myID'");
		    $row = mysqli_fetch_assoc($get);
		    $name = $row['Salutation']. ". " .$row['Firstname']. " " .$row['Middlename']. " " .$row['Lastname'];

		    $this->SetFont('Arial','B',12);
		    $this->Cell(1);
		    $this->Cell(0,0,''.$name.'',0,0,'L');

	    }
	}


    $pdf = new myPDF('L', 'mm', array(330.2, 215.9));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle('HCA STAFF ATTENDANCE LIST');
    $pdf->head();
    $pdf->title();
    $pdf->content();

    $pdf->Footer();
    $pdf->Output();
}

if (isset($_POST['excel'])) {
	$count = 1;
	$sched_id = mysqli_real_escape_string($con, $_POST['subject']);
	$from = mysqli_real_escape_string($con, $_POST['from']);
	$to = mysqli_real_escape_string($con, $_POST['to']);
	$myID = mysqli_real_escape_string($con, $_POST['myID']);

	if ($sched_id == "" AND $from == "" AND $to == "") {
		function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
        } 

        $fileName = "std_attendance-data_" . date('Y-m-d') . ".xls";

        $fields = array('#', 'Student ID', 'Name', 'Subject', 'Class' , 'Time In', 'Time Out', 'Remarks', 'Date');
        $excelData = implode("\t", array_values($fields)) . "\n"; 

        $count = 1;
		$_get_attendance = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name, std_attendance.Status as status, std_attendance.Date as date FROM std_attendance inner join schedule on std_attendance.Sched_ID = schedule.ID inner join student_grade on std_attendance.Student_ID = student_grade.Student_ID inner join student on student_grade.Student_ID = student.Student_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID Where schedule.Teacher_ID = '$myID' ORDER BY std_attendance.ID ASC");
		while ($_row = mysqli_fetch_assoc($_get_attendance)) {
			$class = $_row['Name']. " " .$_row['Strand']. " - " .$_row['Section'];
			$in = date('h:i A', strtotime($_row['Time_In']));
			$out = date('h:i A', strtotime($_row['Time_Out']));
			$date = date('F j, Y', strtotime($_row['date']));

			$data = array(''.$count++.'', ''.$_row['Student_ID'].'', ''.$_row['name'].'', ''.$_row['Description'].'', ''.$class.'' , ''.$in.'', ''.$out.'', ''.$_row['status'].'', ''.$date.'');

			array_walk($data, 'filterData'); 
            $excelData .= implode("\t", array_values($data)) . "\n"; 
		}
	}else{
		$get = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name, std_attendance.Status as status, std_attendance.Date as date FROM std_attendance inner join schedule on std_attendance.Sched_ID = schedule.ID inner join student_grade on std_attendance.Student_ID = student_grade.Student_ID inner join student on student_grade.Student_ID = student.Student_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID Where schedule.Teacher_ID = '$myID' AND std_attendance.Sched_ID = '$sched_id' AND std_attendance.Date BETWEEN '$from' AND '$to' ORDER BY std_attendance.ID ASC");
			while ($_row = mysqli_fetch_assoc($get)) {
				$class = $_row['Name']. " " .$_row['Strand']. " - " .$_row['Section'];
				$in = date('h:i A', strtotime($_row['Time_In'] ?? ''));
				$out = date('h:i A', strtotime($_row['Time_Out'] ?? ''));
				$date = date('F j, Y', strtotime($_row['date']));

				$data = array(''.$count++.'', ''.$_row['Student_ID'].'', ''.$_row['name'].'', ''.$_row['Description'].'', ''.$class.'' , ''.$in.'', ''.$out.'', ''.$_row['status'].'', ''.$date.'');

			array_walk($data, 'filterData'); 
            $excelData .= implode("\t", array_values($data)) . "\n"; 
			}

	}

	header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    
    // Render excel data 
    echo $excelData; 
    
    exit;
}

?>