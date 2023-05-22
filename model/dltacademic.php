<?php
include_once '../database/connection.php';

extract($_POST);

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['cid']);

	mysqli_query($con, "DELETE FROM academic_list WHERE ID = '$id'");
}
?>