<?php  
include_once '../database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
function random_strings($length_of_string)
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result),0, $length_of_string);
}

$id = mysqli_real_escape_string($con, $_POST['reg_num']);
$current_year = date("Y");
$std_id = "$current_year-".(sprintf("%'.04d","$id"));

$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
$middlename = mysqli_real_escape_string($con, $_POST['middlename']);
$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$grade = mysqli_real_escape_string($con, $_POST['grade']);
$strand = mysqli_real_escape_string($con, $_POST['strand']);
$password = random_strings(8);
$new_password = password_hash($password, PASSWORD_BCRYPT);

$lrn = "100146".(sprintf("%'.06d",rand(1,999999)));
$date = date("F j, Y");

$get = mysqli_query($con, "SELECT * FROM grade Where ID = '$grade'");
$row = mysqli_fetch_assoc($get);
$school_fees = mysqli_query($con, "SELECT sum(Amount) as amount FROM fees Where Grade_ID = '$grade'");
$row_fee = mysqli_fetch_assoc($school_fees);
$amount = $row_fee['amount'];
$due = date("Y-m-d", strtotime("+10 day"));

if ($row['Department'] == "SHSDEPT") {
    $insert_grade = mysqli_query($con, "INSERT INTO student_grade (Student_ID, Class_ID, Strand) VALUES ('$std_id', '$grade', '$strand')");
    if ($insert_grade) {
        mysqli_query($con, "INSERT INTO student_fees(Student_ID, Total_Fees, Status, Due_Date) VALUES ('$std_id', '$amount', '1', '$due')");
        mysqli_query($con, "UPDATE student SET Student_ID = '$std_id' ,Enrollment_Status = 'To Pay', LRN = '$lrn', Date_Approve = '$date' Where ID = '$id'");

               $subject = "Enrollment Confirmation";
        $htmlContent = '
           <html> 
                <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                    <div style="padding: 2rem 2rem 2rem 2rem; text-align: center;">
                        <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="100px" height="100px" style="border-radius: 100%;">
                        <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">Welcome to Holy Child Academy</h1>
                        <p style="color: #333; font-size: 16px; font-weight: 300;">This e-mail serves as confirmation that <b>Your Enrollment Application Was Approved!</b></p>
                        <p style="color: #333; font-size: 16px; font-weight: 300;">To procced for the payment, you may click the button below. Please use the provided account Username and Password to access you Holy Child Academy Portal.</p>
                        <p style="color: #333; font-size: 16px; font-weight: 300;"><b>NOTE: </b>Please DO NOT FORGET to change your default password for you to be able to secure your HCA PORTAL ACCOUNT.</p>
                        <table style="text-align: left; display: flex; justify-content: center; align-items: center; font-size: 14px;font-weight: 300; color: #5c5c5c; margin-bottom: 30px;">
                            <tr> 
                                <th>Username:</th>
                                <td>'.$std_id.'</td> 
                            </tr> 
                            <tr> 
                                <th>Password:</th>
                                <td>'.$password.'</td> 
                            </tr>
            
                            <tr> 
                                <th>PayPal Name:</th>
                                <td>Sample Payment Name</td> 
                            </tr>
            
                            <tr> 
                                <th>PayPal Email:</th>
                                <td>hca100146@gmail.com</td> 
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
            mysqli_query($con, "INSERT INTO std_account (Student_ID, Firstname, Middlename, Lastname, Email, Password, Status) VALUES ('$std_id', '$firstname', '$middlename', '$lastname', '$email', '$new_password', '1')");
            $get = mysqli_query($con, "SELECT * FROM schedule WHERE Class_ID = '$grade' AND Strand = '$strand'");
        while ($row = mysqli_fetch_assoc($get)) {
            $sched_id = $row['ID'];
            mysqli_query($con, "INSERT INTO handle_student (Student_ID, Sched_ID) Values('$std_id', '$sched_id')");
        
        }
            echo 'Email has sent successfully.'; 
        }
    }
    
}else{
    $insert_grade = mysqli_query($con, "INSERT INTO student_grade (Student_ID, Class_ID) VALUES ('$std_id', '$grade')");
    if ($insert_grade) {
        mysqli_query($con, "INSERT INTO student_fees(Student_ID, Total_Fees, Status, Due_Date) VALUES ('$std_id', '$amount', '1', '$due')");
       mysqli_query($con, "UPDATE student SET Student_ID = '$std_id' ,Enrollment_Status = 'To Pay', LRN = '$lrn', Date_Approve = '$date' Where ID = '$id'");
        $subject = "Enrollment Confirmation";
        $htmlContent = '
           <html> 
                <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                    <div style="padding: 2rem 2rem 2rem 2rem; text-align: center;">
                        <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="100px" height="100px" style="border-radius: 100%;">
                        <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">Welcome to Holy Child Academy</h1>
                        <p style="color: #333; font-size: 16px; font-weight: 300;">This e-mail serves as confirmation that <b>Your Enrollment Application Was Approved!</b></p>
                        <p style="color: #333; font-size: 16px; font-weight: 300;">To procced for the payment, you may click the button below. Please use the provided account Username and Password to access you Holy Child Academy Portal.</p>
                        <p style="color: #333; font-size: 16px; font-weight: 300;"><b>NOTE: </b>Please DO NOT FORGET to change your default password for you to be able to secure your HCA PORTAL ACCOUNT.</p>
                        <table style="text-align: left; display: flex; justify-content: center; align-items: center; font-size: 14px;font-weight: 300; color: #5c5c5c; margin-bottom: 30px;">
                            <tr> 
                                <th>Username:</th>
                                <td>'.$std_id.'</td> 
                            </tr> 
                            <tr> 
                                <th>Password:</th>
                                <td>'.$password.'</td> 
                            </tr>
            
                            <tr> 
                                <th>PayPal Name:</th>
                                <td>Sample Payment Name</td> 
                            </tr>
            
                            <tr> 
                                <th>PayPal Email:</th>
                                <td>hca100146@gmail.com</td> 
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
            mysqli_query($con, "INSERT INTO std_account (Student_ID, Firstname, Middlename, Lastname, Email, Password, Status) VALUES ('$std_id', '$firstname', '$middlename', '$lastname', '$email', '$new_password', '1')");
            $get = mysqli_query($con, "SELECT * FROM schedule WHERE Class_ID = '$grade'");
        while ($row = mysqli_fetch_assoc($get)) {
            $sched_id = $row['ID'];
            mysqli_query($con, "INSERT INTO handle_student (Student_ID, Sched_ID) Values('$std_id', '$sched_id')");
        
        }
            echo 'Email has sent successfully.'; 
        }
    }else{
        echo "failed";
    }
}

?>