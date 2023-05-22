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

    $sql = "SELECT * FROM user WHERE Username = '$username'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $emp_id = $row['Username'];
    $_SESSION['emp_id'] = $emp_id;
    $access = $row['Access'];
    $_SESSION['access'] = $access;
    $status = $row['AStatus'];
    $_SESSION['status'] = $status;
    $otp = $row['Otp'];
    $name = $row['Firstname'];

    if ($access == "Teacher") {

        if ($otp == $code) {
            mysqli_query($con, "INSERT INTO system_logs (Name, Purpose) Values ('$name', 'Login')");

            $query = "UPDATE user SET Otp = '' WHERE Username = '$username'";
            $res = mysqli_query($con, $query);
     
            if ($res) {            
                $sql1 = "SELECT * FROM teacher_tb WHERE Emp_ID = '$username'";
                $result1 = mysqli_query($con, $sql1);
                $data = mysqli_fetch_assoc($result1);
     
                $teacher_id = $data['Emp_ID'];
                $_SESSION['teacher_id']=$teacher_id;
     
                header('location: ../staff/teachers/dashboard.php');
            }
         }else{
             ?>
             <script>
                 window.alert("One-Time Password  Incorrect!");
             </script>
             <?php
         }
    }elseif ($access == "Cashier") {
        if ($otp == $code) {
            mysqli_query($con, "INSERT INTO system_logs (Name, Purpose) Values ('$name', 'Login')");

            $query = "UPDATE user SET Otp = '' WHERE Username = '$username'";
            $res = mysqli_query($con, $query);
     
            if ($res) {

                $sql1 = "SELECT * FROM staff_tb WHERE Emp_ID = '$username'";
                $result1 = mysqli_query($con, $sql1);
                $data = mysqli_fetch_assoc($result1);
     
                $staff_id = $data['Emp_ID'];
                $_SESSION['staff_id']=$staff_id;
     
                header('location: ../staff/cashier/dashboard.php');
            }
         }else{
             ?>
             <script>
                 window.alert("One-Time Password  Incorrect!");
             </script>
             <?php
    }

}elseif ($access == "Librarian") {
        if ($otp == $code) {
            mysqli_query($con, "INSERT INTO system_logs (Name, Purpose) Values ('$name', 'Login')");

            $query = "UPDATE user SET Otp = '' WHERE Username = '$username'";
            $res = mysqli_query($con, $query);
     
            if ($res) {

                $sql1 = "SELECT * FROM staff_tb WHERE Emp_ID = '$username'";
                $result1 = mysqli_query($con, $sql1);
                $data = mysqli_fetch_assoc($result1);
     
                $staff_id = $data['Emp_ID'];
                $_SESSION['staff_id']=$staff_id;
     
                header('location: ../staff/librarian/dashboard.php');
            }
         }else{
             ?>
             <script>
                 window.alert("One-Time Password  Incorrect!");
             </script>
             <?php
    }

}elseif ($access == "Counselor") {
    if ($otp == $code) {
        mysqli_query($con, "INSERT INTO system_logs (Name, Purpose) Values ('$name', 'Login')");

        $query = "UPDATE user SET Otp = '' WHERE Username = '$username'";
        $res = mysqli_query($con, $query);
 
        if ($res) {

            $sql1 = "SELECT * FROM staff_tb WHERE Emp_ID = '$username'";
            $result1 = mysqli_query($con, $sql1);
            $data = mysqli_fetch_assoc($result1);
 
            $staff_id = $data['Emp_ID'];
            $_SESSION['staff_id']=$staff_id;
 
            header('location: ../staff/councelor/dashboard.php');
        }
     }else{
         ?>
         <script>
             window.alert("One-Time Password  Incorrect!");
         </script>
         <?php
}

}elseif ($access == "Nurse") {
    if ($otp == $code) {
        mysqli_query($con, "INSERT INTO system_logs (Name, Purpose) Values ('$name', 'Login')");

        $query = "UPDATE user SET Otp = '' WHERE Username = '$username'";
        $res = mysqli_query($con, $query);
 
        if ($res) {

            $sql1 = "SELECT * FROM staff_tb WHERE Emp_ID = '$username'";
            $result1 = mysqli_query($con, $sql1);
            $data = mysqli_fetch_assoc($result1);
 
            $staff_id = $data['Emp_ID'];
            $_SESSION['staff_id']=$staff_id;
 
            header('location: ../staff/nurse/dashboard.php');
        }
     }else{
         ?>
         <script>
             window.alert("One-Time Password  Incorrect!");
         </script>
         <?php
}

}
}



?>