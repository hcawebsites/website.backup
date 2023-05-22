<?php 
error_reporting(0); 
include_once '../database/connection.php';
require '../phpExcel/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require("../FPDF/fpdf.php");
$count = 1;


if (isset($_POST['excel'])) {
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 

    $fileName = "guidance-reports_" . date('Y-m-d') . ".xls";

    $fields = array('#','Student ID', 'Student Name', 'VIolation', 'Offense', 'Punishment', 'Status', 'Date Created', 'Date Resolved');
    $excelData = implode("\t", array_values($fields)) . "\n";

    $get = mysqli_query($con, "SELECT * from guidance Order by guidance.ID ASC");

    if (mysqli_num_rows($get) > 0) {
        while ($row = mysqli_fetch_assoc($get)) {
            $date_created = date('F j, Y', strtotime($row['Date']));
            $date_settled = date('F j, Y', strtotime($row['Date_Resolved']));
            if ($row['Status'] == 1) {
                $data = array(''.$count++.'', ''.$row['Student_ID'].'', ''.$row['Name'].'', ''.$row['Violation'].'', ''.$row['Offense'].'', ''.$row['Punishment'].'', 'Not Resolve', ''.$date_created.'');
            }else{
                $data = array(''.$count++.'', ''.$row['Student_ID'].'', ''.$row['Name'].'', ''.$row['Violation'].'', ''.$row['Offense'].'', ''.$row['Punishment'].'', 'Resolve', ''.$date_created.'', ''.$date_settled.'');
            }
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
        $staff_id = mysqli_real_escape_string($con, $_POST['staff_id']);
        $count = 1;
        $query = "SELECT * FROM academic_list WHERE is_default = '1'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,'Student Counseling Reports',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Times','',10);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
        $this->Ln(7);

        $this->SetFont('Times','BI',12);
            $this->SetWidths(array(5, 30, 50, 35, 35, 45, 30, 40, 40));
            for($i=0;$i<1;$i++):
            $this->Row(array('#','Student ID', 'Student Name', 'Violation', 'Offense', 'Punishment', 'Status', 'Date Created', 'Date Resolved'));
        endfor;

        $get = mysqli_query($con, "SELECT * from guidance Order by guidance.ID ASC");
         while ($row = mysqli_fetch_assoc($get)) {
            $date_created = date('F j, Y', strtotime($row['Date']));
            $date_settled = date('F j, Y', strtotime($row['Date_Resolved']));
			if ($row['Status'] == 1) {
                $this->SetFont('Times','I',11);
                $this->SetWidths(array(5, 30, 50, 35, 35, 45, 30, 40, 40));
                for($i=0;$i<1;$i++):
                $this->Row(array(''.$count++.'',''.$row['Student_ID'].'', ''.$row['Name'].'', ''.$row['Violation'].'', ''.$row['Offense'].'', ''.$row['Punishment'].'', 'Not Resolve', ''.$date_created.'', ''.$date_settled.'', ''));
                endfor;
             }else{
                $this->SetFont('Times','I',11);
                $this->SetWidths(array(5, 30, 50, 35, 35, 45, 30, 40, 40));
                for($i=0;$i<1;$i++):
                $this->Row(array(''.$count++.'',''.$row['Student_ID'].'', ''.$row['Name'].'', ''.$row['Violation'].'', ''.$row['Offense'].'', ''.$row['Punishment'].'', 'Resolved', ''.$date_created.'', ''.$date_settled.''));
                endfor;
             }
         }

         $get = mysqli_query($con, "SELECT * FROM staff_tb WHERE Emp_ID = '$staff_id'");
            $row = mysqli_fetch_assoc($get);
            $councelor = $row['Salutation']. ". " .$row['Lastname']. ", " .$row['Firstname']. " " .$row['Middlename'];

        $this->Ln(6);
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,'Guidance Councelor:',0,0,'L');
        $this->Ln(0);
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,'Principal:',0,0,'C');
        $this->Ln(7);

        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,''.$councelor.'',0,0,'L');
        $this->Ln(0);

        $this->Ln(0);
        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,'Mr. Spencer S. Desamito',0,0,'C');
        $this->Ln(0);


    }

}


    $pdf = new myPDF('L', 'mm', array(330.2, 215.9));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle('HCAMIS Guidance Report');
    $pdf->head();
    $pdf->content();
   
    $pdf->Footer();
    $pdf->Output();

}

?>