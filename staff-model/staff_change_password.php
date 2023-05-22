<?php  
include_once '../database/connection.php';
extract($_POST);

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['ids']);
	$oldpass = mysqli_real_escape_string($con, $_POST['oldpass']);
	$newpass = mysqli_real_escape_string($con, $_POST['newpass']);
  	$cpass = mysqli_real_escape_string($con, $_POST['cpass']);
  	$encpass = password_hash($newpass, PASSWORD_BCRYPT);

  	$sql = "SELECT * FROM user WHERE Username = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $pass = $row['Password'];

  	if($newpass != $cpass){
        echo "Password not match!";
        }else{
    	if(password_verify($oldpass, $pass)){
           mysqli_query($con, "UPDATE user SET Password = '$encpass' WHERE Username = '$id'");
           echo "Password Changed!";
        }else{
        	echo "Old Password Incorrect";
        }
    }
}
?>