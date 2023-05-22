<?php 
session_start();
include_once 'database/connection.php';


if(isset($_POST['login'])){
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$_SESSION['username'] = $username;
$otp = rand(111111,999999);
$get = mysqli_query($con, "SELECT * FROM user WHERE Username = '$username'");
if(mysqli_num_rows($get) > 0){
    $row = mysqli_fetch_assoc($get);
    $role = $row['Access'];
    $_SESSION['access'] = $role;
    $default = $row['Password'];
    $email = $row['Email'];
    $_SESSION['email'] = $email;
    if(password_verify($password, $default)){
        if($role == 'Admin'){
            $subject = "".$otp." is your verification code";
            $htmlContent = '
               <html> 
                    <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                        <div style="padding: 5rem 5rem 5rem 5rem;">
                            <img src="" width="80px" height="80px">
                            <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">Verification Code</h1>
                            <p style="color: #333; font-size: 16px; font-weight: 300;"></b></p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">To log in your account, enter this code in Holy Child Academy Portal: <b>'.$otp.'</b></p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">If you did not request this code, you can ignore this message.</p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">Thank You and God Blessed!</p>
                        </div>
                    </body> 
                </html>
            ';
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            if(mail($email, $subject, $htmlContent, $headers)){
                mysqli_query($con, "UPDATE user Set Otp = '$otp' WHERE Username = '$username'");
                echo "<script>window.location.href='admin/otpVerification.php'</script>";
                exit();
            }
           
        }else{
           $subject = "".$otp." is your verification code";
            $htmlContent = '
               <html> 
                    <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                        <div style="padding: 5rem 5rem 5rem 5rem;">
                            <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="80px" height="80px">
                            <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">Verification Code</h1>
                            <p style="color: #333; font-size: 16px; font-weight: 300;"></b></p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">To log in your account, enter this code in Holy Child Academy Portal: <b>'.$otp.'</b></p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">If you did not request this code, you can ignore this message.</p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">Thank You and God Blessed!</p>
                        </div>
                    </body> 
                </html>
            ';
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            if(mail($email, $subject, $htmlContent, $headers)){
                mysqli_query($con, "UPDATE user Set Otp = '$otp' WHERE Username = '$username'");
                echo "<script>window.location.href='staff/otpVerification.php'</script>";
                exit();
            }
        }
    }else{
            echo "<script>alert('Username or Password Incorrect!')</script>";
    }
    
}else{
    echo "<script>alert('No Credentials Found!')</script>";
}
}

 



?>