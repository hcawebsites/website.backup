<?php 
session_start();
include_once '../database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['signup'])) {
	$prefix = substr(str_shuffle(implode(range("A","z"))),0,4);
    $code = $prefix.(sprintf(rand(1,9999)));
    $encpass = password_hash($code, PASSWORD_BCRYPT);
	$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$middlename = mysqli_real_escape_string($con, $_POST['middlename']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$access = mysqli_real_escape_string($con, $_POST['access']);

	$sql = mysqli_query($con, "SELECT * from user Where Email = '$email'");
	if (mysqli_num_rows($sql) > 0) {
		echo '
			<script>alert("Email already exist in out database!")</script>
		';
	}
	else{
		if ($access == "Admin") {
			$username = "A-".(sprintf("%'.06d",rand(1,999999)));
			$user_admin = mysqli_query($con, "INSERT INTO user (Username, Lastname, Firstname, Middlename, Email, Password, Access, AStatus) VALUES 
			('$username', '$lastname', '$firstname', '$middlename', '$email', '$encpass', 'Admin', '0')");

			if ($user_admin) {

				$name = "HCAMIS PORTAL";  
						$to = $email; 
						$subject = "HCA - Account Registration";
						$body = '<html><body>';
						$body .= '<p>Dear '.$firstname.',</p>
						<p>This e-mail serves as confirmation that your <b>"YOUR ACCOUNT WAS SUCCESSFULLY CREATED!"</b></b>
						<p>Username: <b>'.$username.'</b></p>
						<p>Username: <b>'.$code.'</b></p>
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
							$sys_log = mysqli_query($con, "INSERT into system_logs (Name, Access, Purpose) Values ('$firstname', 'Admin', 'Account Registration')");
							if ($sys_log) {
								echo '<script>
									alert("Account Created Successful!");
                                    window.location.href="../admin/users.php";
								</script>';
							}
							
						}else{
							echo '<script>
								alert("Something Went Wrong!");
								</script>';
						}
				
						
			}
		}
		elseif ($access == "Teacher") {
			$username = "T-".(sprintf("%'.06d",rand(1,999999)));
			$user_teacher = mysqli_query($con, "INSERT INTO user (Username, Lastname, Firstname, Middlename, Email, Password, Access, AStatus) VALUES 
			('$username', '$lastname', '$firstname', '$middlename', '$email', '$encpass', 'Teacher', '0')");
			$last_id = mysqli_insert_id($con);

			if ($user_teacher) {

				$name = "HCAMIS PORTAL";  
						$to = $email; 
						$subject = "HCA - Account Registration";
						$body = '<html><body>';
						$body .= '<p>Dear '.$firstname.',</p>
						<p>This e-mail serves as confirmation that your <b>"YOUR ACCOUNT WAS SUCCESSFULLY CREATED!"</b></b>
						<p>Username: <b>'.$username.'</b></p>
						<p>Username: <b>'.$code.'</b></p>
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
							$sys_log = mysqli_query($con, "INSERT into system_logs (Name, Access, Purpose) Values ('$firstname', 'Teacher', 'Account Registration')");

							if ($sys_log) {
								echo '<script>
									alert("Account Created Successful!");
                                    window.location.href="../admin/users.php";
								</script>';
							}
							
						}else{
							echo '<script>
								alert("Something Went Wrong!");
								</script>';
						}
				
						
			}
		}
		elseif ($access == "Librarian") {
			$username = "L-".(sprintf("%'.06d",rand(1,999999)));
			$user_teacher = mysqli_query($con, "INSERT INTO user (Username, Lastname, Firstname, Middlename, Email, Password, Access, AStatus) VALUES 
			('$username', '$lastname', '$firstname', '$middlename', '$email', '$encpass', 'Librarian', '0')");

			if ($user_teacher) {

				$name = "HCAMIS PORTAL";  
						$to = $email; 
						$subject = "HCA - Account Registration";
						$body = '<html><body>';
						$body .= '<p>Dear '.$firstname.',</p>
						<p>This e-mail serves as confirmation that your <b>"YOUR ACCOUNT WAS SUCCESSFULLY CREATED!"</b></b>
						<p>Username: <b>'.$username.'</b></p>
						<p>Username: <b>'.$code.'</b></p>
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
							$sys_log = mysqli_query($con, "INSERT into system_logs (Name, Access, Purpose) Values ('$firstname', 'Librarian', 'Account Registration')");

							if ($sys_log) {
								echo '<script>
									alert("Account Created Successful!");
                                    window.location.href="../admin/users.php";
								</script>';
							}
							
						}else{
							echo '<script>
								alert("Something Went Wrong!");
								</script>';
						}
				
						
			}
		}
		elseif ($access == "Nurse") {
			$username = "N-".(sprintf("%'.06d",rand(1,999999)));
			$user_teacher = mysqli_query($con, "INSERT INTO user (Username, Lastname, Firstname, Middlename, Email, Password, Access, AStatus) VALUES 
			('$username', '$lastname', '$firstname', '$middlename', '$email', '$encpass', 'Nurse', '0')");

			if ($user_teacher) {

				$name = "HCAMIS PORTAL";  
						$to = $email; 
						$subject = "HCA - Account Registration";
						$body = '<html><body>';
						$body .= '<p>Dear '.$firstname.',</p>
						<p>This e-mail serves as confirmation that your <b>"YOUR ACCOUNT WAS SUCCESSFULLY CREATED!"</b></b>
						<p>Username: <b>'.$username.'</b></p>
						<p>Username: <b>'.$code.'</b></p>
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
							$sys_log = mysqli_query($con, "INSERT into system_logs (Name, Access, Purpose) Values ('$firstname', 'Nurse', 'Account Registration')");
							$notif = mysqli_query($con, "INSERT into main_notification (Notification_ID, _status, isread) Values ('$last_id', 'Registration', '0')");

							if ($sys_log) {
								echo '<script>
									alert("Account Created Successful!");
                                    window.location.href="../admin/users.php";
								</script>';
							}
							
						}else{
							echo '<script>
								alert("Something Went Wrong!");
								</script>';
						}
				
						
			}
		}
		elseif ($access == "Counsilor") {
			$username = "C-".(sprintf("%'.06d",rand(1,999999)));
			$user_teacher = mysqli_query($con, "INSERT INTO user (Username, Lastname, Firstname, Middlename, Email, Password, Access, AStatus) VALUES 
			('$username', '$lastname', '$firstname', '$middlename', '$email', '$encpass', 'Counsilor', '0')");

			if ($user_teacher) {

				$name = "HCAMIS PORTAL";  
						$to = $email; 
						$subject = "HCA - Account Registration";
						$body = '<html><body>';
						$body .= '<p>Dear '.$firstname.',</p>
						<p>This e-mail serves as confirmation that your <b>"YOUR ACCOUNT WAS SUCCESSFULLY CREATED!"</b></b>
						<p>Username: <b>'.$username.'</b></p>
						<p>Username: <b>'.$code.'</b></p>
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
							$sys_log = mysqli_query($con, "INSERT into system_logs (Name, Access, Purpose) Values ('$firstname', 'Counsilor', 'Account Registration')");

							if ($sys_log) {
								echo '<script>
									alert("Account Created Successful!");
                                    window.location.href="../admin/users.php";
								</script>';
							}
							
						}else{
							echo '<script>
								alert("Something Went Wrong!");
								</script>';
						}
				
						
			}
		}
		elseif ($access == "Cashier") {
			$username = "CH-".(sprintf("%'.06d",rand(1,999999)));
			$user_teacher = mysqli_query($con, "INSERT INTO user (Username, Lastname, Firstname, Middlename, Email, Password, Access, AStatus) VALUES 
			('$username', '$lastname', '$firstname', '$middlename', '$email', '$encpass', 'Cashier', '0')");

			if ($user_teacher) {

				$name = "HCAMIS PORTAL";  
						$to = $email; 
						$subject = "HCA - Account Registration";
						$body = '<html><body>';
						$body .= '<p>Dear '.$firstname.',</p>
						<p>This e-mail serves as confirmation that your <b>"YOUR ACCOUNT WAS SUCCESSFULLY CREATED!"</b></b>
						<p>Username: <b>'.$username.'</b></p>
						<p>Username: <b>'.$code.'</b></p>
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
							$sys_log = mysqli_query($con, "INSERT into system_logs (Name, Access, Purpose) Values ('$firstname', 'Cashier', 'Account Registration')");
						

							if ($sys_log) {
								echo '<script>
									alert("Account Created Successful!");
                                    window.location.href="../admin/users.php";
								</script>';
							}
							
						}else{
							echo '<script>
								alert("Something Went Wrong!");
								</script>';
						}
				
						
			}
		}
	}
}



?>