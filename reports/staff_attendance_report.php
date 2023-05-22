<?php
include_once('../database/connection.php');
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
        $this->Cell(0,0,'Staff Attendance Reports',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
        $this->Ln(7);
    }

    function content(){
        include '../database/connection.php';
        $count = 1;
        $date = $_POST['filter_date'];
        $myID = mysqli_real_escape_string($con, $_POST['myID']);
        $this->SetFont('Arial','BI', 11);
        $this->SetWidths(array(10, 50, 70, 35, 35, 35, 45, 30, 35, 30));
        for($i=0;$i<1;$i++):
        $this->Row(array('#', 'Employee ID', 'Name', 'Time In', 'Time Out' , 'Status', 'Date', 'Access'));
        endfor;

        if ($date == "") {
            $get = mysqli_query($con, "SELECT * FROM emp_attendance");
            while ($row = mysqli_fetch_assoc($get)) {
                $status = $row['Status'];
                $in = date('h:i A', strtotime($row['Time_In']));
                $out = date('h:i A', strtotime($row['Time_Out']));
                $date = date('F j, Y', strtotime($row['Date']));

                if ($status == 1) {
                    $this->SetFont('Arial','I', 10);
                    $this->SetWidths(array(10, 50, 70, 35, 35, 35, 45, 30, 35, 30));
                    for($i=0;$i<1;$i++):
                    $this->Row(array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'On Time', ''.$date.'', ''.$row['Access'].''));
                    endfor;
                }
                elseif ($status == 2) {
                    $this->SetFont('Arial','I', 10);
                    $this->SetWidths(array(10, 50, 70, 35, 35, 35, 45, 30, 35, 30));
                    for($i=0;$i<1;$i++):
                    $this->Row(array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'Late', ''.$date.'', ''.$row['Access'].''));
                    endfor;
                }else{
                    $this->SetFont('Arial','I', 10);
                    $this->SetWidths(array(10, 50, 70, 35, 35, 35, 45, 30, 35, 30));
                    for($i=0;$i<1;$i++):
                    $this->Row(array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'Absent', ''.$date.'', ''.$row['Access'].''));
                    endfor;
                }
            }
        }else{
            $get = mysqli_query($con, "SELECT * FROM emp_attendance WHERE Date = '$date'");
            while ($row = mysqli_fetch_assoc($get)) {
                $status = $row['Status'];
                $in = date('h:i A', strtotime($row['Time_In']));
                $out = date('h:i A', strtotime($row['Time_Out']));
                $date = date('F j, Y', strtotime($row['Date']));

                if ($status == 1) {
                    $this->SetFont('Arial','I', 10);
                    $this->SetWidths(array(10, 50, 70, 35, 35, 35, 45, 30, 35, 30));
                    for($i=0;$i<1;$i++):
                    $this->Row(array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'On Time', ''.$date.'', ''.$row['Access'].''));
                    endfor;
                }
                elseif ($status == 2) {
                    $this->SetFont('Arial','I', 10);
                    $this->SetWidths(array(10, 50, 70, 35, 35, 35, 45, 30, 35, 30));
                    for($i=0;$i<1;$i++):
                    $this->Row(array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'Late', ''.$date.'', ''.$row['Access'].''));
                    endfor;
                }else{
                    $this->SetFont('Arial','I', 10);
                    $this->SetWidths(array(10, 50, 70, 35, 35, 35, 45, 30, 35, 30));
                    for($i=0;$i<1;$i++):
                    $this->Row(array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'Absent', ''.$date.'', ''.$row['Access'].''));
                    endfor;
                }
            }
        }

        $this->Ln(5);
        $this->SetFont('Arial','I',12);
        $this->Cell(1);
        $this->Cell(0,0,'Principal:',0,0,'L');
        $this->Ln(6);

        $get = mysqli_query($con, "SELECT * FROM admin Where Admin_ID = '$myID'");
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
    $date = $_POST['filter_date'];

    if ($date == "") {
        function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
        } 

        $fileName = "attendance-data_" . date('Y-m-d') . ".xls";

        $fields = array('#','Employee ID', 'Name', 'Time In', 'Time Out', 'Status', 'Date', 'Access');
        $excelData = implode("\t", array_values($fields)) . "\n"; 

        $get = mysqli_query($con, "SELECT * FROM emp_attendance");

        if (mysqli_num_rows($get) > 0) {
            while ($row = mysqli_fetch_assoc($get)) {
                $status = $row['Status'];
                $in = date('h:i A', strtotime($row['Time_In']));
                $out = date('h:i A', strtotime($row['Time_Out']));
                $date = date('F j, Y', strtotime($row['Date']));

                if ($status == 1) {
                    $data = array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'On Time', ''.$date.'', ''.$row['Access'].'');
                }elseif ($status == 2) {
                    $data = array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'Late', ''.$date.'', ''.$row['Access'].'');
                }else{
                    $data = array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'Absent', ''.$date.'', ''.$row['Access'].'');
                }
            array_walk($data, 'filterData'); 
            $excelData .= implode("\t", array_values($data)) . "\n"; 
                
            }

        }else{ 
        $excelData .= 'No records found...'. "\n"; 
        } 

    }else{
        function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
        } 

        $fileName = "attendance-data_" . date('Y-m-d') . ".xls";

        $fields = array('#','Employee ID', 'Name', 'Time In', 'Time Out', 'Status', 'Date', 'Access');
        $excelData = implode("\t", array_values($fields)) . "\n"; 

        $get = mysqli_query($con, "SELECT * FROM emp_attendance WHERE Date = '$date'");

        if (mysqli_num_rows($get) > 0) {
            while ($row = mysqli_fetch_assoc($get)) {
                $status = $row['Status'];
                $in = date('h:i A', strtotime($row['Time_In']));
                $out = date('h:i A', strtotime($row['Time_Out']));
                $date = date('F j, Y', strtotime($row['Date']));

                if ($status == 1) {
                    $data = array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'On Time', ''.$date.'', ''.$row['Access'].'');
                }elseif ($status == 2) {
                    $data = array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'Late', ''.$date.'', ''.$row['Access'].'');
                }else{
                    $data = array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$row['Name'].'', ''.$in.'', ''.$out.'' , 'Absent', ''.$date.'', ''.$row['Access'].'');
                }
            array_walk($data, 'filterData'); 
            $excelData .= implode("\t", array_values($data)) . "\n"; 
                
            }

        }else{ 
        $excelData .= 'No records found...'. "\n"; 
        } 
    }

    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    
    // Render excel data 
    echo $excelData; 
    
    exit;
}

?>