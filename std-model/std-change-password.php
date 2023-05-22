<?php include_once ('../database/connection.php');?>

<?php
$info = array();
$id = $_SESSION['student_id'];
if(isset($_POST['submit'])){

    $sql = "SELECT * FROM user WHERE Username = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $pass = $row['Password'];
    $npass = $row['NPassword'];

    $oldpass = mysqli_real_escape_string($con, $_POST['oldpass']);
	$newpass = mysqli_real_escape_string($con, $_POST['newpass']);
  	$cpass = mysqli_real_escape_string($con, $_POST['cpass']);
  	$encpass = password_hash($newpass, PASSWORD_BCRYPT);

    if($newpass != $cpass){
        header('location: ../student/std_settings.php?error=Password Not Match!');
    }else{

        if(password_verify($oldpass, $pass)){

            $sql1 = "UPDATE user SET Password = '$encpass' WHERE Username = '$id'";
            $result1 = mysqli_query($con, $sql1);
    
            if($result1){
              $info = "Password Change Successfully!";
              header("Location: ../student/std_settings.php?info=$info");
            }
        }
    
        elseif(password_verify($oldpass, $npass)){
    
            $sql2 = "UPDATE user SET Password = '$encpass', NPassword = '' WHERE Username = '$id'";
            $result2 = mysqli_query($con, $sql2);
    
            if($result2){
              $info = "Password Change Successfully!";
              header("Location: ../student/std_settings.php?info=$info");
            }
    
        }
        else{
            header('location: ../student/std_settings.php?error=Old Password Not Match in our Database!');
        }
    }
}

?>