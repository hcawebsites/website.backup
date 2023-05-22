<?php
include_once ('../database/connection.php');
use PHPMailer\PHPMailer\PHPMailer;
$info = array();



if (isset($_POST['forgot'])) {

	$username = mysqli_real_escape_string($con, $_POST['username']);
    $email1 = mysqli_real_escape_string($con, $_POST['email']);
    $sql = "SELECT * FROM std_account WHERE Username = '$username'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $email  = $row['Email'];
    

    if ($email == "$email1") {
        $prefix = substr(str_shuffle(implode(range("A","z"))),0,4);
        $code = $prefix.(sprintf(rand(1,9999)));
        $newpass = password_hash($code, PASSWORD_BCRYPT);

        $sql = "UPDATE std_account SET Password = '$newpass' WHERE Username = '$username'";
        $result = mysqli_query($con, $sql);

        if ($result) {

            
        $name = "Holy Child Academy Portal";  
        $to = $email; 
        $subject = "Password Confirmation";
        $body = '<html><body>';
        $body .= '<p>Hello <b>'.$row['Firstname'].',<b></p><b>Welcome to Holy Child Academy</b>
        <br><p>This e-mail serves as a confirmation that <b>Your Password Was Successfully Changed!</b><br><br>
        <b>NOTE1: </b>Please DO NOT FORGET to change your new password for you tobe able to secure your HCA PORTAL ACCOUNT</p>
        <b>NOTE2: </b>Please DO NOT FORGET the password that you will replace for you to be able to access your HCA
        PORTAL ACCOUNT to check your enrollment status, class schedule, grades and others.
        <p>Your New Temporary Password: '.$code.'</p>
        <br><br><p>Thank you and God blessed!</p><br><br><br><br><br>';
        $body .= '</body></html>';
        $from = "hca100146@gmail.com"; 
        $password = "parttwcgbyxzklce";

        require_once "../PHPMailer/PHPMailer.php";
        require_once "../PHPMailer/SMTP.php";
        require_once "../PHPMailer/Exception.php";
        $mail = new PHPMailer();

   
        $mail->isSMTP();
                   
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->IsHTML(true);
        $mail->Username = $from;
        $mail->Password = $password;
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
            
            echo '<script>
                alert("Weve sent a temporary password to your email - '.$email.'");
                window.location.href = "../student/std_login.php";
            </script>';
        } else {
            echo '<script>
                alert("Something went wrong!");
                window.location.href = "../student/forgot_password.php";
            </script>';
        }
           
        }
    }else{
        echo '<script>
                alert("Username or Email Incorrect!");
                window.location.href = "../student/forgot-password.php;"
            </script>';
    }

  

    }


?>