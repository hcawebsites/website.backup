<?php
include_once 'database/connection.php';
extract($_POST);
$username = mysqli_real_escape_string($con, $_POST['username']);
$email = mysqli_real_escape_string($con, $_POST['email']);
function random_strings($length_of_string)
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result),0, $length_of_string);
}
$password = random_strings(8);
$new_password = password_hash($password, PASSWORD_BCRYPT);

$_chk = mysqli_query($con, "SELECT * FROM user WHERE Username = '$username' AND Email = '$email'");
if(mysqli_num_rows($_chk) > 0){
    $insert = mysqli_query($con, "UPDATE user SET Password = '$new_password' WHERE Username = '$username'");
    if($insert){
         $subject = "Reset Password";
            $htmlContent = '
               <html> 
                    <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                        <div style="padding: .5rem .5rem .5rem .5rem;">
                            <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="80px" height="80px" style="border-radius: 100%;">
                            <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">New Password</h1>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">Hi,</p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">Your new password is: <b>'.$password.'</b></p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">Note: Do not forget to change your password to secure your account.</p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">Thank You and God Blessed!</p>
                        </div>
                    </body> 
                </html>
            ';
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            if(mail($email, $subject, $htmlContent, $headers)){
                echo 'Admin';
            }
    }else{
        echo "failed";
    }
}else{
    $_chk_student = mysqli_query($con, "SELECT * FROM std_account WHERE Student_ID = '$username' AND Email = '$email'");
    
    if(mysqli_num_rows($_chk_student) > 0){
        $insert = mysqli_query($con, "UPDATE std_account SET Password = '$new_password' WHERE Student_ID = '$username'");
        if($insert){
           $subject = "Reset Password";
            $htmlContent = '
               <html> 
                    <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                        <div style="padding: .5rem .5rem .5rem .5rem;">
                            <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="80px" height="80px" style="border-radius: 100%;">
                            <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">New Password</h1>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">Hi,</p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">Your new password is: <b>'.$password.'</b></p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">Note: Do not forget to change your password to secure your account.</p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">Thank You and God Blessed!</p>
                        </div>
                    </body> 
                </html>
            ';
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            if(mail($email, $subject, $htmlContent, $headers)){
                echo 'Student';
            }
        }else{
            echo "failed";
        }
    }else{
        echo 'No Credentials Found!';
    }
}
?>