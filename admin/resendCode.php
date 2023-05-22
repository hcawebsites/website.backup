<?php
session_start();
include_once '../database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
$id = $_SESSION['username'];
$otp = rand(111111,999999);
$sql = "UPDATE user SET Otp = '$otp' Where Username = '$id'";
$res = mysqli_query($con, $sql);

$sql1 = "SELECT * FROM user Where Username = '$id'";
$result = mysqli_query($con, $sql1);
$row = mysqli_fetch_assoc($result);
$email = $row['Email'];

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
        header('location:otpVerification.php');
    }else{
        echo '<script type="text/javascript">alert("Something Went Wrong")</script>';
    }

}



?>