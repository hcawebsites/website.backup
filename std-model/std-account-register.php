<?php session_start(); ?>
<?php include_once ('database/connection.php');
use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['submit'])) {
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
	$middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $contact = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $reg_year=date("Y");
	$reg_month=date("F");
	$reg_date=date("Y-m-d");
    $date = date("M d Y, h:m:s");
    

        $check_email = "SELECT * FROM std_account WHERE Email = '$email'";
        $res = mysqli_query($con, $check_email);

        if(mysqli_num_rows($res) > 0){
            echo "<script>alert('Email you have entered already Exists')</script>";
            echo "<script>window.location.href='index.php'</script>";
        }else{

            $sql = "SELECT * FROM academic_list where is_default = 1";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $status = $row['Status'];
            $prefix = substr(str_shuffle(implode(range("A","Z"))),0,4);
            $tpass = $prefix.(sprintf(rand(1,9999)));
            $password = password_hash($tpass, PASSWORD_BCRYPT);

            if ($status == 1) {

                $sql = "INSERT INTO std_account (Firstname, Middlename, Lastname, Contact, Email, Password) VALUES 
                ('$firstname', '$middlename', '$lastname', '$contact', '$email', '$password')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $last_id = mysqli_insert_id($con);
                    if ($last_id) {
                        $current_year = date("Y");
                        $username = "$current_year-".(sprintf("%'.04d","$last_id"));
                        $query = "UPDATE std_account SET Username = '$username' Where ID = '$last_id'";
                        mysqli_query($con, $query);
                    }

                    $name = "Holy Child Academy Portal";  
                    $to = $email; 
                    $subject = "Pre-Registration Student Account";
                    $body = '<html><body>';
                    $body .= '<p>Hello <b>'.$firstname.',<b></p><b>Welcome to Holy Child Academy</b>
                    <br><p>This e-mail serves as a confirmation that <b>Your Account Has Been Successfully Created!</b>
                    <p>To procced for the ENROLLMENT, you may log-in at the link given below. Please USE the provided account username and Password to access your HCA Portal.</p>
                    <p><b>NOTE1: </b>Please DO NOT FORGET to change your new password for you to be able to secure your HCA PORTAL ACCOUNT.</p>
                    <p><b>NOTE2: </b>Please DO NOT FORGET the password that you will replace for you to be able to access your HCA PORTAL ACCOUNT.</p>

                    <p>Your Account Username: '.$username.'</p>
                    <p>Your Account Password: '.$tpass.'</p>
                    <p>Log-in Here: http://localhost/hcamis/student/std_login.php</p>

                    <br><br><p>Thank you and God blessed!</p><br><br><br><br><br>';
                    $body .= '</body></html>';
                    $from = "hca100146@gmail.com";

                    require_once "PHPMailer/PHPMailer.php";
                    require_once "PHPMailer/SMTP.php";
                    require_once "PHPMailer/Exception.php";
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
                        ?>
                        <script>
                            alert("Your Account Has Been Successfully Created!.\nPlease Check Your Email, for you to able to see your log-in credentials.\n\n\nThank you and Godblessed!");
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                            alert("Something Wen't Wrong!");
                        </script>
                        <?php
                    }
                }
                
            }else{
                header('location: index.php?error=Enrollment Has Been Closed!');
            }
        }
        
    
 


    
}


?>