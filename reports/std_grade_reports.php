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
	        include '../database/connection.php';
	        $tid = mysqli_real_escape_string($con, $_POST['myID']);
	        $sched_id = mysqli_real_escape_string($con, $_POST['sched_id']);
	        $dept = mysqli_real_escape_string($con, $_POST['department']);
	        $class = mysqli_real_escape_string($con, $_POST['grade']);
	        $subject = mysqli_real_escape_string($con, $_POST['subject']);
	        $count = 1;
	        $_get = mysqli_query($con, "SELECT School_Year FROM academic_list WHERE is_default = 1");
	        $_row = mysqli_fetch_assoc($_get);
	        $this->SetFont('Times','BI',14);
	        $this->Cell(1);
	        $this->Cell(0,0,'Student Grade Reports',0,0,'C');
	        $this->Ln(6);
	        $this->SetFont('Times','I',12);
	        $this->Cell(1);
	        $this->Cell(0,0,''.$class.'',0,0,'C');
	        $this->Ln(5);
	        $this->SetFont('Times','I',11);
	        $this->Cell(1);
	        $this->Cell(0,0,''.$_row['School_Year'].'',0,0,'C');
	        $this->Ln(5);
	        $this->SetFont('Times','I',12);
	        $this->Cell(1);
	        $this->Cell(0,0,''.$subject.'',0,0,'C');
	        $this->Ln(5);

	        if ($dept == "SHSDEPT") {
	        	$this->SetFont('Times','BI',12);
		            $this->SetWidths(array(5, 30, 60, 30, 30, 30, 30, 30, 25, 40));
		            for($i=0;$i<1;$i++):
		            $this->Row(array('#','Student ID', 'Name', 'Prelim', 'Midterm', 'Finals','Overall', 'Remarks', 'Semester', 'AY'));
		        	endfor;
		        	$get_grade = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name FROM shs_grade inner join schedule on shs_grade.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join student on shs_grade.Student_ID = student.Student_ID ORDER BY Lastname ASC");
		        	while ($row_grade = mysqli_fetch_assoc($get_grade)) {
		        		$remarks = $row_grade['Final'] < 75 ? "Failed" : "Passed";
		        		$this->SetFont('Times','I',12);
			            $this->SetWidths(array(5, 30, 60, 30, 30, 30, 30, 30, 25, 40));
			            for($i=0;$i<1;$i++):
			            $this->Row(array(''.$count++.'',''.$row_grade['Student_ID'].'', ''.$row_grade['name'].'', ''.$row_grade['Prelim'].'', ''.$row_grade['Midterm'].'', ''.$row_grade['Final'].'', ''.$row_grade['Overall'].'', ''.$remarks.'', ''.$row_grade['Semester'].'', ''.$row_grade['AY'].''));
			        	endfor;
		        	}
	        }else{
	        	
	        	$this->SetFont('Times','BI',12);
		        $this->SetWidths(array(5, 30, 60, 30, 30, 30, 30, 30, 25, 40));
		            for($i=0;$i<1;$i++):
		        $this->Row(array('#','Student ID', 'Name', '1st Grading', '2nd Grading', '3rd Grading', '4th Grading', 'Final', 'Remarks', 'School Year'));
		       	endfor;

		       	$get_grade = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name FROM std_grade inner join schedule on std_grade.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join student on std_grade.Student_ID = student.Student_ID Where std_grade.Sched_ID = '$sched_id' ORDER BY Lastname ASC");
		       	while ($row_grade = mysqli_fetch_assoc($get_grade)) {
		       		$remarks = $row_grade['Final'] < 75 ? "Failed" : "Passed";
		       		$this->SetFont('Times','I',12);
			            $this->SetWidths(array(5, 30, 60, 30, 30, 30, 30, 30, 25, 40));
			            for($i=0;$i<1;$i++):
			            $this->Row(array(''.$count++.'',''.$row_grade['Student_ID'].'', ''.$row_grade['name'].'', ''.$row_grade['First'].'', ''.$row_grade['Second'].'', ''.$row_grade['Third'].'', ''.$row_grade['Fourth'].'', ''.$row_grade['Final'].'', ''.$remarks.'', ''.$row_grade['SY'].''));
			        	endfor;
		       	}
	        }

	        $_get_adviser = mysqli_query($con, "SELECT concat(Salutation, '. ', Firstname, ' ', Lastname) as adviser FROM schedule inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE schedule.ID = '$sched_id' AND schedule.Teacher_ID = '$tid'");
	        $_row_adviser = mysqli_fetch_assoc($_get_adviser);

	        $this->Ln(5);
	        $this->SetFont('Times','BI',12);
	        $this->Cell(1);
	        $this->Cell(0,0,'Class Adviser:',0,0,'L');
	        $this->Ln(0);
	        $this->Ln(5);
	        $this->SetFont('Times','I',12);
	        $this->Cell(1);
	        $this->Cell(0,0,''.$_row_adviser['adviser'].'',0,0,'L');
	        $this->Ln(0);
	       
    	}


	}

	$pdf = new myPDF('L', 'mm', array(330.2, 215.9));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle('Student Grade Reports');
    $pdf->head();
    $pdf->content();
   
    $pdf->Footer();
    $pdf->Output();
}

