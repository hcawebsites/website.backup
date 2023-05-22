<?php  
include_once '../database/connection.php';

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['ids']);

	mysqli_query($con, "DELETE FROM books WHERE ID = '$id'");
}
?>