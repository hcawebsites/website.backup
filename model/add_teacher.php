<?php include_once('../database/connection.php');
include_once "../phpqrcode/qrlib.php";

$reg_date = mysqli_real_escape_string($con, $_POST['date']);
$department = mysqli_real_escape_string($con, $_POST['dept']);
$teacher_id = mysqli_real_escape_string($con, $_POST['teacher_id']);
$salutation = mysqli_real_escape_string($con, $_POST['salutation']);
$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
$middlename = mysqli_real_escape_string($con, $_POST['middlename']);
$suffix = mysqli_real_escape_string($con, $_POST['suffix']);
$birthdate = mysqli_real_escape_string($con, $_POST['birthdate']);
$age = mysqli_real_escape_string($con, $_POST['age']);
$gender = mysqli_real_escape_string($con, $_POST['gender']);
$status = mysqli_real_escape_string($con, $_POST['status']);
$nationality = mysqli_real_escape_string($con, $_POST['nationality']);
$address = mysqli_real_escape_string($con, $_POST['address']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
function random_strings($length_of_string)
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result),0, $length_of_string);
}
$default = random_strings(8);
$password = password_hash($default, PASSWORD_BCRYPT);

$img_name = $_FILES['my_image']['name'];
$img_size = $_FILES['my_image']['size'];
$tmp_name = $_FILES['my_image']['tmp_name'];
$error = $_FILES['my_image']['error'];
$location = "../T-QRCODE/".$teacher_id.".png";

$tqrcode = $teacher_id.".png";

$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
$img_ex_lc = strtolower($img_ex);
$allowed_exs = array("jpg", "jpeg", "png");


if (in_array($img_ex_lc, $allowed_exs)) {
    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
    $img_upload_path = '../assets/upload/'.$new_img_name;
    move_uploaded_file($tmp_name, $img_upload_path);
    
    $_chk = mysqli_query($con, "SELECT * FROM teacher_tb Where Email = '$email'");
    
    if(mysqli_num_rows($_chk) > 0){
        echo 'Email Already Existed';
    }else{
        $insert = mysqli_query($con, "INSERT INTO teacher_tb (Emp_ID, Salutation, Lastname, Firstname, Middlename, Suffix, DOB, Age, Gender, Status, Address, Nationality, Contact, Email, Department, Picture, QR_Code, Date) VALUES ('$teacher_id', '$salutation', '$lastname', '$firstname', '$middlename', '$suffix', '$birthdate', '$age', '$gender', '$status', '$address', '$nationality', '$phone', '$email', '$department', '$new_img_name', '$tqrcode', '$reg_date')");
        if($insert){
            $subject = "Account Confirmation";
            $htmlContent = '
               <html> 
                    <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                        <div style="padding: 2rem 2rem 2rem 2rem; text-align: center;">
                            <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="100px" height="100px" style="border-radius: 100%;">
                            <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">Welcome to Holy Child Academy</h1>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">This e-mail serves as confirmation that <b>Your Account has been Created!</b></p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;">To login you may click the button below. Please use the provided account Username and Password to access your Holy Child Academy Poeral.</p>
                            <p style="color: #333; font-size: 16px; font-weight: 300;"><b>NOTE: </b>Please DO NOT FORGET to change your default password for you to be able to secure your HCA PORTAL ACCOUNT.</p>
                            <table style="text-align: left; display: flex; justify-content: center; align-items: center; font-size: 14px;font-weight: 300; color: #5c5c5c; margin-bottom: 30px;">
                                <tr> 
                                    <th>Username:</th>
                                    <td>'.$teacher_id.'</td> 
                                </tr> 
                                <tr> 
                                    <th>Password:</th>
                                    <td>'.$default.'</td> 
                                </tr>
                            </table>
                            <a href="https://portalhcamis.000webhostapp.com/login.php" style=" margin-top: 100px; text-decoration: none; color: #fff; background-color: #008CFF; padding: 1rem 1rem 1rem 1rem; border-radius: 10px;">Click Here!</a>
                        </div>
                    </body> 
                </html>
            ';
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            if(mail($email, $subject, $htmlContent, $headers)){
                mysqli_query($con, "INSERT INTO user (Username, Lastname, Firstname, Middlename, Contact, Email, Password, Access, AStatus) VALUES ('$teacher_id', '$lastname', '$firstname', '$middlename', '$phone', '$email', '$password', 'Teacher', '1')");
                QRcode::png($teacher_id, $location , 150, 150);
                echo 'success';
            }
        }
    }
    
    }
    
    








?>