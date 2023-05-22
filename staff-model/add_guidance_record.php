<?php  
include_once '../database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;

extract($_POST);

if ($_POST) {
    $std_id = mysqli_real_escape_string($con, $_POST['std_id']);
    $std_name = mysqli_real_escape_string($con, $_POST['name']);
    $violation = mysqli_real_escape_string($con, $_POST['violation']);
    $offense = mysqli_real_escape_string($con, $_POST['offense']);
    $punishment = mysqli_real_escape_string($con, $_POST['punishment']);
    $get = mysqli_query($con, "SELECT Firstname, Email from student Where Student_ID = '$std_id'");
    $row = mysqli_fetch_assoc($get);
    $firstname = $row['Firstname'];
    $email = $row['Email'];

    $subject = "Guidance Notification";
    $htmlContent = '
       <html> 
            <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                <div style="padding: 2rem 2rem 2rem 2rem; text-align: center;">
                    <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="100px" height="100px" style="border-radius: 100%;">
                    <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">Hi, '.$firstname.'</h1>
                    <p style="color: #333; font-size: 16px; font-weight: 300;">This e-mail inform you that you have a violation in our School</p>
                    <p style="color: #333; font-size: 16px; font-weight: 300;">Please report to the guidance AS SOON AS POSSIBLE to settle your violation.</p>
                   
                    <table style="text-align: left; display: flex; justify-content: center; align-items: center; font-size: 14px;font-weight: 300; color: #5c5c5c; margin-bottom: 30px;">
                        <tr> 
                            <th>Student ID:</th>
                            <td>'.$std_id.'</td> 
                        </tr> 
                        <tr> 
                            <th>Student Name:</th>
                            <td>'.$std_name.'</td> 
                        </tr>
        
                        <tr> 
                            <th>Violation:</th>
                            <td>'.$violation.'</td> 
                        </tr>
        
                        <tr> 
                            <th>Offense:</th>
                            <td>'.$offense.'</td> 
                        </tr>
                        
                         <tr> 
                            <th>Punishment:</th>
                            <td>'.$punishment.'</td> 
                        </tr>
                    </table>
                </div>
            </body> 
        </html>
    ';
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    if(mail($email, $subject, $htmlContent, $headers)){
        mysqli_query($con, "INSERT into guidance (Student_ID, Name, Violation, Offense, Punishment, Status) VALUES ('$std_id', '$std_name', '$violation', '$offense', '$punishment', '1')");
        echo 'success';
    }

}

?>