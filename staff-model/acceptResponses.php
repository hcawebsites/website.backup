<?php
include_once '../database/connection.php';

if (isset($_POST)) {
	$qid = $_POST['qid'];

	$accept = mysqli_query($con, "UPDATE quiz SET Status = 1 WHERE Quiz_ID = '$qid'");
	if ($accept) {
		echo "You start receiving responses.";
	}
}
?>