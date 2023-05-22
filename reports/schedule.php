<?php  
include_once '../database/connection.php';
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
        $this->Image('../assets/image/logo.png', 30, 5, 25);
        $this->SetFont('Arial','',14);
        $this->Cell(1);
        $this->Cell(0,0,'Republic of the Philippines',0,0,'C');
        $this->Ln(7);
        $this->Cell(1);
        $this->SetFont('Arial','',16);
        $this->Cell(0,0,'Diocesan Schools of Urdaneta',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Arial','',14);
        $this->Cell(1);
        $this->Cell(0,0,'Holy Child Academy',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Arial','',10);
        $this->Cell(1);
        $this->Cell(0,0,'Oct. 16th Street, Poblacion, Binalonan, Pangasinan, 2428',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',10);
        $this->Cell(1);
        $this->Cell(0,0,'',1,0,'C');
        $this->Ln(5);
    
        }

        function content(){ 
    	include '../database/connection.php';
    	$tid = mysqli_real_escape_string($con, $_POST['tid']);
        $aid = mysqli_real_escape_string($con, $_POST['aid']);

    	$query = "SELECT * FROM academic_list WHERE is_default = '1'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        $this->SetFont('Arial','B',12);
        $this->Cell(1);
        $this->Cell(0,0,'Schedule Reports',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
        $this->Ln(7);

        $this->SetFont('Arial','BI',12);
        $this->SetWidths(array(20, 45, 45, 30, 35, 25, 25, 25, 60));
        for($i=0;$i<1;$i++):
        $this->Row(array('Code', 'Description', 'Class', 'Strand', 'Days', 'Start', 'End', 'Room', 'Instructor'));
        endfor;

        $_sched = mysqli_query($con, "SELECT GROUP_CONCAT(Code SEPARATOR '\n') as code, GROUP_CONCAT(Description SEPARATOR '\n') as description, GROUP_CONCAT(Name, '-', Section SEPARATOR '\n') as grade, GROUP_CONCAT(Day SEPARATOR '\n') as day, GROUP_CONCAT(Room SEPARATOR '\n') as room, GROUP_CONCAT(time.time_start SEPARATOR '\n') as time_start, GROUP_CONCAT(time.time_end SEPARATOR '\n') as time_end, GROUP_CONCAT(Salutation, '. ' , Firstname, ' ', Lastname SEPARATOR '\n') as name, GROUP_CONCAT(Strand SEPARATOR '\n') as strand, schedule.Teacher_ID as teacher_id FROM schedule inner join time on schedule.Time_ID = time.time_id inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE schedule.Teacher_ID = '$tid'");
            while ($_row = mysqli_fetch_assoc($_sched)) {
                $this->SetFont('Arial','I','11');
                $this->SetWidths(array(20, 45, 45, 30, 35, 25, 25, 25, 60));
                for($i=0;$i<1;$i++):
                $this->Row(array(''.$_row['code'].'', ''.$_row['description'].'', ''.$_row['grade'].'', ''.$_row['strand'].'', ''.$_row['day'].'', ''.$_row['time_start'].'', ''.$_row['time_end'].'', ''.$_row['room'].'', ''.$_row['name'].''));
                endfor;

            $get = mysqli_query($con , "SELECT concat(Salutation, '. ', Firstname, ' ', Middlename, ' ', Lastname ) as name FROM teacher_tb WHERE Emp_ID = '$tid'");
            $row = mysqli_fetch_assoc($get);
            $fname = $row['name'];

            $this->Ln(5);
            $this->SetFont('Arial','I',12);
            $this->Cell(1);
            $this->Cell(0,0,'Teacher:',0,0,'L');
            $this->Ln(0);
            $this->SetFont('Arial','I',12);
            $this->Cell(1);
            $this->Cell(0,0,'Principal: ',0,0,'C');
            $this->Ln(7);

            $this->Ln(0);
            $this->SetFont('Arial','B',12);
            $this->Cell(1);
            $this->Cell(0,0,''.$fname.'',0,0,'L');
            $this->Ln(0);

            $_get = mysqli_query($con , "SELECT concat(Salutation, '. ', Firstname, ' ', Middlename, ' ', Lastname ) as name FROM admin WHERE Admin_ID = '$aid'");
            $row_ = mysqli_fetch_assoc($_get);

            $this->Ln(0);
            $this->SetFont('Arial','B',12);
            $this->Cell(1);
            $this->Cell(0,0,''.$row_['name'].'',0,0,'C');
            $this->Ln(0);
            }
        }


        function Footer(){
        $this->SetY(-30);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,0,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    	}
	}

	$pdf = new myPDF('L', 'mm', array(330.2, 215.9));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle('Schedule Reports');
    $pdf->head();
    $pdf->content();
   
    $pdf->Footer();
    $pdf->Output();
}

if (isset($_POST['excel'])) {
    $tid = mysqli_real_escape_string($con, $_POST['tid']);
   function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
        } 

        $fileName = "schedule-data_" . date('Y-m-d') . ".xls";

        $fields = array('Code', 'Description', 'Class', 'Strand', 'Days', 'Start', 'End', 'Room', 'Instructor');
        $excelData = implode("\t", array_values($fields)) . "\n"; 

        $_sched = mysqli_query($con, "SELECT GROUP_CONCAT(Code SEPARATOR '\r\n') as code, GROUP_CONCAT(Description SEPARATOR '\n') as description, GROUP_CONCAT(Name, '-', Section SEPARATOR '\n') as grade, GROUP_CONCAT(Day SEPARATOR '\n') as day, GROUP_CONCAT(Room SEPARATOR '\n') as room, GROUP_CONCAT(time.time_start SEPARATOR '\n') as time_start, GROUP_CONCAT(time.time_end SEPARATOR '\n') as time_end, GROUP_CONCAT(Salutation, '. ' , Firstname, ' ', Lastname SEPARATOR '\n') as name, GROUP_CONCAT(Strand SEPARATOR '\n') as strand, schedule.Teacher_ID as teacher_id FROM schedule inner join time on schedule.Time_ID = time.time_id inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE schedule.Teacher_ID = '$tid'");
            if (mysqli_num_rows($_sched)) {
                while ($_row = mysqli_fetch_assoc($_sched)) {
                    $data = array(''.$_row['code'].'', ''.$_row['description'].'', ''.$_row['grade'].'', ''.$_row['strand'].'', ''.$_row['day'].'', ''.$_row['time_start'].'', ''.$_row['time_end'].'', ''.$_row['room'].'', ''.$_row['name'].'');

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
}
?>