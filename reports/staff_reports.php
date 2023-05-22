<?php
include_once('../database/connection.php');
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
        $count = 1;
        include '../database/connection.php';
        $access = mysqli_real_escape_string($con, $_POST['filter']);
        $aid = mysqli_real_escape_string($con, $_POST['aid']);
        $query = "SELECT * FROM academic_list WHERE is_default = '1'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,'Staff Reports',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Times','BI',12);
        $this->SetWidths(array(10, 40, 40, 30, 15, 25, 25, 25, 20, 30, 25, 25));
        for($i=0;$i<1;$i++):
        $this->Row(array('#', 'Staff ID', 'Name', 'DOB', 'Age', 'Gender', 'Address', 'Nationality', 'Contact', 'Email', 'Access', 'Date'));
        endfor; 

        if ($access == "All") {
            $get_staff = mysqli_query($con, "SELECT * from staff_tb inner join user on staff_tb.Emp_ID = user.Username Order by staff_tb.ID asc");
            if (mysqli_num_rows($get_staff) > 0) {
                while ($row = mysqli_fetch_assoc($get_staff)) {
                    $name = $row['Salutation']. ". ". $row['Firstname']. " " .$row['Lastname'];
                    $dob = date('F j, Y', strtotime($row['DOB']));
                    $date = date('F j, Y', strtotime($row['Date']));

                    $this->SetFont('Times','I',11);
                    $this->SetWidths(array(10, 40, 40, 30, 15, 25, 25, 25, 20, 30, 25, 25));
                    for($i=0;$i<1;$i++):
                    $this->Row(array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$name.'', ''.$dob.'', ''.$row['Age'].'', ''.$row['Gender'].'', ''.$row['Address'].'', ''.$row['Nationality'].'', ''.$row['Contact'].'', ''.$row['Email'].'', ''.$row['Access'].'', ''.$date.''));
                    endfor; 
                }
            }else{
                echo "<script>
                    alert('No Record Found!');
                    window.location.href = '../admin/student_payment.php';
                </script>";
            }
        }else{
            $get_staff = mysqli_query($con, "SELECT * from staff_tb inner join user on staff_tb.Emp_ID = user.Username WHERE Access = '$access' Order by staff_tb.ID asc");
            if (mysqli_num_rows($get_staff) > 0) {
                while ($row = mysqli_fetch_assoc($get_staff)) {
                    $name = $row['Salutation']. ". ". $row['Firstname']. " " .$row['Lastname'];
                    $dob = date('F j, Y', strtotime($row['DOB']));
                    $date = date('F j, Y', strtotime($row['Date']));

                    $this->SetFont('Times','I',11);
                    $this->SetWidths(array(10, 40, 40, 30, 15, 25, 25, 25, 20, 30, 25, 25));
                    for($i=0;$i<1;$i++):
                    $this->Row(array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$name.'', ''.$dob.'', ''.$row['Age'].'', ''.$row['Gender'].'', ''.$row['Address'].'', ''.$row['Nationality'].'', ''.$row['Contact'].'', ''.$row['Email'].'', ''.$row['Access'].'', ''.$date.''));
                    endfor; 
                }
            }else{
                echo "<script>
                    alert('No Record Found!');
                    window.location.href = '../admin/student_payment.php';
                </script>";
            }
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
$pdf->SetTitle('HCAMIS TEACHERS LIST');
$pdf->head();
$pdf->content();


$pdf->Footer();
$pdf->Output();
    
}

if (isset($_POST['excel'])) {
    $access = mysqli_real_escape_string($con, $_POST['filter']);
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 

    $fileName = "staff_reports_" . date('Y-m-d') . ".xls";

    $fields = array('#', 'Staff ID', 'Name', 'DOB', 'Age', 'Gender', 'Address', 'Nationality', 'Contact', 'Email', 'Access', 'Date');
    $excelData = implode("\t", array_values($fields)) . "\n";

    if ($access == "All") {
        $get_staff = mysqli_query($con, "SELECT * from staff_tb inner join user on staff_tb.Emp_ID = user.Username Order by staff_tb.ID asc");
        if (mysqli_num_rows($get_staff) > 0) {
            while ($row = mysqli_fetch_assoc($get_staff)) {
                $name = $row['Salutation']. ". ". $row['Firstname']. " " .$row['Lastname'];
                $dob = date('F j, Y', strtotime($row['DOB']));
                $date = date('F j, Y', strtotime($row['Date']));
                $data = array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$name.'', ''.$dob.'', ''.$row['Age'].'', ''.$row['Gender'].'', ''.$row['Address'].'', ''.$row['Nationality'].'', ''.$row['Contact'].'', ''.$row['Email'].'', ''.$row['Access'].'', ''.$date.'');
            array_walk($data, 'filterData'); 
            $excelData .= implode("\t", array_values($data)) . "\n"; 
            }
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 
    }else{
        $get_staff = mysqli_query($con, "SELECT * from staff_tb inner join user on staff_tb.Emp_ID = user.Username WHERE Access = '$access' Order by staff_tb.ID asc");
        if (mysqli_num_rows($get_staff) > 0) {
            while ($row = mysqli_fetch_assoc($get_staff)) {
                $name = $row['Salutation']. ". ". $row['Firstname']. " " .$row['Lastname'];
                $dob = date('F j, Y', strtotime($row['DOB']));
                $date = date('F j, Y', strtotime($row['Date']));
                $data = array(''.$count++.'', ''.$row['Emp_ID'].'', ''.$name.'', ''.$dob.'', ''.$row['Age'].'', ''.$row['Gender'].'', ''.$row['Address'].'', ''.$row['Nationality'].'', ''.$row['Contact'].'', ''.$row['Email'].'', ''.$row['Access'].'', ''.$date.'');
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