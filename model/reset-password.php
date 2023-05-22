<?php 
include_once 'database/connection.php';
$info = array();

if (isset($_POST['reset'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $user = "SELECT * FROM user Where Username = '$username'";
    $res = mysqli_query($con, $user);
    $row1 = mysqli_fetch_assoc($res);
    $type = $row1['Type'];
    
    

    if ($type == "") {
        $errors = "No Credentials Found!";
        header("Location: reset_password.php?error=$errors");
}else{

    if ($type == "Admin") {

        $admin = "SELECT * FROM admin Where Admin_ID = '$username'";
        $result = mysqli_query($con, $admin);
        $row = mysqli_fetch_assoc($result);
        $admin_id = $row['Admin_ID'];
        $em = $row['Email'];

        if ($admin_id == "$username" && $em == "$email") {
            $p = rand(9999999, 1111111);
                $convert = base_convert($p, 12, 20);
                $encpass = password_hash($convert, PASSWORD_BCRYPT);

                $subject = "New Password";
                $message = "Your new password is: $convert \nDont forget to change your password!";
                $sender = "From: hca-mis@portal";

                    if(mail($email, $subject, $message, $sender)){

                        $new_password = "UPDATE user SET NPassword = '$encpass' , Password ='' WHERE Username = '$username'";
                        mysqli_query($con, $new_password);

                        $info = "We've sent a temporary password to your email - $email";
                            header("Location: reset_password.php?info=$info");
                            exit();
                }else{
                    $errors = "Failed while sending your new password!";
                    header("Location: reset_password.php?error=$errors");
                }


           
        }else{
            $errors = "Username and Email does not match in our database!";
            header("Location: reset_password.php?error=$errors");
        }
    }elseif ($type == "Teacher") {

        $teacher = "SELECT * FROM tb_teachers WHERE EMP_ID ='$username' ";
        $result = mysqli_query($con, $teacher);
        $row = mysqli_fetch_assoc($result);
        $teacherID = $row['EMP_ID'];
        $em = $row['Email'];

        if ($teacherID == "$username" && $em == "$email") {
            $p = rand(9999999, 1111111);
            $convert = base_convert($p, 12, 20);
            $encpass = password_hash($convert, PASSWORD_BCRYPT);

            $subject = "New Password";
            $message = "Your new password is: $convert \nDont forget to change your password!";
            $sender = "From: hca-mis@portal";

            if(mail($email, $subject, $message, $sender)){

                    $new_password = "UPDATE user SET NPassword = '$encpass' , Password ='' WHERE Username = '$username'";
                    mysqli_query($con, $new_password);

                    $info = "We've sent a temporary password to your email - $email";
                    header("Location: reset_password.php?info=$info");
                    exit();
                }else{
                    $errors = "Failed while sending your new password!";
                    header("Location: reset_password.php?error=$errors");
                }

           
        }else{
            $errors = "Username and Email does not match in our database!";
            header("Location: reset_password.php?error=$errors");
        }
        
    }elseif ($type == "Student") {

        $student = "SELECT * FROM student_tb WHERE Student_ID = '$username'";
        $result = mysqli_query($con, $student);
        $row = mysqli_fetch_assoc($result);
        $studentID = $row['Student_ID'];
        $em = $row['Email'];

        if ($studentID == "$username" && $em == "$email") {
            $p = rand(9999999, 1111111);
            $convert = base_convert($p, 12, 20);
            $encpass = password_hash($convert, PASSWORD_BCRYPT);

            $subject = "New Password";
            $message = "Your new password is: $convert \nDont forget to change your password!";
            $sender = "From: hca-mis@portal";

            if(mail($email, $subject, $message, $sender)){

                    $new_password = "UPDATE user SET NPassword = '$encpass' , Password ='' WHERE Username = '$username'";
                    mysqli_query($con, $new_password);

                    $info = "We've sent a temporary password to your email - $email";
                    header("Location: reset_password.php?info=$info");
                    exit();
                }else{
                    $errors = "Failed while sending your new password!";
                    header("Location: reset_password.php?error=$errors");
                }

           
        }else{
            $errors = "Username and Email does not match in our database!";
            header("Location: reset_password.php?error=$errors");
        }


    }

}
}


?>