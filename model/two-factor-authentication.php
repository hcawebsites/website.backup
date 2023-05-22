<?php session_start();?>
<?php include_once ("../database/connection.php");


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
	$access = $row['Access'];
	$status = $row['AStatus'];
	$_SESSION['status'] = $status;
    $otp = $row['Otp'];
    $name = $row['Firstname'];

    if ($otp == $code) {

       $query = "UPDATE user SET Otp = '' WHERE Username = '$username'";
       $res = mysqli_query($con, $query);
       mysqli_query($con, "INSERT INTO system_logs (Name, Purpose) Values ('$name', 'Login')");

       if ($res) {

        if($access == "Admin" && $status == 1){
			
			$sql1="SELECT * FROM admin where Admin_ID='$username'";	
			$result1=mysqli_query($con,$sql1);
			$row1=mysqli_fetch_assoc($result1);
			$admin_id=$row1['Admin_ID'];
			$_SESSION["admin_id"]=$admin_id;
			$_SESSION["access"]="Admin";
                	
                    header('location: admin_dashboard.php');
                
			
		}

       }
    }
    else{
        ?>
        <script>
            window.alert("One-Time Password  Incorrect!");
        </script>
        <?php
    }
    
}



?>