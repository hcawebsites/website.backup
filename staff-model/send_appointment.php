<?php  
include_once '../database/connection.php';

extract($_POST);
	$std_id = mysqli_real_escape_string($con, $_POST['std_id']);
	$reason = mysqli_real_escape_string($con, $_POST['reason']);
	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$date = mysqli_real_escape_string($con, $_POST['date']);
	$time = mysqli_real_escape_string($con, $_POST['time']);

	$chk = mysqli_query($con, "SELECT * FROM clinic_appointments WHERE Student_ID = '$std_id' And Status = '1'");

	if (mysqli_num_rows($chk) > 0) {
		echo "Appointment Already Sent!";
	}else{
	    $subject = "Appointment Notification";
        $htmlContent = '
           <html> 
                <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                    <div style="padding: 2rem 2rem 2rem 2rem; text-align: center;">
                        <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="100px" height="100px" style="border-radius: 100%;">
                        <p style="color: #5c5c5c; font-size: 20px; font-weight: 400;">Hi, '.$firstname.'</p>
                        <p style="color: #333; font-size: 16px; font-weight: 300;">Please go to the school clinic for your check up.</p>
                        <table style="text-align: left; display: flex; justify-content: center; align-items: center; font-size: 14px;font-weight: 300; color: #5c5c5c; margin-bottom: 30px;">
                            <tr> 
                                <th>Reason:</th>
                                <td>'.$reason.'</td> 
                            </tr> 
            
                            <tr> 
                                <th>Date:</th>
                                <td>'.$date.'</td> 
                            </tr>
            
                            <tr> 
                                <th>Time</th>
                                <td>'.$time.'</td> 
                            </tr>
                        </table>
                    </div>
                </body> 
            </html>
        ';
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        if(mail($email, $subject, $htmlContent, $headers)){
            mysqli_query($con, "INSERT INTO clinic_appointments (Student_ID, Reason, Date, Time, Status) VALUES ('$std_id', '$reason', '$date', '$time', 1)");
            echo 'success';
        }
	}

?>