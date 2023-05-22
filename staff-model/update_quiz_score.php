<?php 
include_once ('../database/connection.php');
use PHPMailer\PHPMailer\PHPMailer;
$student_id = $_GET['student_id'];
$quiz_id = $_GET['quiz_id'];

if (isset($_POST['return'])) {
    $sql = mysqli_query($con, "SELECT * FROM student Where Student_ID = '$student_id'");
    $sql1 = mysqli_query($con, "SELECT * from quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE quiz.Quiz_ID = '$quiz_id' ");
    $row = mysqli_fetch_assoc($sql1);
    $title = $row['Title'];
    $tname = $row['Salutation'] .". " .$row['Firstname'] . " " .$row['Lastname'];
    $classname = $row['Classname'];
    $rowEmail = mysqli_fetch_array($sql);
    $email = $rowEmail['Email'];
    $firstname = $rowEmail['Firstname'];
    $points = mysqli_real_escape_string($con, $_POST['score']);

    $subject = "Graded: ".$title."";
    $htmlContent = '
       <html> 
            <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                <div style="padding: .5rem .5rem .5rem .5rem;">
                    <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="50px" style="border-radius: 100%;">
                    <p style="color: #666666; font-size: 12px; font-weight: 300;">Dear '.$firstname.',</p>
                    <p style="color: #333; font-size: 12px; font-weight: 300;">'.$tname.' update your score '.$title.' in '.$classname.'.</p>
                    <p style="color: #5c5c5c; font-size: 10px; font-weight: 300;">Score:</p>
                    <p style="color: #333; font-size: 16px; font-weight: 300;">'.$title.'</p>
                    <p style="color: #333; font-size: 12px; font-weight: 300;">Mark: '.$points.'</p>
                </div>
            </body> 
        </html>
    ';
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    if(mail($email, $subject, $htmlContent, $headers)){
        mysqli_query($con, "UPDATE std_quiz SET Score = '$points' WHERE Student_ID = '$student_id' AND Quiz_ID = '$quiz_id'");
        echo '<script>
            alert("Student score Updated!")
            window.location.href="../staff/teachers/std_quiz.php?quiz_id='.$quiz_id.'"
            </script>';
    }

        

    }
    

?>