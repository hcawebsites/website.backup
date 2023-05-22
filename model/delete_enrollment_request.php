<?php include_once '../database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);
	$reason = mysqli_real_escape_string($con, $_POST['reason']);

	$get = mysqli_query($con, "SELECT Email, Firstname From student Where Reg_Number = '$id'");
	$row = mysqli_fetch_assoc($get);
	$email = $row['Email'];
	$firstname = $row['Firstname'];

		$name = "HCAMIS";
		$to = $email;
		$subject = "Enrollment Request";
		$body = "<html><body>";
		$body .= "
			<p>Hello, <b>".$firstname."</b> This email serves as verification that YOUR ENROLLMENT REQUEST IS REJECTED!</p>
			<p>Reasons: <b>".$reason."</b></p>
			<p>For more information please contact school Admin or visit us!</p>
			<p>Phone: (075) 632 3049</p>
			<p>Facebook: https://www.facebook.com/HCABin</p>
			<p>Email:  HolyChildAcademyBinalonan@gmail.com</p>
			<p>Address: October 16 St. Poblacion, Binalonan, Pangasinan 2438</p>
			<br><br>
			<p>Thank you and Godblessed!</p>
		";
		$body .="</body></html>";
		$from = "hca100146@gmail.com";

		require_once '../PHPMailer/SMTP.php';
		require_once '../PHPMailer/PHPMailer.php';
		require_once '../PHPMailer/Exception.php';
		$mail = new PHPMailer();

		$mail ->isSMTP(true);
		$mail -> Host = "smtp.gmail.com";
		$mail -> SMTPAuth = true;
		$mail -> IsHTML(true);
		$mail -> Username = $from;
		$mail -> Password = 'parttwcgbyxzklce';
		$mail -> Port = 587;
		$mail -> SMTPSecure = 'tls';
		$mail -> smtpConnect([
			'ssl' => [
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			]
		]);

		$mail -> isHTML(true);
		$mail -> setFrom($from, $name);
		$mail -> addAddress($to);
		$mail -> Subject = $subject;
		$mail -> Body = $body;

		if ($mail -> send()) {
			mysqli_query($con, "UPDATE student Set Enrollment_Status = 'Disqualified' Where Reg_Number = '$id'");
			mysqli_query($con, "UPDATE std_account SET Status = '3' Where Username = '$id'");
			mysqli_query($con, "INSERT into disqualified_enrollment (Reg_Number, Reason) Values ('$id', '$reason')");
		}else{
			echo "failed";
		}
}


?>