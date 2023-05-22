<?php include_once '../database/connection.php';

if ($_POST) {
	$today = date('Y-m-d');
	$id = mysqli_real_escape_string($con, $_POST['id']);
	mysqli_query($con, "UPDATE guidance SET Status = '0', Date_Resolved = '$today' Where ID = '$id'");
}



?>