<?php 
session_start();
include_once ("../database/connection.php");
if (isset($_POST['verify'])) {

    $otp1 = mysqli_real_escape_string($con, $_POST['otp1']);
    $otp2 = mysqli_real_escape_string($con, $_POST['otp2']);
    $otp3 = mysqli_real_escape_string($con, $_POST['otp3']);
    $otp4 = mysqli_real_escape_string($con, $_POST['otp4']);
    $otp5 = mysqli_real_escape_string($con, $_POST['otp5']);
    $otp6 = mysqli_real_escape_string($con, $_POST['otp6']);
    $code = $otp1.$otp2.$otp3.$otp4.$otp5.$otp6;

    $username = $_SESSION['username'];

    $sql = "SELECT * FROM std_account WHERE Student_ID = '$username'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    $status = $data['Status'];
    $otp = $data['Otp'];
    $name = $data['Firstname'];
    $access = $data['Access'];
    $_SESSION['access'] = $access;


    if ($otp == $code) {

       mysqli_query($con, "UPDATE std_account SET Otp = 0 WHERE Student_ID = '$username'");
       
        if ($status == 1) {

            $get = mysqli_query($con, "SELECT * FROM student WHERE Student_ID = '$username'");
            $row = mysqli_fetch_assoc($get);

            $student_id = $row['Student_ID'];
            $_SESSION['student_id'] = $student_id;
            echo "<script>window.location.href='../enrollment/settings.php'</script>";
            exit();
    	}elseif($status == 2){
            $get = mysqli_query($con, "SELECT * FROM student WHERE Student_ID = '$username'");
            $row = mysqli_fetch_assoc($get);

            $student_id = $row['Student_ID'];
            $_SESSION['student_id'] = $student_id;
            echo "<script>window.location.href='../enrollment/dashboard.php'</script>";
            exit();
        }else{
            $get = mysqli_query($con, "SELECT * FROM student WHERE Student_ID = '$username'");
            $row = mysqli_fetch_assoc($get);

            $student_id = $row['Student_ID'];
            $_SESSION['student_id'] = $student_id;
            echo "<script>window.location.href='../student/std_dashboard.php'</script>";
            exit();

        }
    }else{
        ?>
        <script>
            window.alert("One-Time Password  Incorrect!");
        </script>
        <?php
    }
    
}



?>