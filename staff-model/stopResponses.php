<?php
include_once '../database/connection.php';

if (isset($_POST)) {
	$qid = $_POST['qid'];

	$accept = mysqli_query($con, "UPDATE quiz SET Status = 0 WHERE Quiz_ID = '$qid'");
	if ($accept) {
		echo "You stop receiving responses.";
	}
}
?>