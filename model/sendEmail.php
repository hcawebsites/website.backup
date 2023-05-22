<?php
include_once '../database/connection.php';
extract($_POST);

$std_id = mysqli_real_escape_string($con, $_POST['std_id']);
$_get = mysqli_query($con, "SELECT * FROM student inner join student_fees on student.Student_ID = student_fees.Student_ID WHERE student.Student_ID = '$std_id'");
$row = mysqli_fetch_assoc($_get);
$email = $row['Email'];
$firstname = $row['Firstname'];
$total = $row['Total_Fees'];
$due = date("F j, Y", strtotime($row['Due_Date']));

$subject = "Payment Notification";
$htmlContent = '
   <html> 
        <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
            <div style="padding: 2rem 2rem 2rem 2rem; text-align: center;">
                <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="100px" height="100px" style="border-radius: 100%;">
                <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">Hello, '.$firstname.'</h1>
                <p style="color: #333; font-size: 16px; font-weight: 300;">Your School Bills of PHP '.$total.', and is due on '.$due.'. Kindly disregard this e-mail if a payment has been made.</p>
                <p style="color: #333; font-size: 16px; font-weight: 300;">To procced for the payment, you may click the button below.</p>
                <p style="color: #333; font-size: 16px; font-weight: 300;">Thank you and God Blessed!.</p>
               
                <a href="https://portalhcamis.000webhostapp.com/student/std_login.php" style=" margin-top: 100px; text-decoration: none; color: #fff; background-color: #008CFF; padding: 1rem 1rem 1rem 1rem; border-radius: 10px;">Click Here!</a>
            </div>
        </body> 
    </html>
';
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

if(mail($email, $subject, $htmlContent, $headers)){
    echo 'success';
}

?>