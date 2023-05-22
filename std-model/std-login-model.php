<?php 
session_start();
include_once ('../database/connection.php');
use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['login'])) {

	$username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM std_account WHERE Student_ID = '$username'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $username;
	
    if (mysqli_num_rows($result) > 0) {
    	$std_password = $data['Password'];
		$firstname = $data['Firstname'];
		$email = $data['Email'];
		$otp = rand(111111,999999);

    	if (password_verify($password, $std_password)) {

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
                mysqli_query($con, "UPDATE std_account SET Otp = '$otp' Where Student_ID = '$username'");
                echo "<script>window.location.href='../student/otpVerification.php';</script>";
                exit;
            }

			
		}
		else{
			echo "<script>alert('Username or Password Incorrect!')</script>";
		}


}else{
	echo "<script>alert('No Credentials Found!')</script>";
}

}


?>




