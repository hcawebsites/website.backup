<?php

require("../FPDF/fpdf.php");
session_start();


class myPDF extends FPDF{
    function head(){
    $this->Image('../assets/image/logo.png', 10, 6, 20);
    include ('../database/connection.php');
        $reg_num = $_SESSION['code'];
        $sql = "SELECT * FROM request_tb INNER JOIN 
        parents_enrollment_request_tb ON 
        request_tb.Reg_Num = 
        parents_enrollment_request_tb.Reg_Num WHERE request_tb.Reg_Num = $reg_num";
        $result  = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $image = $row['Picture'];
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
    $this->Ln(20);

    }

    function headerBody(){
        $this->SetFont('Times','B', 14);
        $this->Cell(80);
        $this->Cell(30,0,'Enrollment Form',0,0,'C');
        $this->Ln(15);

        }

    function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,0,'Page '.$this->PageNo().'/{nb}',0,0,'R');
}

function contentBody(){
    $this->SetFont('Times','', 12);
    $reg_num = $_SESSION['code'];
    include ('../database/connection.php');
    $sql1 = "SELECT * FROM request_tb INNER JOIN 
    parents_enrollment_request_tb ON 
    request_tb.Reg_Num = 
    parents_enrollment_request_tb.Reg_Num WHERE request_tb.Reg_Num = $reg_num"; 
    $result = mysqli_query($con, $sql1);
    while ($data = mysqli_fetch_assoc($result)) {

    $this->SetFont('Times','', 12);
    $this->Cell(10);
    $this->Cell(30,0,'Student Copy Number: ________',0,0,'L');
    $this->Ln();

    $this->Cell(5);
    $this->Cell(139 ,0,'Student Type:',0,0,'R');
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,''.$data['Student_Type'].'',0,0,'L');
    $this->Ln(6);
    
    $this->SetFont('Times','', 12);
    $this->Cell(5);
    $this->Cell(135 ,0,'Student ID:',0,0,'R');
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,'Not Available',0,0,'L');
    $this->Ln();
    
    $this->SetFont('Times','', 12);
    $this->Cell(10);
    $this->Cell(26,0,'Student Name: ',0,0,'L');
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,''.$data['Lastname'].', '.$data['Firstname'].' '.$data['Middlename'].'',0,0,'L');
    $this->Ln(6);

    $this->SetFont('Times','', 12);
    $this->Cell(5);
    $this->Cell(137.4 ,0,'Grade Level:',0,0,'R');
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,''.$data['G_Applying'].'',0,0,'L');
    $this->Ln();


    $this->SetFont('Times','', 12);
    $this->Cell(10);
    $this->Cell(37,0,'Date of Registration: ',0,0,'L');
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,''.$data['Reg_Date'].'',0,0,'L');
    $this->Ln(6);

    $this->SetFont('Times','', 12);
    $this->Cell(5);
    $this->Cell(137.4 ,0,'School Year:',0,0,'R');
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,''.$data['S_Y'].'',0,0,'L');
    $this->Ln();

    $this->SetFont('Times','', 12);
    $this->Cell(10);
    $this->Cell(18,0,'Semester:',0,0,'L');
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,''.$data['Semester'].'',0,0,'L');
    $this->Ln(6);

    $this->SetFont('Times','B', 20);
    $this->Cell(1);
    $this->Cell(18,0,'_____________________________________________________',0,0,'L');
    $this->Ln(10);

    $this->SetFont('Times','B', 14);
    $this->Cell(5);
    $this->Cell(18,0,'Requirements (Check if available)',0,0,'L');
    $this->Ln(8);
    $this->Cell(10);
    $this->SetFont('Times','', 12);
    $this->Cell(0,0,'Photocopy of:',0,0,'L');
    $this->Ln(7);

    $this->Cell(10);
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,'_____ PSA Birth Certificate',0,0,'L');
    $this->Ln();

    $this->SetFont('Times','B', 12);
    $this->Cell(26);
    $this->Cell(135,0,'_____ SF 9 (Card/ Form138)',0,0,'R');
    $this->Ln(7);

    $this->Cell(10);
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,'_____ Baptisimal/ Confirmation Certificate',0,0,'L');
    $this->Ln();

    $this->SetFont('Times','B', 12);
    $this->Cell(16);
    $this->Cell(135,0,'_____ SF 10 (Form137)',0,0,'R');
    $this->Ln(7);

    $this->Cell(10);
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,'_____ Good Moral Certificate',0,0,'L');
    $this->Ln();

    $this->SetFont('Times','B', 12);
    $this->Cell(50);
    $this->Cell(135,0,'_____ 2x2 ID Picture (White Background)',0,0,'R');
    $this->Ln(7);

    $this->Cell(10);
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,'_____ Certificate of Completion',0,0,'L');
    $this->Ln(6);

    $this->SetFont('Times','B', 20);
    $this->Cell(1);
    $this->Cell(18,0,'_____________________________________________________',0,0,'L');
    $this->Ln(10);   

    $this->SetFont('Times','', 14);
    $this->Cell(10);
    $this->Cell(15,0,'Strand: ',0,0,'L');
    $this->SetFont('Times','B', 12);
    $this->Cell(0,0,''.$data['Strand'].'',0,0,'L');
    $this->Ln(5);


    }

    }

    function contentTable(){

        $this->SetFont('Times','B', 12);
        $this->Cell(10);
        $this->Cell(30, 6, 'Subject Code', 1, 0, 'C');
        $this->Cell(80, 6, 'Description', 1, 0, 'C');
        $this->Cell(30, 6, 'Schedule', 1, 0, 'C');
        $this->Cell(30, 6, 'Room', 1, 0, 'C');
        $this->Ln();

    }

    function viewTable(){
        include ('../database/connection.php');
        $reg_num = $_SESSION['student_id'];
        $sql1 = "SELECT * FROM student WHERE Student_ID = '$reg_num'";
        $result = mysqli_query($con, $sql1);
        while ($row=mysqli_fetch_assoc($result)) {
           $grade = $row['Grade'];
           $strand = $row['Strand'];

           //Elementary Level//

           if ($grade == "Kinder") {

            $sql = "SELECT * from request_tb inner join grade on 
            request_tb.G_Applying = grade.Name inner join subjects on 
            grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
            $result = mysqli_query($con, $sql);
            while ($data = mysqli_fetch_assoc($result)) {
                
                $this->SetFont('Times','', 12);
                $this->Cell(10);
                $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                $this->Ln();
                
            }
        }

            if ($grade == "Grade 1") {

                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
            }

            if ($grade == "Grade 2") {

                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
            }

            if ($grade == "Grade 3") {

                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
            }

            if ($grade == "Grade 4") {

                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
            }

            if ($grade == "Grade 5") {

                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
            }

            

            if ($grade == "Grade 6") {

                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
            }
            
            //Junior High Levels//

            if ($grade == "Grade 7") {

                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
            }

            if ($grade == "Grade 8") {

                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
            }

            if ($grade == "Grade 9") {

                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
            }

            if ($grade == "Grade 10") {

                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level Where subjects.Level = 'Kinder' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
            }



           //Senior High Strands//
           if ($strand == "Accountancy And Business Management") {


            if ( $grade= "Grade 11") {
                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level inner join strands on 
                subjects.Strand = strands.Strands WHERE 
                subjects.Strand = 'Accountancy And Business Management' 
                AND subjects.Level = 'Grade 11' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
                
            }
            
            if ( $grade= "Grade 12") {
                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level inner join strands on 
                subjects.Strand = strands.Strands WHERE 
                subjects.Strand = 'Accountancy And Business Management' 
                AND subjects.Level = 'Grade 12' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
                
            }  
            
           }

           if ($strand == "General Academic Strand") {


            if ( $grade= "Grade 11") {
                $sql = "SELECT * from student INNER join student_grade on 
                student.Student_ID = student_grade.Student_ID inner join 
                subjects on student_grade.Level = subjects.Level 
                WHERE subjects.Strand = 'General Academic Strand' AND student.Student_ID = $reg_num";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 10);
                    $this->Cell(10);
                    $this->Cell(30, 5, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 5, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 5, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 5, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
                
            }
            
            if ( $grade= "Grade 12") {
                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level inner join strands on 
                subjects.Strand = strands.Strands WHERE 
                subjects.Strand = 'General Academic Strand' 
                AND subjects.Level = 'Grade 12' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
                
            }  
            
           }

           if ($strand == "Humanities And Social Sciences") {


            if ( $grade= "Grade 11") {
                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level inner join strands on 
                subjects.Strand = strands.Strands WHERE 
                subjects.Strand = 'Humanities And Social Sciences' 
                AND subjects.Level = 'Grade 11' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
                
            }
            
            if ( $grade= "Grade 12") {
                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level inner join strands on 
                subjects.Strand = strands.Strands WHERE 
                subjects.Strand = 'Humanities And Social Sciences' 
                AND subjects.Level = 'Grade 12' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
                
            }  
            
           }

           if ($strand == "Technical Vocational And Livelihood") {


            if ( $grade= "Grade 11") {
                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level inner join strands on 
                subjects.Strand = strands.Strands WHERE 
                subjects.Strand = 'Technical Vocational And Livelihood' 
                AND subjects.Level = 'Grade 11' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
                
            }
            
            if ( $grade= "Grade 12") {
                $sql = "SELECT * from request_tb inner join grade on 
                request_tb.G_Applying = grade.Name inner join subjects on 
                grade.Name = subjects.Level inner join strands on 
                subjects.Strand = strands.Strands WHERE 
                subjects.Strand = 'Technical Vocational And Livelihood' 
                AND subjects.Level = 'Grade 12' AND request_tb.Reg_Num = '$reg_num'";
                $result = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
                    
                    $this->SetFont('Times','', 12);
                    $this->Cell(10);
                    $this->Cell(30, 10, ''.$data['Subject_Code'].'', 1, 0, 'C');
                    $this->Cell(80, 10, ''.$data['Description'].'', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Cell(30, 10, 'TBA', 1, 0, 'C');
                    $this->Ln();
                    
                }
                
            }  
            
           }


        }
        
    }

    function viewPayment(){
        $this->Ln(5);
        $this->SetFont('Times','B', 12);
        $this->Cell(10);
        $this->Cell(15,0,'School Fees:',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Type:',0,0,'L');
        $this->Ln();

        $this->SetFont('Times','B', 12);
        $this->Cell(80,0,'Amount:',0,0,'R');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,'Tuition Fee:',0,0,'L');
        $this->Ln();

        $this->SetFont('Times','B', 12);
        $this->Cell(81,0,'P8,000.00',0,0,'R');
        $this->Ln(5);

        $this->Cell(10);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,'Miscellaneous Fee:',0,0,'L');
        $this->Ln();

        $this->SetFont('Times','B', 12);
        $this->Cell(81,0,'P3,000.00',0,0,'R');
        $this->Ln(5);

        $this->Cell(10);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,'Registration Fee:',0,0,'L');
        $this->Ln();

        $this->SetFont('Times','B', 12);
        $this->Cell(78,0,'P150.00',0,0,'R');
        $this->Ln(5);

        $this->Cell(10);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,'Other Fee:',0,0,'L');
        $this->Ln();

        $this->SetFont('Times','B', 12);
        $this->Cell(80,0,'P2000.00',0,0,'R');
        $this->Ln(2);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'___________________________________',0,0,'L');
        $this->Ln(5);

        $this->Cell(45);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,'Total:',0,0,'L');
        $this->Ln();

        $this->SetFont('Times','B', 12);
        $this->Cell(83,0,'P13,150.00',0,0,'R');
        $this->Ln(15);

    }

    function personalInfo(){
        include ('../database/connection.php');
        $reg_num = $_SESSION['code'];
        $sql = "SELECT * FROM request_tb INNER JOIN 
        parents_enrollment_request_tb ON 
        request_tb.Reg_Num = 
        parents_enrollment_request_tb.Reg_Num WHERE request_tb.Reg_Num = $reg_num";
        $result  = mysqli_query($con, $sql);
        
        $this->SetFont('Times','B', 14);
        $this->Cell(10);
        $this->Cell(15,0,'Personal Information:',0,0,'L');
        $this->Ln(10);
        while ($row=mysqli_fetch_assoc($result)) {

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Studen ID:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,'Not Available',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Name:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['Lastname'].', '.$row['Firstname'].' '.$row['Middlename'].'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Age:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['Age'].' Years Old',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Address:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['Address'].'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Date of Birth:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['DOB'].'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Place of Birth:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['POB'].'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Name of Father:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['F_Lastname'].', '.$row['F_Firstname'].' '.$row['F_Middlename'].'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Occupation:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Name of Mother:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['M_Lastname'].', '.$row['M_Firstname'].' '.$row['M_Middlename'].'',0,0,'L');
        $this->Ln(6);

       
        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Occupation:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Last School Attended:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['S_L_A'].'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'School Year:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['Last_S_Y_Attended'].'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'LRN:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['LRN'].'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'General Average:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['Gen_Ave'].'',0,0,'L');
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'Contact Number:',0,0,'L');
        $this->Ln();

        $this->Cell(55);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,''.$row['Contact'].'',0,0,'L');
        $this->Ln(20);

        $this->Cell(15);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'_____________________________________',0,0,'L');
        $this->Ln();

        $this->Cell(100);
        $this->SetFont('Times','B', 12);
        $this->Cell(0,0,'_____________________________________',0,0,'L');
        $this->Ln(5);

        $this->Cell(26);
        $this->SetFont('Times','', 10);
        $this->Cell(0,0,'Signature over Printed Name of Student',0,0,'L');
        $this->Ln();

        $this->Cell(105);
        $this->SetFont('Times','', 10);
        $this->Cell(0,0,'Signature over Printed Name of Parents/Guardian',0,0,'L');
        $this->Ln(10);

        $this->SetFont('Times','B', 20);
        $this->Cell(1);
        $this->Cell(18,0,'_____________________________________________________',0,0,'L');
        $this->Ln(20);  

        $this->Cell(125);
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,'Evaluated by:',0,0,'L');
        $this->Ln(15);

        $this->Cell(130);
        $this->SetFont('Times','BU', 12);
        $this->Cell(0,0,'JOVITA R. BUENO',0,0,'L');
        $this->Ln(5);
        $this->Cell(137);
        $this->SetFont('Times','', 10);
        $this->Cell(0,0,'Registrar/ Cashier',0,0,'L');
        $this->Ln(25);

        ;
        $this->SetFont('Times','', 12);
        $this->Cell(0,0,'Approve by:',0,0,'C');
        $this->Ln(15);

        $this->SetFont('Times','BU', 12);
        $this->Cell(0,0,'LORRIE T. SERAIN',0,0,'C');
        $this->Ln(5);

        $this->SetFont('Times','', 10);
        $this->Cell(0,0,'OIC/ Principal',0,0,'C');

        

        

        
    
           
        }


    }

    


}//end of class



if (isset($_POST['print'])) {

    
    $pdf = new myPDF('p', 'mm', 'a4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle('Holy Child Academy Enrollment Form');
    $pdf->head();
    $pdf->headerBody();
    $pdf->SetFont('Times','',12);
    $pdf->contentBody();
    $pdf->contentTable();
    $pdf->viewTable();
    $pdf->viewPayment();
    $pdf->personalInfo();
    $pdf->Output();


}

?>
