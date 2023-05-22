<?php include_once ('../database/connection.php'); 
$info = array();
$errors = array();


if (isset($_POST['submit'])) {

    $myID = mysqli_real_escape_string($con, $_POST['myID']);
    $oldpassword = mysqli_real_escape_string($con, $_POST['oldpass']);
    $newPass = mysqli_real_escape_string($con, $_POST['newpass']);
    $cPass = mysqli_real_escape_string($con, $_POST['cpass']);
    $encpass = password_hash($newPass, PASSWORD_BCRYPT);

    $sql = "SELECT * FROM std_account WHERE Student_ID = '$myID'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $oldPass = $row['Password'];

   if ($newPass != $cPass) {
        echo '<script>
            alert("Password Not Match!");
            window.location.href="settings.php";
        </script>';
   }else{
    if (password_verify($oldpassword, $oldPass)) {
        $sql = mysqli_query($con, "UPDATE std_account Set Password = '$encpass', Status = '2' WHERE Student_ID = '$myID'");
        if ($sql) {
            echo '<script>
                alert("Password Changed!");
                window.location.href="settings.php";
            </script>';
        }
    }else{
        echo '<script>
            alert("Password Not Match In Our Database!");
            window.location.href="settings.php";
        </script>';
    }
   }


}
?>

