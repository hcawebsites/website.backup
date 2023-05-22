<?php session_start();
include_once ('database/connection.php'); ?>

<?php 
$errors = array();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password1 = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM std_account WHERE Username = '$username'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $username;
    $code = $row['Reg_Number'];
    $_SESSION['code'] = $code;
    $std_id = $row['Studend_ID'];
    $_SESSION['student_id'] = $std_id;

    if (mysqli_num_rows($result) > 0) {
        $password  = $row['Password'];

        if (password_verify($password1, $password)) {
            header('location: enrollment/dashboard.php');
        }
        else{
            $errors = "Incorrect Username or Password!";
            header("Location: login.php?error= $errors");
        }
    }
    else{
        $errors = "No Credintials Found!";
        header("Location: login.php?error= $errors");
    }
}

?>