<?php  include_once ('../database/connection.php');
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;

$username = $_SESSION['username'];
$errors = array();

if (isset($_POST['submit'])) {

        /* STUDENT DATA */
        $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
        $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
        $suffix = mysqli_real_escape_string($con, $_POST['suffix']);
        $dob = mysqli_real_escape_string($con, $_POST['birthdate']);
        $age = mysqli_real_escape_string($con, $_POST['age']);
        $pob = mysqli_real_escape_string($con, $_POST['birth']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $status = mysqli_real_escape_string($con, $_POST['status']);
        $nationality = mysqli_real_escape_string($con, $_POST['nationality']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $lrn = mysqli_real_escape_string($con, $_POST['lrn']);
        $studentType = mysqli_real_escape_string($con, $_POST['type']);
        $grade = mysqli_real_escape_string($con, $_POST['grade']);
        $sla = mysqli_real_escape_string($con, $_POST['SLA']);
        $lsya = mysqli_real_escape_string($con, $_POST['sy']);
        $genAve = mysqli_real_escape_string($con, $_POST['genAve']);
        $strand = mysqli_real_escape_string($con, $_POST['strand']);
        $phone = mysqli_real_escape_string($con, $_POST['sphone']);
        $email = mysqli_real_escape_string($con, $_POST['email']);

        /* END OF STUDENT DATA*/

        /* PARENTS DATA*/

        $flastname = mysqli_real_escape_string($con, $_POST['flastname']);
        $ffirstname = mysqli_real_escape_string($con, $_POST['ffirstname']);
        $fmiddlename = mysqli_real_escape_string($con, $_POST['fmiddlename']);
        $fnum = mysqli_real_escape_string($con, $_POST['fnum']);

        $mlastname = mysqli_real_escape_string($con, $_POST['mlastname']);
        $mfirstname = mysqli_real_escape_string($con, $_POST['mfirstname']);
        $mmiddlename = mysqli_real_escape_string($con, $_POST['mmiddlename']);
        $mnum = mysqli_real_escape_string($con, $_POST['mnum']);

        $glastname = mysqli_real_escape_string($con, $_POST['glastname']);
        $gfirstname = mysqli_real_escape_string($con, $_POST['gfirstname']);
        $gmiddlename = mysqli_real_escape_string($con, $_POST['gmiddlename']);
        $gnum = mysqli_real_escape_string($con, $_POST['gnum']);
        /* END OF PARENTS DATA*/

        $sql = "SELECT * FROM academic_list WHERE Status = 1";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $semester = $row['Semester'];
        $sy = $row['School_Year'];

            /* INSERT STUDENT DATA */

            $std_data = "INSERT INTO student(Lastname, Firstname, Middlename, Suffix, DOB, Age, POB, Gender, 
            Phone, Email, Grade, Strand, Status, Nationality, Address, LRN, Student_Type, 
            Enrollment_Status, SLA, LSYA, Gen_Ave, Semester, SY, Reg_Number) VALUES ('$lastname', 
            '$firstname', '$middlename', '$suffix', '$dob', '$age', '$pob', '$gender', '$phone', 
            '$email', '$grade', '$strand', '$status', '$nationality', '$address', 
            '$lrn', '$studentType', 'Pending', '$sla', '$lsya', '$genAve', '$semester', '$sy', 
            '$username')";

            $studentData = mysqli_query($con, $std_data);
            $last_id = mysqli_insert_id($con);
/* END */

/* INSERT PARENTS DATA */

        $parents_data = "INSERT INTO guardians (F_Lastname, F_Firstname, F_Middlename, F_Contact, 
        M_Lastname, M_Firstname,  M_Middlename, M_Contact, G_Lastname, G_Firstname, G_Middlename, 
        G_Contact, Reg_Number) VALUES ('$flastname', '$ffirstname', '$fmiddlename', '$fnum', '$mlastname', 
        '$mfirstname', '$mmiddlename', '$mnum', '$glastname', '$gfirstname', '$gmiddlename', '$gnum', 
        '$username')";

        $parentsData = mysqli_query($con, $parents_data);

          if ($studentData && $parentsData) {

            $name = "Holy Child Academy Portal";  
            $to = $email; 
            $subject = "Enrollment Form Confirmation";
            $body = '<html><body>';
            $body .= '<p>Hello <b>'.$firstname.',<b></p><b>Welcome to Holy Child Academy</b>
            <br><p>This e-mail serves as a confirmation that <b>Your Enrollment Form Was Successfully Submitted!</b><br><br>
            <p>Please wait for the approval of your Enrollment Form by the <b>ADMINISTRATOR</b> we will send you an email to confirm if your Enrollment Form has been approved.</p><br>
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
							$notif = mysqli_query($con, "INSERT into main_notification (Notification_ID, _status, isread) Values ('$last_id', 'Enrollment', '0')");
              $sql = "UPDATE std_account SET Status = '1' WHERE Username = '$username'";
              $result = mysqli_query($con, $sql);

              if ($result && $notif) {
                    echo "<script>alert('Enrollment Form Submitted Successfully!')</script>";
                    echo "<script>window.location.href='dashboard.php'</script>";
                    exit();
                }
            } else {
            echo "<script>alert('Something Went Wrong!')</script>";
            echo "<script>window.locatio.href='form.php'</script>";
            }



          }else{
            echo "<script>alert('Something Went Wrong!')</script>";
            echo "<script>window.locatio.href='form.php'</script>";
          }

                        


}

?>