if (isset($_POST['export'])) {
    $sched_id = mysqli_real_escape_string($con, $_POST['sched_id']);
    $dept = mysqli_real_escape_string($con, $_POST['department']);
    $class = mysqli_real_escape_string($con, $_POST['grade']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $count = 1;

    function filterData(&$str){ 
	    $str = preg_replace("/\t/", "\\t", $str); 
	    $str = preg_replace("/\r?\n/", "\\n", $str); 
	    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
	    } 

	    $fileName = "std_grade-data_" . date('Y-m-d') . ".xls";

	    if ($dept == "SHSDEPT") {
	    	$fields = array('#', 'Code', 'Subject', 'Student ID', 'Name', 'Prelim', 'Midterm', 'Finals','Overall', 'Remarks', 'Semester', 'AY');
	    	$excelData = implode("\t", array_values($fields)) . "\n";

	    	$get_grade = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name FROM shs_grade inner join schedule on shs_grade.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join student on shs_grade.Student_ID = student.Student_ID ORDER BY Lastname ASC");
	    	while ($row_grade = mysqli_fetch_assoc($get_grade)) {
	    		$remarks = $row_grade['Final'] < 75 ? "Failed" : "Passed";
	    		$data = array(''.$count++.'', ''.$row_grade['Code'].'', ''.$row_grade['Description'].'', ''.$row_grade['Student_ID'].'', ''.$row_grade['name'].'', ''.$row_grade['Prelim'].'', ''.$row_grade['Midterm'].'', ''.$row_grade['Final'].'', ''.$row_grade['Overall'].'', ''.$remarks.'', ''.$row_grade['Semester'].'', ''.$row_grade['AY'].'');
	    	array_walk($data, 'filterData'); 
            $excelData .= implode("\t", array_values($data)) . "\n"; 
	    	}

	    }else{
	    	$fields = array('#', 'Code', 'Subject', 'Student ID', 'Name' , '1st Grading', '2nd Grading', '3rd Grading', '4th Grading', 'Final', 'Remarks', 'School Year');
	    	$excelData = implode("\t", array_values($fields)) . "\n";

	    	$get_grade = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name FROM std_grade inner join schedule on std_grade.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join student on std_grade.Student_ID = student.Student_ID Where std_grade.Sched_ID = '$sched_id' ORDER BY Lastname ASC");
	    	while ($row_grade = mysqli_fetch_assoc($get_grade)) {
	    	$remarks = $row_grade['Final'] < 75 ? "Failed" : "Passed";
	    	$data = array(''.$count++.'', ''.$row_grade['Code'].'', ''.$row_grade['Description'].'', ''.$row_grade['Student_ID'].'', ''.$row_grade['name'].'', ''.$row_grade['First'].'', ''.$row_grade['Second'].'', ''.$row_grade['Third'].'', ''.$row_grade['Fourth'].'', ''.$row_grade['Final'].'', ''.$remarks.'', ''.$row_grade['SY'].'');

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