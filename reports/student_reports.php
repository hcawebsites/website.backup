<?php
include_once('../database/connection.php');
require("../FPDF/fpdf.php");
error_reporting(0);

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

        function content(){
        include '../database/connection.php';
        $grade = mysqli_real_escape_string($con, $_POST['grade']);
        $strand = mysqli_real_escape_string($con, $_POST['strand']);
        $tid = mysqli_real_escape_string($con, $_POST['myID']);
        $count = 1;
        
        $getAcadYear = mysqli_query($con, "SELECT School_Year, Semester From academic_list Where is_default = 1");
    	$rowAcad = mysqli_fetch_assoc($getAcadYear);
    	$semester = $rowAcad['Semester'];
    	$sy = $rowAcad['School_Year'];

        $_get = mysqli_query($con, "SELECT * FROM grade WHERE ID = '$grade'");
        $row = mysqli_fetch_assoc($_get);
        $dept = $row['Department'];
        $class = $row['Name']. " " . $strand. " - " .$row['Section'];

        if ($dept == "SHSDEPT") {
            $this->SetFont('Times','B',14);
            $this->Cell(1);
            $this->Cell(0,0,"Students Master List",0,0,'C');
            $this->Ln(6);
            $this->SetFont('Times','',12);
            $this->Cell(1);
            $this->Cell(0,0,''.$class.'',0,0,'C');
            $this->Ln(6);
            $this->SetFont('Times','',12);
            $this->Cell(1);
            $this->Cell(0,0,''.$sy.'',0,0,'C');
            $this->Ln(6);

            $this->SetFont('Times','',12);
            $this->Cell(1);
            $this->Cell(0,0,''.$semester.'',0,0,'C');
            $this->Ln(7);

            $this->SetFont('Times','BI',12);
            $this->SetWidths(array(10, 45, 60, 30, 40, 50, 40, 35));
            for($i=0;$i<1;$i++):
            $this->Row(array('#','LRN', 'Name', 'Gender', 'Contact', 'Parents', 'Contact', 'Date'));
            endfor;

            $_get_student = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as std_name, concat(GFirstname, ' ' , GLastname) as gname FROM student_grade inner join student on student_grade.Student_ID = student.Student_ID WHERE Class_ID = '$grade' AND student_grade.Strand = '$strand'");
            while ($_row_student = mysqli_fetch_assoc($_get_student)) {
                $date = date('F j, Y', strtotime($_row_student['Enrolled_Date']));
                $this->SetFont('Times','I',12);
                $this->SetWidths(array(10, 45, 60, 30, 40, 50, 40, 35));
                for($i=0;$i<1;$i++):
                $this->Row(array(''.$count++.'',''.$_row_student['LRN'].'', ''.$_row_student['std_name'].'', ''.$_row_student['Gender'].'', ''.$_row_student['Phone'].'', ''.$_row_student['gname'].'', ''.$_row_student['GContact'].'', ''.$date.''));
                endfor;
            }
            }else{
            $this->SetFont('Times','B',14);
            $this->Cell(1);
            $this->Cell(0,0,"Students Master List",0,0,'C');
            $this->Ln(6);
            $this->SetFont('Times','',12);
            $this->Cell(1);
            $this->Cell(0,0,''.$class.'',0,0,'C');
            $this->Ln(6);
            $this->SetFont('Times','',12);
            $this->Cell(1);
            $this->Cell(0,0,''.$sy.'',0,0,'C');
            $this->Ln(6);

            $this->SetFont('Times','BI',12);
            $this->SetWidths(array(10, 45, 60, 30, 40, 50, 40, 35));
            for($i=0;$i<1;$i++):
            $this->Row(array('#','LRN', 'Name', 'Gender', 'Contact', 'Parents', 'Contact', 'Date'));
            endfor;

            $_get_student = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as std_name, concat(GFirstname, ' ' , GLastname) as gname FROM student_grade inner join student on student_grade.Student_ID = student.Student_ID WHERE Class_ID = '$grade' ORDER BY Lastname ASC");
            while ($_row_student = mysqli_fetch_assoc($_get_student)) {
                $date = date('F j, Y', strtotime($_row_student['Enrolled_Date']));
                $this->SetFont('Times','I',12);
                $this->SetWidths(array(10, 45, 60, 30, 40, 50, 40, 35));
                for($i=0;$i<1;$i++):
                $this->Row(array(''.$count++.'',''.$_row_student['LRN'].'', ''.$_row_student['std_name'].'', ''.$_row_student['Gender'].'', ''.$_row_student['Phone'].'', ''.$_row_student['gname'].'', ''.$_row_student['GContact'].'', ''.$date.''));
                endfor;
            }
        }


            $getAdviser = mysqli_query($con, "SELECT * FROM schedule inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE schedule.Teacher_ID = '$tid'");
            $rowAdviser = mysqli_fetch_assoc($getAdviser);
            $adviser = $rowAdviser['Salutation']. ". " .$rowAdviser['Lastname']. ", " .$rowAdviser['Firstname']. " " .$rowAdviser['Middlename'];
            $this->Ln(8);
            $this->SetFont('Times','B',12);
            $this->Cell(1);
            $this->Cell(0,0,'Class Adviser:',0,0,'L');
            $this->Ln(5);

            $this->Ln(0);
            $this->SetFont('Times','',12);
            $this->Cell(1);
            $this->Cell(0,0,''.$adviser.'',0,0,'L');
            $this->Ln(0);
        }
        
	}

	$pdf = new myPDF('L', 'mm', array(330.2, 215.9));
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetTitle('Student Reports');
	$pdf->head();
	$pdf->content();


	$pdf->Footer();
	$pdf->Output();
}

