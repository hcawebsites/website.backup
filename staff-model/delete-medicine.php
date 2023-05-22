<?php  
include_once '../database/connection.php';


if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);
	mysqli_query($con, "DELETE from medicine where ID = '$id'");
}

?>