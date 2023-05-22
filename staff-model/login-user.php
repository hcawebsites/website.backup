
<?php session_start();
 include_once '../database/connection.php';
 use PHPMailer\PHPMailer\PHPMailer;
 
 if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql="SELECT * FROM user WHERE Username = '$username'";	
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$_SESSION["username"]=$username;

    if(mysqli_num_rows($result) > 0){
		$password1 = $row['Password'];
		$npassword = $row['NPassword'];
		$email = $row['Email'];
		$_SESSION['email'] = $row['Email'];
		$firstname = $row['Firstname'];
		$status = $row['AStatus'];
		$_SESSION['status'] = $status;
		$otp = rand(111111,999999);

        if(password_verify($password, $password1)){

			$query = "UPDATE user SET Otp = '$otp' Where Username = '$username'";
			$res = mysqli_query($con, $query);

			if ($res) {

				$name = "Holy Child Academy Portal";  
				$to = $email; 
				$subject = "One-Time PIN(OTP)";
				$body = '<html><body>';
				$body .= '<p>Hi <b>'.$firstname.'!,</b></p>
				<p>Your One-Time PIN (OTP) is '.$otp.'</b>
				<p>Please disregard this message if you did not initiate this request.</p>
				';
				$body .= '</body></html>';
				$from = "hca100146@gmail.com";

				require_once "../PHPMailer/PHPMailer.php";
				require_once "../PHPMailer/SMTP.php";
				require_once "../PHPMailer/Exception.php";
				$mail = new PHPMailer();

		
				$mail->isSMTP();
						
				$mail->Host = "smtp.gmail.com";
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $from;
				$mail->Password = "parttwcgbyxzklce";
				$mail->Port = 587;  
				$mail->SMTPSecure = "tls";
				$mail->smtpConnect([
				'ssl' => [
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
				]
				]);

				$mail->isHTML(true);
				$mail->setFrom($from, $name);
				$mail->addAddress($to); 
				$mail->Subject = ("$subject");
				$mail->Body = $body;

				if ($mail->send()) {
					header('location:../staff/otpVerification.php');
				} else {
					?>
					<script>
						alert("Something Wen't Wrong!");
					</script>
					<?php
				}


    }
}
}
}
 
 
 
 ?>
