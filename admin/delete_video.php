<?php  
include_once '../database/connection.php';

extract($_POST);

if (isset($_POST)) {
	$id = mysqli_real_escape_string($con, $_POST['id']);
	mysqli_query($con, "DELETE FROM sys_video Where ID = '$id'");
}

?>