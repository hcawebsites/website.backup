<?php 
include_once '../database/connection.php';
extract($_POST);
$myID = mysqli_real_escape_string($con, $_POST['myID']);
$oldpass = mysqli_real_escape_string($con, $_POST['oldpass']);
$newpass = mysqli_real_escape_string($con, $_POST['newpass']);
$cpass = mysqli_real_escape_string($con, $_POST['cpass']);
$encpass = password_hash($newpass, PASSWORD_BCRYPT);
$_get = mysqli_query($con, "SELECT * FROM user WHERE Username = '$myID'");
$_row = mysqli_fetch_assoc($_get);
$default = $_row['Password'];

if($newpass != $cpass){
    echo 'Password Not Match!';
}else{
    if(password_verify($oldpass, $default)){
       $insert = mysqli_query($con, "UPDATE user SET Password = '$encpass' WHERE Username = '$myID'");
       if($insert){
           echo "success";
       }
    }else{
        echo "Old Password Incorrect!";
    }
}

?>