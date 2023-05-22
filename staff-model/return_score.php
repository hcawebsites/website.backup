<?php
include_once ('../database/connection.php');
extract($_POST);
$ass_id = mysqli_real_escape_string($con, $_POST['assid']);
$_chk = $_POST['check'];

foreach($_chk as $std_id){
    $sql = mysqli_query($con, "SELECT * FROM student Where Student_ID = '$std_id'");
    $sql1 = mysqli_query($con, "SELECT * from assignment inner join classroom on assignment.Code = classroom.code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE assignment.ID = '$ass_id' ");
    $row = mysqli_fetch_assoc($sql1);
    $title = $row['Title'];
    $tname = $row['Salutation'] .". " .$row['Firstname'] . " " .$row['Lastname'];
    $classname = $row['Classname'];
    $rowEmail = mysqli_fetch_array($sql);
    $email = $rowEmail['Email'];
    $firstname = $rowEmail['Firstname'];
    $points = mysqli_real_escape_string($con, $_POST['score_'.$std_id]);
    
    $subject = "Marked: ".$title."";
    $htmlContent = '
       <html> 
            <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                <div style="padding: .5rem .5rem .5rem .5rem;">
                    <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="50px" style="border-radius: 100%;">
                    <p style="color: #666666; font-size: 12px; font-weight: 300;">Dear '.$firstname.',</p>
                    <p style="color: #333; font-size: 12px; font-weight: 300;">'.$tname.' just returned '.$title.' in '.$classname.'.</p>
                    <p style="color: #5c5c5c; font-size: 10px; font-weight: 300;">MARKED</p>
                    <p style="color: #333; font-size: 16px; font-weight: 300;">'.$title.'</p>
                    <p style="color: #333; font-size: 12px; font-weight: 300;">Mark: '.$points.'</p>
                </div>
            </body> 
        </html>
    ';
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    if(mail($email, $subject, $htmlContent, $headers)){
        mysqli_query($con, "UPDATE std_assign SET Score = '$points' WHERE Student_ID = '$std_id'");
    }
}


?>