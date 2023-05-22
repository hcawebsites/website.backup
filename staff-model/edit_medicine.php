<?php  
include_once '../database/connection.php';

extract($_POST);

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$type = mysqli_real_escape_string($con, $_POST['type']);
	$available =mysqli_real_escape_string($con, $_POST['total']);

	mysqli_query($con, "UPDATE medicine Set Name = '$name', Type = '$type', Total = '$available' WHERE ID = '$id'");
}

?>