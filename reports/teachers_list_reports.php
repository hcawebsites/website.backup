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
        $this->Cell(0,0,'__________________________________________________________________________________________',0,0,'C');
        $this->Ln(10);
    
        }

        function Footer(){
            $this->SetY(-30);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,0,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    }

    function title(){ 
        include '../database/connection.php';
        $query = "SELECT * FROM academic_list WHERE is_default = '1'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        $this->SetFont('Times','B',14);
        $this->Cell(1);
        $this->Cell(0,0,'Teachers List Reports',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
        $this->Ln(7);
    }

    function content(){
        include '../database/connection.php';
        $this->SetFont('Times','B',12);
        $this->SetWidths(array(10, 25, 25, 25, 25, 25, 25, 25, 20, 20, 25, 25));
        for($i=0;$i<1;$i++):
        $this->Row(array('#', 'Teachers ID', 'Name', 'DOB', 'Age', 'Gender', 'Address', 'Nationality', 'Contact', 'Email', 'Department', 'Reg. Date'));
        endfor;

        $sql = "SELECT * FROM teacher_tb";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $this->SetFont('Times','', 12);
            $this->SetWidths(array(10, 25, 25, 25, 25, 25, 25, 25, 20, 20, 25, 25));
            for($i=0;$i<1;$i++):
            $this->Row(array(''.$row['ID'].'', ''.$row['Emp_ID'].'', ''.$row['Firstname'].' '.$row['Middlename'].' '.$row['Lastname'].'', ''.$row['DOB'].'', ''.$row['Age'].'', ''.$row['Gender'].'', ''.$row['Address'].'', ''.$row['Nationality'].'', ''.$row['Contact'].'', ''.$row['Email'].'', ''.$row['Department'].'', ''.$row['Date'].''));
            endfor;
        }
        
    }

}

$pdf = new myPDF('L', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle('HCAMIS TEACHERS LIST');
$pdf->head();
$pdf->title();
$pdf->content();


$pdf->Footer();
$pdf->Output();
    
}

if (isset($_POST['export'])) {

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 

    $fileName = "teacher-data_" . date('Y-m-d') . ".xls";

    $fields = array('ID', 'Teacher_ID', 'Last Name', 'First Name', 'Middle Name', 'DOB', 'Age', 'Gender', 'Status', 'Address', 'Nationality', 'Contact', 'Email', 'Department', 'Reg. Date');
    $excelData = implode("\t", array_values($fields)) . "\n"; 

    $teacher_data = mysqli_query($con, "SELECT * from teacher_tb");
    if (mysqli_num_rows($teacher_data) > 0) {
        while ($row = mysqli_fetch_assoc($teacher_data)) {
            $data = array($row['ID'], $row['Emp_ID'], $row['Lastname'], $row['Firstname'], $row['Middlename'], $row['DOB'], $row['Age'], $row['Gender'], $row['Status'], $row['Address'], $row['Nationality'], $row['Contact'], $row['Email'], $row['Department'], $row['Date']);
            array_walk($data, 'filterData'); 
            $excelData .= implode("\t", array_values($data)) . "\n"; 
        }
    }
    else{ 
        $excelData .= 'No records found...'. "\n"; 
    } 

    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    
    // Render excel data 
    echo $excelData; 
    
    exit;
}

?>