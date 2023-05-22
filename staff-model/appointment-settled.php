<?php  
include_once '../database/connection.php';

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);
	$today = date('Y-m-d');

	mysqli_query($con, "UPDATE appointments Set Status = '0', Date_Settled = '$today' WHERE Student_ID = '$id'");
	echo 'success';
}
?>