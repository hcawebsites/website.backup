<?php
error_reporting(0);
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
        $this->Image('../assets/image/logo.png', 75, 5, 25);
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
        $this->Ln(7);
    
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
        $this->Cell(0,0,'Library Books Reports',0,0,'C');
        $this->Ln(6);
        $this->SetFont('Times','',11);
        $this->Cell(1);
        $this->Cell(0,0,''.$row['School_Year'].'',0,0,'C');
        $this->Ln(7);
    }

    function content(){
        include '../database/connection.php';
        $count = 1;
        $this->SetFont('Times','B',12);
        $this->SetWidths(array(5, 45, 40, 65, 40, 20, 25, 40, 30));
        for($i=0;$i<1;$i++):
        $this->Row(array('#', 'ISBN', 'Title', 'Author', 'Category', 'Total', 'Available', 'Call Number', 'Date Publish'));
        endfor;

        $sql = "SELECT * FROM books";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $newdate = date('F j, Y', strtotime($row['Date_Publish']));
            $this->SetFont('Times','', 12);
            $this->SetWidths(array(5, 45, 40, 65, 40, 20, 25, 40, 30));
            for($i=0;$i<1;$i++):
            $this->Row(array(''.$count++.'', ''.$row['ISBN'].'', ''.$row['Title'].'', ''.$row['Author'].'', ''.$row['Category'].'', ''.$row['Total'].'', ''.$row['Available'].'', ''.$row['Call_Number'].'', ''.$newdate.''));
            endfor;
        }
        session_start();
        $myID = $_SESSION['emp_id'];
        $get = mysqli_query($con, "SELECT * from staff_tb WHERE Emp_ID = '$myID'");
        $row = mysqli_fetch_assoc($get);
        $name = $row['Salutation']. ". ". $row['Firstname']. " ". $row['Lastname'];
        $this->Ln(8);
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,'Librarian:',0,0,'L');
        $this->Ln(0);
        $this->SetFont('Times','B',12);
        $this->Cell(1);
        $this->Cell(0,0,'Principal: ',0,0,'C');
        $this->Ln(7);

        $this->Ln(0);
        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,''.$name.'',0,0,'L');
        $this->Ln(0);

        $this->Ln(0);
        $this->SetFont('Times','',12);
        $this->Cell(1);
        $this->Cell(0,0,'Mrs. Lorrie T. Serain',0,0,'C');
        $this->Ln(0);
        
    }

}

$pdf = new myPDF('L', 'mm', array(330.2, 215.9));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle('Library Books Report');
$pdf->head();
$pdf->title();
$pdf->content();


$pdf->Footer();
$pdf->Output();

?>