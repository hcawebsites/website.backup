<?php include_once '../database/connection.php';
if (isset($_GET['id'])) {

	$id = $_GET['id'];

	$sql = "UPDATE user SET AStatus = 0 WHERE Username = '$id'";

	$result = mysqli_query($con, $sql);

	if ($result) {
		echo '<script>
        alert("Account Deactivated!");
        window.location.href = "../admin/users.php";
        </script>';
		
		
	}

	
	
}



?>