if (isset($_POST['excel'])) {
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $strand = mysqli_real_escape_string($con, $_POST['strand']);
    $tid = mysqli_real_escape_string($con, $_POST['myID']);
    $count = 1;

    $_get = mysqli_query($con, "SELECT * FROM grade WHERE ID = '$grade'");
    $row = mysqli_fetch_assoc($_get);
    $dept = $row['Department'];
    $class = $row['Name']. " " . $strand. " - " .$row['Section'];

    function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 

    $fileName = "student_record_" . date('Y-m-d') . ".xls";

    if ($dept == "SHSDEPT") {
        $fields = array('#','LRN', 'Name', 'Gender', 'Class', 'Contact', 'Parents', 'Contact', 'Date');
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        $_get_student = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as std_name, concat(GFirstname, ' ' , GLastname) as gname FROM student_grade inner join student on student_grade.Student_ID = student.Student_ID WHERE Class_ID = '$grade' AND student_grade.Strand = '$strand' ORDER BY Lastname ASC");
        while($row = mysqli_fetch_assoc($_get_student)){
            $date = date('F j, Y', strtotime($row['Enrolled_Date']));
            $data = array(''.$count++.'',''. $row['LRN'].'', ''.$row['std_name'].'', ''. $row['Gender'].'', ''.$class.'', ''. $row['Phone'].'', ''.$row['gname'].'', ''. $row['GContact'].'', ''.$date.'');
            array_walk($data, 'filterData'); 
            $excelData .= implode("\t", array_values($data)) . "\n"; 
        }
    }else{
        $fields = array('#','LRN', 'Name', 'Gender', 'Class', 'Contact', 'Parents', 'Contact', 'Date');
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        $_get_student = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as std_name, concat(GFirstname, ' ' , GLastname) as gname FROM student_grade inner join student on student_grade.Student_ID = student.Student_ID WHERE Class_ID = '$grade' AND student_grade.Strand = '$strand' ORDER BY Lastname ASC");
        while($row = mysqli_fetch_assoc($_get_student)){
            $date = date('F j, Y', strtotime($row['Enrolled_Date']));
            $data = array(''.$count++.'',''. $row['LRN'].'', ''.$row['std_name'].'', ''. $row['Gender'].'', ''.$class.'', ''. $row['Phone'].'', ''.$row['gname'].'', ''. $row['GContact'].'', ''.$date.'');
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