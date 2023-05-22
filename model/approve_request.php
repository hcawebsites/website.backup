<?php include_once('../database/connection.php');

extract($_POST);
if ($_POST) {
	$today = date("Y-d-m"); 
	$std_id = mysqli_real_escape_string($con, $_POST['std-id']);
	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$reason = mysqli_real_escape_string($con, $_POST['reason']);
	$bully_name = mysqli_real_escape_string($con, $_POST['bully_name']);
	$concern = mysqli_real_escape_string($con, $_POST['concern']);
	$date = mysqli_real_escape_string($con, $_POST['date']);
	$date_created = mysqli_real_escape_string($con, $_POST['date_created']);

    $subject = "Appointment Notification";
    $htmlContent = '
       <html> 
            <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                <div style="padding: 2rem 2rem 2rem 2rem; text-align: center;">
                    <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="100px" height="100px" style="border-radius: 100%;">
                    <p style="color: #5c5c5c; font-size: 20px; font-weight: 400;">Hi, '.$firstname.'</p>
                    <p style="color: #333; font-size: 16px; font-weight: 300;">This e-mail serves as a confirmation that <b>Your Appointments Counseling Request is Approved!</p>
                    <table style="text-align: left; display: flex; justify-content: center; align-items: center; font-size: 14px;font-weight: 300; color: #5c5c5c; margin-bottom: 30px;">
                        <tr> 
                            <th>Reason:</th>
                            <td>'.$reason.'</td> 
                        </tr> 
                        <tr> 
                            <th>Name of Bully<small>[if reason is bullying]</small>:</th>
                            <td>'.$bully_name.'</td> 
                        </tr>
        
                        <tr> 
                            <th>Concern:</th>
                            <td>'.$concern.'</td> 
                        </tr>
        
                        <tr> 
                            <th>Schedule</th>
                            <td>'.$date.'</td> 
                        </tr>
                        
                        <tr> 
                            <th>Date Created</th>
                            <td>'.$date_created.'</td> 
                        </tr>
                        
                        <tr> 
                            <th>Date Approved</th>
                            <td>'.$today.'</td> 
                        </tr>
                    </table>
                    <a href="https://portalhcamis.000webhostapp.com/student/std_login.php" style=" margin-top: 100px; text-decoration: none; color: #fff; background-color: #008CFF; padding: 1rem 1rem 1rem 1rem; border-radius: 10px;">Click Here!</a>
                </div>
            </body> 
        </html>
    ';
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    if(mail($email, $subject, $htmlContent, $headers)){
        mysqli_query($con, "UPDATE appointments Set Status = '1' WHERE Student_ID = '$std_id'");
        echo 'success';
    }
}
?>

