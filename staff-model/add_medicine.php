<?php  
include_once '../database/connection.php';

extract($_POST);

if ($_POST) {
	$med_name = mysqli_real_escape_string($con, $_POST['med_name']);
	$med_mg = mysqli_real_escape_string($con, $_POST['med_mg']);
	$med_type = mysqli_real_escape_string($con, $_POST['med_type']);
	$total = mysqli_real_escape_string($con, $_POST['total']);
	$med_expire = mysqli_real_escape_string($con, $_POST['date']);

	mysqli_query($con, "INSERT into medicine (Name, Mg, Type, Total, Date_Expiration) VALUES ('$med_name', '$med_mg', '$med_type', '$total', '$med_expire')");
}
?>