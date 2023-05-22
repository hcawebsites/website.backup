<?php  
include_once '../database/connection.php';

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);

	$set = mysqli_query($con, "UPDATE sys_video Set Status = 0 Where Status = '1'");;

	if ($set) {
		mysqli_query($con, "UPDATE sys_video Set Status = 1 Where ID = '$id'");
	}
}

?>